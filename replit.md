# Wave Boosting Services — SMM Panel

## Overview
A full-featured Social Media Marketing (SMM) panel platform for Wave Boosting Services / Wave Platforms, Inc. Built on PHP/CodeIgniter 3 + HMVC (MX modules).

## Tech Stack
- **Backend**: PHP 8.2 + CodeIgniter 3 + HMVC (wiredesignz MX)
- **Database**: MariaDB 10.11 (auto-initialized on first run)
- **Frontend**: Bootstrap 4 + custom theme "pergo"
- **Payment Gateway**: LworxPay (Uganda Mobile Money + Cards)

## Running the Application
The workflow `Start application` runs `bash start.sh` which:
1. Initializes MariaDB data directory (first run only)
2. Creates the `smm_free` database and imports `_sql/install.sql`
3. Starts MariaDB on port 3306
4. Starts PHP built-in server on port 5000

## Database Configuration
File: `app/config.php`
- DB_HOST: `127.0.0.1`
- DB_USER: `root`
- DB_PASS: `yourpass`
- DB_NAME: `smm_free`

## Branding
- **Brand Name**: Wave Boosting Services
- **Company**: Wave Platforms, Inc.
- **Copyright**: Copyright © 2025 Wave Platforms, Inc. All Rights Reserved.
- **Hero Image**: Futuristic energy sphere (stored at `assets/images/wave_hero.jpg`)
- **Theme**: pergo (dark purple/blue theme with sphere background)

## Social Links
- TikTok: https://www.tiktok.com/@itsmeddy?_r=1&_t=ZS-95zn8eiI69V
- YouTube: https://www.youtube.com/@Wave-platfoms
- WhatsApp: https://whatsapp.com/channel/0029VbDD5xgBlHpjUBmayj30
- Email: delostvoyage@gmail.com

## Admin Emails
1. delostvoyage@gmail.com (primary)
2. meddymususwa126@gmail.com
3. voyagedelost@gmail.com

## LworxPay Integration
File: `app/modules/add_funds/controllers/lworx.php`
- **Merchant ID**: 9HM1KDrXogew
- **API Key**: qIdFYKwJ3wZL8wyHpbipfxIC2xiv
- **API Secret**: PgNB7OyyB2YXwKuacEVtE18kIF3cLVyp4hCODL
- **Base URL**: https://lworx.ug-web.com/api/v1
- **Modes**: Payment Link (global) and Direct Charge (Uganda MoMo)
- **IPN Endpoint**: `/lworx_ipn` → `add_funds/lworx/ipn/`
- **Admin Config View**: `app/modules/admin/views/payments/integrations/lworx.php`

## Key Files
- `start.sh` — startup script (MariaDB init + PHP server)
- `router.php` — PHP built-in server router
- `_sql/install.sql` — database schema + Wave Boosting Services config
- `app/config.php` — database credentials + encryption key
- `app/config/config.php` — CodeIgniter config (dynamic base_url)
- `themes/pergo/views/index.php` — homepage (sphere hero + social links)
- `themes/pergo/views/blocks/footer.php` — footer block
- `themes/pergo/views/blocks/head.blade.php` — head block (title/favicon)
- `app/modules/add_funds/controllers/lworx.php` — LworxPay gateway
- `app/modules/add_funds/views/lworx/index.php` — LworxPay payment form
- `app/modules/add_funds/views/lworx/check_status.php` — MoMo status page
- `app/modules/admin/views/payments/integrations/lworx.php` — admin config

## MariaDB Data
- Data directory: `/tmp/mysql_data` (persists during session)
- MariaDB binary: `/nix/store/a4jsa8kjdn3wlccj2wkvhxqza38rpxzf-mariadb-server-10.11.13/`
- If `/tmp/mysql_data` is cleared, it re-initializes automatically on next start

## User Account Default
Admin panel: `/admin`
First-time setup may require running install or creating admin via DB if default credentials not set.
