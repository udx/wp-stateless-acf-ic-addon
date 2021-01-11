<?php

/**
 * Plugin Name: WP-Stateless - ACF Image Crop
 * Plugin URI: https://udx.io
 * Description: Ensures compatibility with image cropping and WP-Stateless in the Ephemeral mode.
 * Author: UDX
 * Version: 0.0.1
 * Text Domain: wpsacfic
 * Author URI: https://udx.io
 * License: MIT
 * 
 * Copyright 2021 UDX (email: info@udx.io)
 */

namespace WPSL\ACFIC;

add_action('plugins_loaded', function () {
  if (class_exists('wpCloud\StatelessMedia\Compatibility')) {
    require_once 'vendor/autoload.php';
    return new ACFImageCrop();
  }

  add_filter('plugin_row_meta', function ($plugin_meta, $plugin_file, $_, $__) {
    if ($plugin_file !== join(DIRECTORY_SEPARATOR, [basename(__DIR__), basename(__FILE__)])) return $plugin_meta;
    $plugin_meta[] = sprintf('<span style="color:red;">%s</span>', __('This plugin requires WP-Stateless plugin to be installed and active.'));
    return $plugin_meta;
  }, 10, 4);
});
