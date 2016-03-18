<?php

// Thumbnail/featured image support

add_theme_support('post-thumbnails');

// Remove [...] from blog excerpts.

add_filter('excerpt_more', function () {
    return '&hellip;';
});
