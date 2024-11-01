<?php
/*
Plugin Name: My First Plugin
Plugin URI: http://localhost/
Description: A simple plugin for testing
Version: 1.1
Author: Dimitris112
Author URI: http://localhost/
License: GPL2
textdomain: wordpress-stuff
*/


// checks if file is accessed directly
if (! defined('WPINC')) {
    exit("Do not access directly");
}


// define plugin constants
define("WORDPRESS_STUFF_VERSION", time());
define("WORDPRESS_STUFF_FILE", __FILE__); // plugin file
define("WORDPRESS_STUFF_DIR", dirname(WORDPRESS_STUFF_FILE)); // plugin directory
define("WORDPRESS_STUFF_URL", plugins_url('', WORDPRESS_STUFF_FILE)); // plugin url

// var_dump(WORDPRESS_STUFF_VERSION);  - similar to "console.log(WORDPRESS_STUFF_VERSION);" in JS - straight in html


// check if class exists
if (! class_exists('WordpressStuff')) {
    // include the class file

    include_once WORDPRESS_STUFF_DIR . '/includes/class-wordpress-stuff.php';
}
