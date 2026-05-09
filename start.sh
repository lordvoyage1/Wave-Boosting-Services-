#!/bin/bash

MYSQL_DATA="/tmp/mysql_data"
MYSQL_SOCK="/tmp/mysql.sock"
MYSQL_PORT=3306
MYSQL_LOG="/tmp/mysql_error.log"
DB_NAME="smm_free"
MYSQL_ROOT_PASS="yourpass"

# Dynamically find MariaDB in the Nix store
MARIADB_BASE=$(ls /nix/store/ 2>/dev/null | grep "^[a-z0-9]*-mariadb-server-10\.11\." | grep -v man | grep -v devdoc | sort | tail -1)
if [ -z "$MARIADB_BASE" ]; then
  MARIADB_BASE=$(ls /nix/store/ 2>/dev/null | grep "^[a-z0-9]*-mariadb-server-" | grep -v man | grep -v devdoc | sort | tail -1)
fi
MARIADB_BASE="/nix/store/$MARIADB_BASE"
MARIADB_SHARE="$MARIADB_BASE/share/mysql"
MARIADB_PLUGINS="$MARIADB_BASE/lib/mysql/plugin"
MARIADB_BIN="$MARIADB_BASE/bin"

MYSQLD="$MARIADB_BIN/mysqld"
MYSQLADMIN="$MARIADB_BIN/mysqladmin"
MYSQL="$MARIADB_BIN/mysql"

echo "=== Loishvizo Boosting Solutions - Starting ==="
echo "[DB] Using MariaDB: $MARIADB_BASE"

# Initialize MariaDB data directory on first run
if [ ! -f "$MYSQL_DATA/.initialized" ]; then
  echo "[DB] First run - initializing MariaDB system tables..."
  rm -rf "$MYSQL_DATA"
  mkdir -p "$MYSQL_DATA"

  # Bootstrap with correct SQL sequence (matching mysql_install_db behavior)
  (
    echo "create database if not exists mysql;"
    echo "use mysql;"
    echo "SET @auth_root_socket=NULL;"
    cat "$MARIADB_SHARE/mysql_system_tables.sql"
    cat "$MARIADB_SHARE/mysql_performance_tables.sql"
    cat "$MARIADB_SHARE/mysql_system_tables_data.sql"
    cat "$MARIADB_SHARE/fill_help_tables.sql"
    [ -f "$MARIADB_SHARE/maria_add_gis_sp_bootstrap.sql" ] && cat "$MARIADB_SHARE/maria_add_gis_sp_bootstrap.sql"
    [ -f "$MARIADB_SHARE/mysql_sys_schema.sql" ] && cat "$MARIADB_SHARE/mysql_sys_schema.sql"
  ) | "$MYSQLD" --no-defaults \
      --bootstrap \
      --basedir="$MARIADB_BASE" \
      --datadir="$MYSQL_DATA" \
      --plugin-dir="$MARIADB_PLUGINS" \
      --log-warnings=0 \
      --enforce-storage-engine="" \
      --max_allowed_packet=8M \
      --net_buffer_length=16K \
      2>>"$MYSQL_LOG"

  echo "[DB] System tables created!"

  # Start mysqld temporarily to set up users and import schema
  rm -f "$MYSQL_SOCK"
  "$MYSQLD" --no-defaults \
    --basedir="$MARIADB_BASE" \
    --datadir="$MYSQL_DATA" \
    --socket="$MYSQL_SOCK" \
    --skip-grant-tables \
    --log-error="$MYSQL_LOG" \
    --plugin-dir="$MARIADB_PLUGINS" &
  INIT_PID=$!

  echo "[DB] Waiting for setup mysqld..."
  for i in $(seq 1 20); do
    if "$MYSQLADMIN" --socket="$MYSQL_SOCK" ping --silent 2>/dev/null; then
      echo "[DB] Setup mysqld ready"
      break
    fi
    sleep 1
  done

  # Set up root user and create app database (skip-grant-tables mode)
  # Note: In skip-grant-tables mode, connect without password and without -p flag
  "$MYSQL" --socket="$MYSQL_SOCK" --user=root 2>/dev/null <<SETUP_SQL
