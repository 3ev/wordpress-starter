<?php

/*
 * Configure JS.
 *
 * jQuery is included externally (for compatability with plugins), everything
 * else is loaded via Browserify.
 */

add_action('wp_enqueue_scripts', function () {
    $deps = [];

    // jQuery

    wp_deregister_script('jquery');
    wp_enqueue_script('jquery', '//code.jquery.com/jquery-1.11.1.min.js', false, null, true);
    $deps[] = 'jquery';

    // Modernizr (this goes in the head, see http://v3.modernizr.com/docs/#installing)

    $modernizr = '/assets/js/vendor/modernizr.js';
    $modernizrPath = get_template_directory() . $modernizr;
    $modernizrUrl = get_template_directory_uri() . $modernizr;
    $modernizrVersion = filemtime($modernizrPath);
    wp_enqueue_script('modernizr', $modernizrUrl, false, $modernizrVersion, false);

    // Browserify JS

    $file = '/assets/js/compiled.js';
    $path = get_template_directory() . $file;
    $url = get_template_directory_uri() . $file;
    $version = filemtime($path);

    wp_enqueue_script('theme-main', $url, $deps, $version, true);
    wp_localize_script('theme-main', 'themeAjax', ['ajaxurl' => admin_url('admin-ajax.php')]);
});
