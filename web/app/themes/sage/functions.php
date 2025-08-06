<?php

if (! defined('ABSPATH')) {
    exit;
}

/**
 * Theme functions file
 */

// Load Composer autoloader
require_once __DIR__ . '/vendor/autoload.php';

/**
 * Boot Sage theme with Acorn 4.x
 */
add_action('after_setup_theme', function () {
    Roots\bootloader()->boot();
}, 0);