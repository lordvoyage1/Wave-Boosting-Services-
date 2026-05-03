# Wave Boosting Services — SMM Panel

## Overview
A full-featured Social Media Marketing (SMM) panel platform for Wave Boosting Services / Wave Platforms, Inc. Built on PHP/CodeIgniter 3 + HMVC (MX modules).

## Tech Stack
- **Backend**: PHP 8.2 + CodeIgniter 3 + HMVC (wiredesignz MX)
- **Database**: MariaDB 10.11 (auto-initialized on first run)
- **Frontend**: Bootstrap 4 + custom theme "pergo"
- **Payment Gateway**: LworxPay (Uganda Mobile Money + Cards)

## Running the Application (Local / Replit)
The workflow `Start application` runs `bash start.sh` which:
1. Initializes MariaDB data directory on first run only
2. Creates the `smm_free` database and imports `_sql/install.sql`
3. **On every start**: verifies the DB exists and re-imports if missing (e.g. after `/tmp` reset)
4. Starts MariaDB on port 3306 and PHP built-in server on port 5000

## Database Configuration
File: `app/config.php` — uses `getenv()` with local fallbacks:
- DB_HOST: `127.0.0.1`
- DB_USER: `root` (Replit) / `smm_user` (Docker)
- DB_PASS: `yourpass` (Replit) / env var (Docker)
- DB_NAME: `smm_free`

## Branding
- **Brand Name**: Wave Boosting Services
- **Company**: Wave Platforms, Inc.
- **Copyright**: Copyright © 2025 Wave Platforms, Inc. All Rights Reserved.
- **Hero Image**: Futuristic energy sphere (stored at `assets/images/wave_hero.jpg`)
- **Theme**: pergo (dark purple/blue theme with sphere background)
- **Logo**: SVG wave icon + text at `assets/images/wave-logo-white.svg`
  - Navbar logo uses dynamic `BASE` URL (no hardcoded host in DB)

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

## Docker / Render Deployment
Files ready for Render.com Docker deployment:
- `Dockerfile` — PHP 8.2-Apache + MariaDB + supervisord
- `docker/entrypoint.sh` — startup: Apache port config, DB init, supervisord launch
- `docker/apache-vhost.conf` — Apache VirtualHost with `APP_PORT` placeholder
- `docker/supervisord.conf` — manages MariaDB + Apache processes
- `docker/php.ini` — PHP settings
- `render.yaml` — Render blueprint (auto-configures service + disk)
- `.dockerignore` — excludes dev artifacts from Docker build

### Render Deployment Steps
1. Push code to GitHub (include the `Dockerfile`)
2. On Render: New → Web Service → Connect GitHub repo
3. Runtime: Docker (auto-detected from Dockerfile)
4. Set env vars in Render dashboard:
   - `DB_USER=smm_user`
   - `DB_PASS=<strong password>`
   - `MYSQL_ROOT_PASSWORD=<strong password>`
   - `PORT=10000` (default)
5. Optional: Add a 1 GB Disk mounted at `/var/lib/mysql` (free tier: ephemeral)

### Docker env vars for PHP (set by entrypoint via Apache SetEnv)
- `DB_HOST`, `DB_NAME`, `DB_USER`, `DB_PASS`, `APP_TIMEZONE`

## HTTPS Handling
`app/config/config.php` detects HTTPS via:
- `$_SERVER['HTTPS']` (direct TLS)
- `HTTP_X_FORWARDED_PROTO` (Render proxy / load balancers)
- `HTTP_X_FORWARDED_SSL`

This ensures `base_url()` returns `https://...` on Render even though the PHP server sees HTTP.

## Key Files
- `start.sh` — startup script (MariaDB init + PHP server)
- `router.php` — PHP built-in server router
- `_sql/install.sql` — database schema + Wave Boosting Services config
- `app/config.php` — database credentials + encryption key (getenv-based)
- `app/config/config.php` — CodeIgniter config (dynamic base_url + HTTPS proxy)
- `themes/pergo/views/index.php` — homepage (sphere hero + social links + wave logo)
- `themes/pergo/views/blocks/footer.php` — footer block
- `themes/pergo/views/blocks/head.blade.php` — head block (title/favicon)
- `app/modules/add_funds/controllers/lworx.php` — LworxPay gateway
- `app/modules/add_funds/views/lworx/index.php` — LworxPay payment form
- `app/modules/add_funds/views/lworx/check_status.php` — MoMo status page
- `app/modules/admin/views/payments/integrations/lworx.php` — admin config
- `assets/images/wave-logo-white.svg` — Wave Boosting Services navbar logo
- `assets/images/wave_hero.jpg` — hero background image

## MariaDB Data
- **Local (Replit)** data directory: `/tmp/mysql_data` (persists during session)
- `start.sh` auto-detects if DB is missing and re-imports schema on every start
- **Docker (Render)** data directory: `/var/lib/mysql` (persistent disk if attached)

## SMM Services
**72 services across 10 categories** (all seeded in `_sql/install.sql`):
1. **TikTok** — Followers, Likes, Views, Comments, Shares, Story Views, Live Views, Saves, Drip-Feed (10 services)
2. **YouTube** — Subscribers, Views, Likes, Comments, Shares, Watch Hours, Drip-Feed, Live Views (10 services)
3. **Instagram** — Followers, Likes, Video Views, Reel Views, Story Views, Comments, Saves, IGTV, Drip-Feed (10 services)
4. **Facebook** — Page Likes, Followers, Post Likes, Comments, Shares, Video Views, Group Members, Events, Reel Views (9 services)
5. **Twitter/X** — Followers, Likes, Retweets, Replies, Impressions, Profile Visits, Spaces Listeners (7 services)
6. **Telegram** — Channel Members, Group Members, Post Views, Reactions, Shares, Drip-Feed (6 services)
7. **Spotify** — Plays, Followers, Monthly Listeners, Playlist Followers, Track Saves (5 services)
8. **SoundCloud** — Plays, Followers, Likes, Comments, Reposts (5 services)
9. **LinkedIn** — Followers, Post Likes, Comments, Profile Views, Connections (5 services)
10. **Website Traffic** — Worldwide, USA, Europe, SEO, Africa (5 services)

Pricing is per 1000 units (e.g. $0.10/1000 views, $1.50/1000 subscribers).

## Admin Panel
- URL: `/admin`
- Default admin credentials set in `_sql/install.sql` (check `general_staffs` table)
- Services page publicly visible (no login required): `enable_service_list_no_login = 1`
