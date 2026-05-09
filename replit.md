# Loishvizo Boosting Solutions - SMM Panel

## Overview
A Social Media Marketing (SMM) Panel called "Loishvizo Boosting Solutions" built on CodeIgniter 3 (PHP) with HMVC architecture. Users can purchase social media engagement services (followers, likes, views) for TikTok, YouTube, Instagram, Facebook, Twitter/X, Spotify, and more.

## Tech Stack
- **Backend**: PHP 8.2, CodeIgniter 3 (HMVC)
- **Database**: MariaDB (via Nix store)
- **Frontend**: Bootstrap, jQuery, custom themes
- **Server**: PHP built-in server (port 5000)

## Project Structure
- `app/` — CodeIgniter application (controllers, models, views, modules, config)
- `app/modules/` — HMVC modules: auth, admin, order, add_funds, tickets, api, etc.
- `app/config/` — Database, routes, autoload configuration
- `themes/` — Frontend themes
- `assets/` — CSS, JS, images, uploads
- `_sql/install.sql` — Database schema and seed data
- `start.sh` — Replit startup script (MariaDB + PHP server)

## Running the App
The app starts via `bash start.sh` which:
1. Initializes MariaDB from the Nix store on first run
2. Imports the SQL schema from `_sql/install.sql`
3. Starts the PHP built-in server on port 5000

## Database
- **Name**: smm_free
- **Host**: 127.0.0.1 (socket: /tmp/mysql.sock)
- **User**: root
- **Password**: yourpass (set in start.sh as MYSQL_ROOT_PASS)

## Admin Access
- Default admin emails configured in `_sql/install.sql` under `general_staffs`
- Admin panel at `/admin`

## User Preferences
- Keep the existing CodeIgniter 3 HMVC structure
- Use PHP built-in server for development (not Apache)
- MariaDB data stored in `/tmp/mysql_data` (persists across restarts, reset on /tmp wipe)
