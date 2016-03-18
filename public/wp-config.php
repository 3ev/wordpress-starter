<?php

// Enable caching

define('WP_CACHE', true);

// WP config - do not edit, edit config/application.php instead

require_once(dirname(__DIR__) . '/vendor/autoload.php');
require_once(dirname(__DIR__) . '/config/application.php');
require_once(ABSPATH . 'wp-settings.php');
