<?php
/*
Plugin Name: Tag Manager Data Layer Plugin
Description: Custom plugin to handle the DataLayer e-commerce measurement
Version: 1.0
Author: Srico
*/

// Enqueue your custom JavaScript
function datalayer_push_javascript() {
    wp_enqueue_script('datalayer-push', plugin_dir_url(__FILE__) . 'datalayer-push.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'datalayer_push_javascript');