USE mysql;
UPDATE user SET plugin='mysql_native_password', Password=PASSWORD('$MYSQL_ROOT_PASS'), authentication_string='' WHERE User='root';
DELETE FROM user WHERE User='';
FLUSH PRIVILEGES;
CREATE DATABASE IF NOT EXISTS \`$DB_NAME\` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
GRANT ALL PRIVILEGES ON \`$DB_NAME\`.* TO 'root'@'localhost';
GRANT ALL PRIVILEGES ON \`$DB_NAME\`.* TO 'root'@'127.0.0.1';
GRANT ALL PRIVILEGES ON \`$DB_NAME\`.* TO 'root'@'repl';
FLUSH PRIVILEGES;
SETUP_SQL

  echo "[DB] Importing application schema..."
  "$MYSQL" --socket="$MYSQL_SOCK" -u root -p"$MYSQL_ROOT_PASS" "$DB_NAME" < _sql/install.sql 2>/dev/null
  echo "[DB] Schema imported!"

  # Stop the init mysqld
  kill $INIT_PID 2>/dev/null
  wait $INIT_PID 2>/dev/null
  sleep 2

  touch "$MYSQL_DATA/.initialized"
  echo "[DB] Database fully initialized!"
fi

# Remove stale socket
rm -f "$MYSQL_SOCK"

# Start MariaDB for real
echo "[DB] Starting MariaDB..."
"$MYSQLD" --no-defaults \
  --basedir="$MARIADB_BASE" \
  --datadir="$MYSQL_DATA" \
  --socket="$MYSQL_SOCK" \
  --port="$MYSQL_PORT" \
  --bind-address="127.0.0.1" \
  --log-error="$MYSQL_LOG" \
  --plugin-dir="$MARIADB_PLUGINS" &
MYSQLD_PID=$!

echo "[DB] Waiting for MariaDB..."
for i in $(seq 1 30); do
  if "$MYSQLADMIN" --socket="$MYSQL_SOCK" -u root -p"$MYSQL_ROOT_PASS" ping --silent 2>/dev/null; then
    echo "[DB] MariaDB ready after ${i}s"
    break
  fi
  sleep 1
done

# Ensure root password is set for all hosts
"$MYSQL" --socket="$MYSQL_SOCK" -u root -p"$MYSQL_ROOT_PASS" -e "
  ALTER USER 'root'@'localhost' IDENTIFIED BY '$MYSQL_ROOT_PASS';
  CREATE USER IF NOT EXISTS 'root'@'127.0.0.1' IDENTIFIED BY '$MYSQL_ROOT_PASS';
  GRANT ALL PRIVILEGES ON *.* TO 'root'@'127.0.0.1' WITH GRANT OPTION;
  FLUSH PRIVILEGES;
" 2>/dev/null || true

# Verify smm_free database exists; re-import if lost (e.g. after /tmp reset)
DB_EXISTS=$("$MYSQL" --socket="$MYSQL_SOCK" -u root -p"$MYSQL_ROOT_PASS" -e "SHOW DATABASES LIKE '$DB_NAME';" 2>/dev/null | grep -c "$DB_NAME" 2>/dev/null || echo "0")
DB_EXISTS="${DB_EXISTS:-0}"
if [ "$DB_EXISTS" -eq 0 ] 2>/dev/null || [ -z "$DB_EXISTS" ]; then
  echo "[DB] Database '$DB_NAME' missing - re-importing schema..."
  "$MYSQL" --socket="$MYSQL_SOCK" -u root -p"$MYSQL_ROOT_PASS" -e "
    CREATE DATABASE IF NOT EXISTS \`$DB_NAME\` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
    GRANT ALL PRIVILEGES ON \`$DB_NAME\`.* TO 'root'@'localhost';
    GRANT ALL PRIVILEGES ON \`$DB_NAME\`.* TO 'root'@'127.0.0.1';
    FLUSH PRIVILEGES;
  " 2>/dev/null
  "$MYSQL" --socket="$MYSQL_SOCK" -u root -p"$MYSQL_ROOT_PASS" "$DB_NAME" < _sql/install.sql 2>/dev/null
  echo "[DB] Schema re-imported!"
fi

# Update brand settings in general_options
echo "[APP] Updating Loishvizo brand settings..."
"$MYSQL" --socket="$MYSQL_SOCK" -u root -p"$MYSQL_ROOT_PASS" "$DB_NAME" 2>/dev/null <<'BRAND_SQL'
INSERT INTO general_options (name, value) VALUES
  ('website_name',    'Loishvizo Boosting Solutions'),
  ('website_title',   'Loishvizo Boosting Solutions - Ultra Speed SMM Panel'),
  ('website_desc',    'Loishvizo Boosting Solutions - The ultra speed social media boosting platform. Boost TikTok, YouTube, Instagram, Facebook, Twitter, Spotify & more instantly.'),
  ('website_keywords','loishvizo, smm panel, social media boosting, boost followers, boost likes, tiktok panel, youtube panel, instagram panel, fast smm panel'),
  ('copy_right_content', 'Copyright &copy; 2025 Loishvizo Boosting Solutions. All Rights Reserved.')
ON DUPLICATE KEY UPDATE value = VALUES(value);
BRAND_SQL

# Set up admin accounts in general_staffs (using actual column names)
echo "[APP] Setting up admin accounts..."
ADMIN_PASS_HASH=$(php -r "echo md5('Loishvizo@2025');" 2>/dev/null || echo "aa9103a1ad819c1ead1008ba223c2b1d")
"$MYSQL" --socket="$MYSQL_SOCK" -u root -p"$MYSQL_ROOT_PASS" "$DB_NAME" 2>/dev/null <<ADMINS_SQL
INSERT IGNORE INTO general_staffs (ids, first_name, last_name, email, password, admin, status, created)
VALUES
  ('ids_1', 'Isha',   'Mvizo',   'Ishamvizo2005@gmail.com',  '$ADMIN_PASS_HASH', 1, 1, NOW()),
  ('ids_2', 'Lois',   'Hvizo',   'loishvizo@gmail.com',      '$ADMIN_PASS_HASH', 1, 1, NOW()),
  ('ids_3', 'Delos',  'Voyage',  'delostvoyage@gmail.com',   '$ADMIN_PASS_HASH', 1, 1, NOW()),
  ('ids_4', 'Meddy',  'Mususwa', 'meddymususwa126@gmail.com','$ADMIN_PASS_HASH', 1, 1, NOW())
ON DUPLICATE KEY UPDATE admin=1, status=1;
ADMINS_SQL

# Add admin emails to general_users with balance=9999999
"$MYSQL" --socket="$MYSQL_SOCK" -u root -p"$MYSQL_ROOT_PASS" "$DB_NAME" 2>/dev/null <<USERS_SQL
INSERT IGNORE INTO general_users (ids, first_name, last_name, email, password, balance, status, api_key, created)
VALUES
  ('usr_1001', 'Isha',  'Mvizo',   'Ishamvizo2005@gmail.com',  '$ADMIN_PASS_HASH', 9999999.00, 1, 'lv_admin_key_isha',   NOW()),
  ('usr_1002', 'Lois',  'Hvizo',   'loishvizo@gmail.com',      '$ADMIN_PASS_HASH', 9999999.00, 1, 'lv_admin_key_lois',   NOW()),
  ('usr_1003', 'Delos', 'Voyage',  'delostvoyage@gmail.com',   '$ADMIN_PASS_HASH', 9999999.00, 1, 'lv_admin_key_delos',  NOW()),
  ('usr_1004', 'Meddy', 'Mususwa', 'meddymususwa126@gmail.com','$ADMIN_PASS_HASH', 9999999.00, 1, 'lv_admin_key_meddy',  NOW())
ON DUPLICATE KEY UPDATE balance=9999999.00, status=1;
USERS_SQL

# Disable lworx payment gateway in DB (correct table name is 'payments')
"$MYSQL" --socket="$MYSQL_SOCK" -u root -p"$MYSQL_ROOT_PASS" "$DB_NAME" -e "UPDATE payments SET status=0 WHERE type='lworx';" 2>/dev/null || true

echo "[APP] Setup complete!"

# Ensure writable directories exist
mkdir -p app/cache app/logs assets/uploads

# Start PHP built-in server (foreground)
PORT="${PORT:-5000}"
echo "[PHP] Starting server on http://0.0.0.0:$PORT"
exec php -S 0.0.0.0:$PORT -t . router.php
