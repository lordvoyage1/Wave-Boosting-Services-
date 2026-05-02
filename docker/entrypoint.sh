#!/bin/bash
set -e

APP_PORT="${PORT:-10000}"
DB_NAME="${DB_NAME:-smm_free}"
DB_USER="${DB_USER:-smm_user}"
DB_PASS="${DB_PASS:-SmMp@ss2025!}"
MYSQL_ROOT_PASSWORD="${MYSQL_ROOT_PASSWORD:-R00tP@ss2025!}"
SETUP_SOCK="/var/run/mysqld/mysqld_setup.sock"
DB_DATA="/var/lib/mysql"

echo "=== Wave Boosting Services - Starting ==="
echo "[INFO] Port: $APP_PORT"

# ── Apache port configuration ─────────────────────────────────────────────────
sed -i "s/APP_PORT/${APP_PORT}/g" /etc/apache2/sites-available/000-default.conf
printf "Listen %s\n" "$APP_PORT" > /etc/apache2/ports.conf

# ── Create required directories ───────────────────────────────────────────────
mkdir -p /var/log/supervisor /var/log/mysql /var/run/mysqld \
         /var/www/html/app/cache /var/www/html/app/logs \
         /var/www/html/assets/uploads

chown -R mysql:mysql /var/run/mysqld "${DB_DATA}" /var/log/mysql
chown -R www-data:www-data /var/www/html/app/cache \
                            /var/www/html/app/logs \
                            /var/www/html/assets/uploads

# ── Initialize MariaDB data directory on first run ────────────────────────────
IS_FIRST_RUN=0
if [ ! -d "${DB_DATA}/mysql" ]; then
    echo "[DB] First run — initializing MariaDB data directory..."
    mysql_install_db --user=mysql --datadir="${DB_DATA}" --skip-test-db \
        > /var/log/mysql/install.log 2>&1
    echo "[DB] Data directory initialized."
    IS_FIRST_RUN=1
fi

# ── Start MariaDB temporarily for setup ───────────────────────────────────────
echo "[DB] Starting MariaDB for setup..."
mysqld --user=mysql --skip-networking --socket="${SETUP_SOCK}" \
       --datadir="${DB_DATA}" &
MYSQLD_PID=$!

for i in $(seq 1 30); do
    if mysqladmin --socket="${SETUP_SOCK}" ping --silent 2>/dev/null; then
        echo "[DB] MariaDB ready (${i}s)"
        break
    fi
    sleep 1
done

# ── Determine if schema import is needed ─────────────────────────────────────
# Use filesystem check — more reliable than SQL across first/subsequent runs
SCHEMA_NEEDED=0
if [ ! -d "${DB_DATA}/${DB_NAME}" ]; then
    SCHEMA_NEEDED=1
fi

if [ "$IS_FIRST_RUN" -eq 1 ] || [ "$SCHEMA_NEEDED" -eq 1 ]; then
    echo "[DB] Setting up database, users and schema..."

    # Set root password (works with empty password on fresh install)
    mysql --socket="${SETUP_SOCK}" -u root 2>/dev/null <<SQL || true
ALTER USER 'root'@'localhost' IDENTIFIED BY '${MYSQL_ROOT_PASSWORD}';
FLUSH PRIVILEGES;
SQL

    # Create database and app user
    mysql --socket="${SETUP_SOCK}" -u root -p"${MYSQL_ROOT_PASSWORD}" 2>/dev/null <<SQL
CREATE DATABASE IF NOT EXISTS \`${DB_NAME}\`
    CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER IF NOT EXISTS '${DB_USER}'@'localhost'
    IDENTIFIED BY '${DB_PASS}';
CREATE USER IF NOT EXISTS '${DB_USER}'@'127.0.0.1'
    IDENTIFIED BY '${DB_PASS}';
GRANT ALL PRIVILEGES ON \`${DB_NAME}\`.* TO '${DB_USER}'@'localhost';
GRANT ALL PRIVILEGES ON \`${DB_NAME}\`.* TO '${DB_USER}'@'127.0.0.1';
FLUSH PRIVILEGES;
SQL

    echo "[DB] Importing application schema..."
    mysql --socket="${SETUP_SOCK}" \
          -u root -p"${MYSQL_ROOT_PASSWORD}" "${DB_NAME}" \
          < /var/www/html/_sql/install.sql

    echo "[DB] Schema imported successfully!"
else
    echo "[DB] Database already set up, skipping import."
fi

# ── Stop setup mysqld ─────────────────────────────────────────────────────────
echo "[DB] Stopping setup mysqld..."
kill $MYSQLD_PID 2>/dev/null
wait $MYSQLD_PID 2>/dev/null
sleep 1

# ── Export env vars for Apache/PHP ───────────────────────────────────────────
cat > /etc/apache2/conf-available/wave-env.conf <<APACHEENV
SetEnv DB_HOST 127.0.0.1
SetEnv DB_NAME ${DB_NAME}
SetEnv DB_USER ${DB_USER}
SetEnv DB_PASS ${DB_PASS}
SetEnv APP_TIMEZONE Africa/Nairobi
APACHEENV
a2enconf wave-env > /dev/null 2>&1 || true

# ── Launch all services via supervisord ───────────────────────────────────────
echo "[APP] Launching supervisord (MariaDB + Apache)..."
exec /usr/bin/supervisord -n -c /etc/supervisor/conf.d/supervisord.conf
