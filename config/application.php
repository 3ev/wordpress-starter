<?php

/*
 * Base paths
 */

define('APP_ROOT_DIR', dirname(__DIR__));
define('APP_PUBLIC_DIR', APP_ROOT_DIR . '/public');
define('APP_STORAGE_DIR', APP_ROOT_DIR . '/storage');
define('APP_LOG_DIR', APP_STORAGE_DIR . '/logs');

/*
 * Use Dotenv to set required environment variables and load .env and
 * .env.salts file in root
 */

if (!isset($_ENV)) {
    $_ENV = [];
}

if (file_exists(APP_ROOT_DIR . '/.env')) {
    $confDotenv = new Dotenv\Dotenv(APP_ROOT_DIR);
    $confDotenv->load();
    $confDotenv->required([
        'DB_HOST',
        'DB_NAME',
        'DB_USER',
        'DB_PASSWORD',
        'WP_HOME',
        'WP_SITEURL'
    ]);
}

/*
 * Debugging/errors
 */

define('APP_DEBUG', (boolean) getenv('APP_DEBUG'));

// Always log errors

ini_set('log_errors', 1);
ini_set('error_log', APP_LOG_DIR . '/exceptions.log');

define('WP_DEBUG', true);
define('WP_DEBUG_LOG', false);
define('WP_DEBUG_DISPLAY', APP_DEBUG);
define('SCRIPT_DEBUG', APP_DEBUG);

/*
 * URLs
 */

define('WP_HOME', getenv('WP_HOME'));
define('WP_SITEURL', getenv('WP_SITEURL'));

/*
 * Custom Content Directory (/public/app)
 */

define('CONTENT_DIR', '/app');
define('WP_CONTENT_DIR', APP_PUBLIC_DIR . CONTENT_DIR);
define('WP_CONTENT_URL', WP_HOME . CONTENT_DIR);

/*
 * DB settings
 */

define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');
define('DB_NAME', getenv('DB_NAME'));
define('DB_USER', getenv('DB_USER'));
define('DB_PASSWORD', getenv('DB_PASSWORD'));
define('DB_HOST', getenv('DB_HOST'));
$table_prefix = getenv('DB_PREFIX') ? getenv('DB_PREFIX') : 'wp_';

/*
 * WordPress Localized Language
 * Default: English (GB)
 *
 * A corresponding MO file for the chosen language must be installed to app/languages
 */

define('WPLANG', 'en_GB');
$wp_local_package = 'en_GB';

/*
 * Authentication Unique Keys and Salts
 */

define('AUTH_KEY', getenv('AUTH_KEY'));
define('SECURE_AUTH_KEY', getenv('SECURE_AUTH_KEY'));
define('LOGGED_IN_KEY', getenv('LOGGED_IN_KEY'));
define('NONCE_KEY', getenv('NONCE_KEY'));
define('AUTH_SALT', getenv('AUTH_SALT'));
define('SECURE_AUTH_SALT', getenv('SECURE_AUTH_SALT'));
define('LOGGED_IN_SALT', getenv('LOGGED_IN_SALT'));
define('NONCE_SALT', getenv('NONCE_SALT'));

/*
 * Custom Settings
 */

define('AUTOMATIC_UPDATER_DISABLED', true);
define('DISABLE_WP_CRON', true);
define('DISALLOW_FILE_EDIT', true);

/*
 * Bootstrap WordPress
 */

if (!defined('ABSPATH')) {
    define('ABSPATH', APP_PUBLIC_DIR . '/wp/');
}
