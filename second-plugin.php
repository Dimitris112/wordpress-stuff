<?php
/*
Plugin Name: Second Plugin
Plugin URI: http://localhost/
Description: A greeting plugin for testing
Version: 1.0
Author: Dimitris112
Author URI: http://localhost/
License: GPL2
Text Domain: second-plugin
*/

// prevent direct access to the file
if (!defined('WPINC')) {
    exit("Do not access directly");
}

// define constants
define("SECOND_PLUGIN_VERSION", time()); //
define("SECOND_PLUGIN_FILE", __FILE__);
define("SECOND_PLUGIN_DIR", dirname(SECOND_PLUGIN_FILE));
define("SECOND_PLUGIN_URL", plugins_url('', SECOND_PLUGIN_FILE));

// check if the main class exists before including it
if (!class_exists('Second_Plugin')) {
    include_once SECOND_PLUGIN_DIR . '/includes/class-second-plugin.php';
}

$second_plugin = new Second_Plugin(); // initialize it
