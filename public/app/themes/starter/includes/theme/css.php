<?php

/*
 * Include compiled SASS.
 */

add_action('wp_enqueue_scripts', function () {
    $file = '/assets/build/css/main.css';
    $path = get_template_directory() . $file;
    $url = get_template_directory_uri() . $file;
    $version = filemtime($path);

    wp_register_style('theme-main', $url, [], $version);
    wp_enqueue_style('theme-main');
});
