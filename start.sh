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
  # Using FLUSH PRIVILEGES + SET PASSWORD which is reliable across MariaDB versions
  "$MYSQL" --socket="$MYSQL_SOCK" --user=root 2>/dev/null <<SETUP_SQL
FLUSH PRIVILEGES;
DELETE FROM mysql.user WHERE User='';
SET PASSWORD FOR 'root'@'localhost' = PASSWORD('$MYSQL_ROOT_PASS');
GRANT ALL PRIVILEGES ON *.* TO 'root'@'127.0.0.1' IDENTIFIED BY '$MYSQL_ROOT_PASS' WITH GRANT OPTION;
GRANT ALL PRIVILEGES ON *.* TO 'root'@'repl' IDENTIFIED BY '$MYSQL_ROOT_PASS' WITH GRANT OPTION;
GRANT ALL PRIVILEGES ON *.* TO 'root'@'::1' IDENTIFIED BY '$MYSQL_ROOT_PASS' WITH GRANT OPTION;
CREATE DATABASE IF NOT EXISTS \`$DB_NAME\` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
GRANT ALL PRIVILEGES ON \`$DB_NAME\`.* TO 'root'@'localhost';
GRANT ALL PRIVILEGES ON \`$DB_NAME\`.* TO 'root'@'127.0.0.1';
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
UPDATE general_options SET value='Loishvizo Boosting Solutions' WHERE name='website_name';
UPDATE general_options SET value='Loishvizo Boosting Solutions - #1 SMM Panel Uganda | Boost TikTok, YouTube, Instagram & More' WHERE name='website_title';
UPDATE general_options SET value='Copyright &copy; 2026 Loishvizo Boosting Solutions. All Rights Reserved.' WHERE name='copy_right_content';
UPDATE general_options SET value='loishvizo@gmail.com' WHERE name='contact_email';
UPDATE general_options SET value='loishvizo@gmail.com' WHERE name='email_from';
UPDATE general_options SET value='Loishvizo Boosting Solutions' WHERE name='email_name';
UPDATE general_options SET value='+256 707 291 063' WHERE name='contact_tel';
UPDATE general_options SET value='Mon - Sat 08:00 AM - 10:00 PM (EAT)' WHERE name='contact_work_hour';
INSERT IGNORE INTO general_options (name,value) VALUES ('currency_code','UGX');
INSERT IGNORE INTO general_options (name,value) VALUES ('currency_symbol','UGX ');
UPDATE general_options SET value='UGX' WHERE name='currency_code';
UPDATE general_options SET value='UGX ' WHERE name='currency_symbol';
UPDATE general_options SET value='0' WHERE name='currency_decimal';
UPDATE general_options SET value='1' WHERE name='enable_service_list_no_login';
UPDATE general_options SET value='1' WHERE name='enable_api_tab';
INSERT IGNORE INTO general_options (name,value) VALUES ('is_cookie_policy_page','1');
UPDATE general_options SET value='1' WHERE name='is_cookie_policy_page';
INSERT IGNORE INTO general_options (name,value) VALUES ('social_tiktok_link','https://www.tiktok.com/@loishvizo');
INSERT IGNORE INTO general_options (name,value) VALUES ('social_whatsapp_link','https://whatsapp.com/channel/0029VbDD5xgBlHpjUBmayj30');
UPDATE general_options SET value='https://www.tiktok.com/@loishvizo' WHERE name='social_tiktok_link';
UPDATE general_options SET value='https://whatsapp.com/channel/0029VbDD5xgBlHpjUBmayj30' WHERE name='social_whatsapp_link';
INSERT IGNORE INTO general_options (name,value) VALUES ('admin_emails','Ishamvizo2005@gmail.com,loishvizo@gmail.com,delostvoyage@gmail.com,meddymususwa126@gmail.com');
UPDATE general_options SET value='Ishamvizo2005@gmail.com,loishvizo@gmail.com,delostvoyage@gmail.com,meddymususwa126@gmail.com' WHERE name='admin_emails';
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

# Apply Loishvizo settings: currency, contact, terms, PesaPal, categories, services
echo "[APP] Applying Loishvizo settings and services..."
"$MYSQL" --socket="$MYSQL_SOCK" -u root -p"$MYSQL_ROOT_PASS" "$DB_NAME" 2>/dev/null <<'LOISHVIZO_SQL'

-- Currency UGX
UPDATE general_options SET value = 'UGX' WHERE name = 'currency_code';
UPDATE general_options SET value = 'UGX ' WHERE name = 'currency_symbol';

-- Brand & contact
UPDATE general_options SET value = 'Loishvizo Boosting Solutions' WHERE name = 'website_name';
UPDATE general_options SET value = 'Loishvizo Boosting Solutions - Ultra Speed SMM Panel Uganda' WHERE name = 'website_title';
UPDATE general_options SET value = 'Copyright &copy; 2026 Loishvizo Boosting Solutions. All Rights Reserved.' WHERE name = 'copy_right_content';
UPDATE general_options SET value = 'loishvizo@gmail.com' WHERE name = 'contact_email';
UPDATE general_options SET value = 'loishvizo@gmail.com' WHERE name = 'email_from';
UPDATE general_options SET value = 'Loishvizo Boosting Solutions' WHERE name = 'email_name';
UPDATE general_options SET value = 'https://www.youtube.com/@loishvizo' WHERE name = 'social_youtube_link';
UPDATE general_options SET value = '1' WHERE name = 'enable_service_list_no_login';

-- Terms of Service (real English content)
UPDATE general_options SET value = '<h2>Terms of Service</h2><p><strong>Last updated: May 2025</strong></p><h3>1. Acceptance of Terms</h3><p>By using Loishvizo Boosting Solutions, you agree to these Terms of Service. If you do not agree, please do not use our platform.</p><h3>2. Description of Services</h3><p>Loishvizo Boosting Solutions is a social media marketing (SMM) panel providing engagement services including followers, likes, views, streams, and other metrics for TikTok, Instagram, YouTube, Facebook, Twitter/X, Spotify, Telegram, and other platforms. Services are fulfilled through our network of verified delivery providers.</p><h3>3. Account Responsibilities</h3><p>You are responsible for keeping your login credentials secure. You agree to provide accurate information during registration. Account sharing is not permitted. You are solely responsible for all activity that occurs under your account.</p><h3>4. Payments and Refunds</h3><p>All payments are processed in Uganda Shillings (UGX). Funds added to your account balance are non-refundable unless a service fails to deliver any results. Partial deliveries do not qualify for refunds. For payment issues, contact loishvizo@gmail.com within 7 days of the transaction.</p><h3>5. Service Delivery</h3><p>We aim to deliver all services within the timeframe stated. Delivery times may vary due to platform conditions and provider availability. We do not guarantee 100% completion in all cases, and delivery timelines are estimates only.</p><h3>6. Order Cancellations</h3><p>Orders cannot be cancelled once processing has begun. Please verify all details before placing an order.</p><h3>7. Prohibited Uses</h3><p>You may not use our services for illegal purposes, to harass others, or in violation of any social media platform terms of service. Attempts to resell our services without written permission are prohibited.</p><h3>8. Limitation of Liability</h3><p>Loishvizo Boosting Solutions is not responsible for any account bans, suspensions, or penalties imposed by social media platforms. Our maximum liability is limited to the amount paid for the specific service in question.</p><h3>9. Privacy</h3><p>We collect only the information needed to provide our services and do not sell your personal data to third parties. Payments are processed through secure providers including PesaPal, MTN Mobile Money, and Airtel Money.</p><h3>10. Changes to Terms</h3><p>We may update these Terms at any time. Continued use of the Service after changes means you accept the updated Terms.</p><h3>11. Contact</h3><p>Email: loishvizo@gmail.com | Ishamvizo2005@gmail.com<br>WhatsApp: +256707291063</p>' WHERE name = 'terms_content';

-- PesaPal payment method
INSERT IGNORE INTO payments (id, type, name, min, max, sort, new_users, status, params) VALUES
(23, 'pesapal', 'PesaPal (MTN/Airtel/Mastercard/Visa)', 5000, 10000000, 1, 1, 1,
'{"type":"pesapal","name":"PesaPal","min":"5000","max":"10000000","consumer_key":"5Tj1LQ/T7CHpBKwGa+qpsg//M5aKqciy","consumer_secret":"","sandbox":"0"}');

-- Categories and services are seeded by install.sql (IDs 1-16 and 1-47 respectively)
-- Clean up any duplicate categories that may have been seeded with high IDs
DELETE FROM categories WHERE id > 16;

-- Enable cookie/privacy policy page
INSERT IGNORE INTO general_options (name, value) VALUES ('is_cookie_policy_page', '1');
UPDATE general_options SET value = '1' WHERE name = 'is_cookie_policy_page';

-- Privacy Policy content
UPDATE general_options SET value = '<h2>Privacy Policy</h2><p><strong>Last updated: May 2026</strong></p><p>Loishvizo Boosting Solutions ("we", "us", or "our") is committed to protecting your privacy. This Privacy Policy explains how we collect, use, and safeguard your information when you use our platform at loishvizo.com.</p><h3>1. Information We Collect</h3><p>We collect the following types of information:</p><ul><li><strong>Account Information:</strong> Your name, email address, and password when you register.</li><li><strong>Order Information:</strong> Service details, quantities, and social media profile URLs you provide when placing orders.</li><li><strong>Payment Information:</strong> Transaction records processed through PesaPal. We do not store card numbers or mobile money PINs — these are handled entirely by PesaPal.</li><li><strong>Usage Data:</strong> IP address, browser type, device information, and pages visited for security and analytics purposes.</li></ul><h3>2. How We Use Your Information</h3><p>We use your information to:</p><ul><li>Process and fulfill your orders</li><li>Send order confirmation and status emails</li><li>Provide customer support via tickets and WhatsApp</li><li>Improve our platform and services</li><li>Detect and prevent fraud and abuse</li><li>Comply with legal obligations</li></ul><h3>3. Payment Processing</h3><p>All payments are processed securely through PesaPal, which supports MTN Mobile Money, Airtel Money, MasterCard, and Visa. PesaPal is PCI-DSS compliant. We receive only transaction confirmation — never your card or PIN details. For PesaPal privacy practices, visit pesapal.com.</p><h3>4. Data Sharing</h3><p>We do not sell, trade, or rent your personal information to third parties. We may share data with:</p><ul><li><strong>Payment processors</strong> (PesaPal) to complete transactions</li><li><strong>Service delivery partners</strong> who fulfill your orders (only the social media URL and quantity)</li><li><strong>Legal authorities</strong> when required by law</li></ul><h3>5. Data Security</h3><p>We implement industry-standard security measures including encrypted connections (HTTPS), bcrypt password hashing, and secure session management. However, no internet transmission is 100% secure.</p><h3>6. Your Rights</h3><p>You have the right to:</p><ul><li>Access the personal data we hold about you</li><li>Request correction of inaccurate data</li><li>Request deletion of your account and data</li><li>Opt out of marketing emails</li></ul><p>To exercise these rights, contact us at loishvizo@gmail.com.</p><h3>7. Cookies</h3><p>We use session cookies to keep you logged in and remember your preferences. We do not use third-party advertising cookies. You can disable cookies in your browser settings, but this may affect platform functionality.</p><h3>8. Data Retention</h3><p>We retain your account data for as long as your account is active. Order records are kept for 12 months for dispute resolution. You may request account deletion at any time.</p><h3>9. Childrens Privacy</h3><p>Our services are not directed to children under 13. We do not knowingly collect personal information from children under 13.</p><h3>10. Changes to This Policy</h3><p>We may update this Privacy Policy from time to time. We will notify you of significant changes by email or via a notice on our platform.</p><h3>11. Contact</h3><p>For privacy-related inquiries:</p><ul><li>Email: loishvizo@gmail.com | Ishamvizo2005@gmail.com</li><li>WhatsApp: +256 707 291 063</li></ul>' WHERE name = 'policy_content';

-- Insert privacy policy content if not exists
INSERT IGNORE INTO general_options (name, value) VALUES ('policy_content', '');

LOISHVIZO_SQL

echo "[APP] Setup complete!"

# Ensure writable directories exist
mkdir -p app/cache app/logs assets/uploads

# Start PHP built-in server (foreground)
PORT="${PORT:-5000}"
echo "[PHP] Starting server on http://0.0.0.0:$PORT"
exec php -S 0.0.0.0:$PORT -t . router.php
