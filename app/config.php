<?php

define('DB_HOST', getenv('DB_HOST') ?: '127.0.0.1');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') ?: 'yourpass');
define('DB_NAME', getenv('DB_NAME') ?: 'smm_free');
define('TIMEZONE', getenv('APP_TIMEZONE') ?: 'Africa/Nairobi');
define('ENCRYPTION_KEY', getenv('ENCRYPTION_KEY') ?: '202dd507882ef55dbbc23f7e84dcfc8d');
