#!/bin/bash
# ============================================================
# Loishvizo Boosting Solutions — Deployment Script
# Supports: Ubuntu/Debian VPS, cPanel, Render
# ============================================================

set -e

APP_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
ENV_FILE="$APP_DIR/.env"

echo "=== Loishvizo Boosting Solutions — Deployment ==="

# Load .env if present
if [ -f "$ENV_FILE" ]; then
  export $(grep -v '^#' "$ENV_FILE" | xargs)
  echo "[ENV] Loaded .env"
fi

# Required env vars with defaults
DB_HOST="${DB_HOST:-127.0.0.1}"
DB_USER="${DB_USER:-root}"
DB_PASS="${DB_PASS:-yourpass}"
DB_NAME="${DB_NAME:-smm_free}"
APP_PORT="${PORT:-5000}"
APP_ENV="${APP_ENV:-production}"

echo "[CONFIG] DB=$DB_NAME@$DB_HOST | Port=$APP_PORT | Env=$APP_ENV"

# Check PHP
if ! command -v php &>/dev/null; then
  echo "[ERROR] PHP not found. Install PHP 8.1+"; exit 1
fi
PHP_VER=$(php -r "echo PHP_MAJOR_VERSION.'.'.PHP_MINOR_VERSION;")
echo "[PHP] Version: $PHP_VER"

# Check MySQL/MariaDB
MYSQL_BIN=$(command -v mysql 2>/dev/null || echo "")
if [ -z "$MYSQL_BIN" ]; then
  echo "[WARN] mysql client not found - skipping DB checks"
else
  echo "[DB] Testing connection..."
  if "$MYSQL_BIN" -h "$DB_HOST" -u "$DB_USER" -p"$DB_PASS" "$DB_NAME" -e "SELECT 1;" &>/dev/null; then
    echo "[DB] Connection OK"
    # Import schema if DB is empty
    TABLE_COUNT=$("$MYSQL_BIN" -h "$DB_HOST" -u "$DB_USER" -p"$DB_PASS" "$DB_NAME" -e "SHOW TABLES;" 2>/dev/null | wc -l)
    if [ "$TABLE_COUNT" -lt 5 ]; then
      echo "[DB] Importing schema..."
      "$MYSQL_BIN" -h "$DB_HOST" -u "$DB_USER" -p"$DB_PASS" "$DB_NAME" < _sql/install.sql
      echo "[DB] Schema imported!"
    else
      echo "[DB] Tables exist ($TABLE_COUNT tables found)"
    fi
  else
    echo "[ERROR] Cannot connect to database. Check DB_HOST, DB_USER, DB_PASS, DB_NAME"
    exit 1
  fi
fi

# Create required directories
mkdir -p app/cache app/logs assets/uploads
chmod -R 755 app/cache app/logs assets/uploads

# Set production environment
if [ "$APP_ENV" = "production" ]; then
  echo "[APP] Setting production environment..."
  # Disable debug in production
  if [ -f "app/config.php" ]; then
    sed -i "s/define('ENVIRONMENT', 'development')/define('ENVIRONMENT', 'production')/g" app/config.php 2>/dev/null || true
  fi
fi

echo "[DONE] Deployment ready!"
echo "[START] Run: php -S 0.0.0.0:$APP_PORT -t . router.php"
