#!/bin/bash

MYSQL_DATA="/tmp/mysql_data"
MYSQL_SOCK="/tmp/mysql.sock"
MYSQL_PORT=3306
MYSQL_LOG="/tmp/mysql_error.log"
DB_NAME="smm_free"
MYSQL_ROOT_PASS="yourpass"

MARIADB_BASE="/nix/store/a4jsa8kjdn3wlccj2wkvhxqza38rpxzf-mariadb-server-10.11.13"
MARIADB_SHARE="$MARIADB_BASE/share/mysql"
MARIADB_PLUGINS="$MARIADB_BASE/lib/mysql/plugin"
MARIADB_BIN="$MARIADB_BASE/bin"

MYSQLD="$MARIADB_BIN/mysqld"
MYSQLADMIN="$MARIADB_BIN/mysqladmin"
MYSQL="$MARIADB_BIN/mysql"

echo "=== Loishvizo Boosting Solutions - Starting ==="

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
    cat "$MARIADB_SHARE/maria_add_gis_sp_bootstrap.sql"
    cat "$MARIADB_SHARE/mysql_sys_schema.sql"
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
  "$MYSQL" --socket="$MYSQL_SOCK" 2>/dev/null <<SETUP_SQL
USE mysql;
UPDATE user SET plugin='mysql_native_password', Password=PASSWORD('$MYSQL_ROOT_PASS'), authentication_string='' WHERE User='root' AND Host='localhost';
INSERT IGNORE INTO user (Host, User, plugin, Password, Select_priv, Insert_priv, Update_priv, Delete_priv, Create_priv, Drop_priv, Reload_priv, Shutdown_priv, Process_priv, File_priv, Grant_priv, References_priv, Index_priv, Alter_priv, Show_db_priv, Super_priv, Create_tmp_table_priv, Lock_tables_priv, Execute_priv, Repl_slave_priv, Repl_client_priv, Create_view_priv, Show_view_priv, Create_routine_priv, Alter_routine_priv, Create_user_priv, Event_priv, Trigger_priv, Create_tablespace_priv, ssl_type, ssl_cipher, x509_issuer, x509_subject, max_questions, max_updates, max_connections, max_user_connections) VALUES ('127.0.0.1', 'root', 'mysql_native_password', PASSWORD('$MYSQL_ROOT_PASS'), 'Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','','','','','0','0','0','0');
DELETE FROM user WHERE User='';
FLUSH PRIVILEGES;
CREATE DATABASE IF NOT EXISTS \`$DB_NAME\` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
GRANT ALL PRIVILEGES ON *.* TO 'root'@'127.0.0.1' WITH GRANT OPTION;
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

# Verify smm_free database exists; re-import if lost (e.g. after /tmp reset)
DB_EXISTS=$("$MYSQL" --socket="$MYSQL_SOCK" -u root -p"$MYSQL_ROOT_PASS" -e "SHOW DATABASES LIKE '$DB_NAME';" 2>/dev/null | grep -c "$DB_NAME" 2>/dev/null || true)
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

# Fix root password for all hosts (ensures PHP can connect via 127.0.0.1)
"$MYSQL" --socket="$MYSQL_SOCK" -u root -p"$MYSQL_ROOT_PASS" -e "
  ALTER USER 'root'@'localhost' IDENTIFIED BY '$MYSQL_ROOT_PASS';
  ALTER USER 'root'@'127.0.0.1' IDENTIFIED BY '$MYSQL_ROOT_PASS';
  FLUSH PRIVILEGES;
" 2>/dev/null

# ─── Ensure root password is set for all hosts ───
"$MYSQL" --socket="$MYSQL_SOCK" -u root 2>/dev/null <<'ROOTFIX'
SET PASSWORD FOR 'root'@'localhost' = PASSWORD('yourpass');
SET PASSWORD FOR 'root'@'127.0.0.1' = PASSWORD('yourpass');
FLUSH PRIVILEGES;
ROOTFIX

# ─── Update brand settings in general_options ───
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

# ─── Set up admin accounts in general_staffs ───
echo "[APP] Setting up admin accounts..."
ADMIN_PASS_HASH=$(php -r "echo md5('Loishvizo@2025');" 2>/dev/null || echo "c9f5a9e6b2d8a4f1e7c3b5d2a8f4e6c1")
"$MYSQL" --socket="$MYSQL_SOCK" -u root -p"$MYSQL_ROOT_PASS" "$DB_NAME" 2>/dev/null <<ADMINS_SQL
INSERT IGNORE INTO general_staffs (ids, first_name, last_name, email, password, role, status, created)
VALUES
  (1, 'Isha',   'Mvizo',   'Ishamvizo2005@gmail.com',  '$ADMIN_PASS_HASH', 'admin', 1, NOW()),
  (2, 'Lois',   'Hvizo',   'loishvizo@gmail.com',      '$ADMIN_PASS_HASH', 'admin', 1, NOW()),
  (3, 'Delos',  'Voyage',  'delostvoyage@gmail.com',   '$ADMIN_PASS_HASH', 'admin', 1, NOW()),
  (4, 'Meddy',  'Mususwa', 'meddymususwa126@gmail.com','$ADMIN_PASS_HASH', 'admin', 1, NOW())
ON DUPLICATE KEY UPDATE role='admin', status=1;
ADMINS_SQL

# ─── Add admin emails to general_users with balance=9999999 (no pay) ───
"$MYSQL" --socket="$MYSQL_SOCK" -u root -p"$MYSQL_ROOT_PASS" "$DB_NAME" 2>/dev/null <<USERS_SQL
INSERT IGNORE INTO general_users (ids, first_name, last_name, email, password, balance, status, api_key, created)
VALUES
  (1001, 'Isha',  'Mvizo',   'Ishamvizo2005@gmail.com',  '$ADMIN_PASS_HASH', 9999999.00, 1, 'lv_admin_key_isha',   NOW()),
  (1002, 'Lois',  'Hvizo',   'loishvizo@gmail.com',      '$ADMIN_PASS_HASH', 9999999.00, 1, 'lv_admin_key_lois',   NOW()),
  (1003, 'Delos', 'Voyage',  'delostvoyage@gmail.com',   '$ADMIN_PASS_HASH', 9999999.00, 1, 'lv_admin_key_delos',  NOW()),
  (1004, 'Meddy', 'Mususwa', 'meddymususwa126@gmail.com','$ADMIN_PASS_HASH', 9999999.00, 1, 'lv_admin_key_meddy',  NOW())
ON DUPLICATE KEY UPDATE balance=9999999.00, status=1;
USERS_SQL

# ─── Disable lworx payment gateway in DB ───
"$MYSQL" --socket="$MYSQL_SOCK" -u root -p"$MYSQL_ROOT_PASS" "$DB_NAME" 2>/dev/null <<'LWORX_SQL'
UPDATE payments_method SET status=0 WHERE type='lworx';
LWORX_SQL

echo "[APP] Setup complete!"

# Start PHP built-in server (foreground)
PORT="${PORT:-5000}"
echo "[PHP] Starting server on http://0.0.0.0:$PORT"
exec php -S 0.0.0.0:$PORT -t . router.php
