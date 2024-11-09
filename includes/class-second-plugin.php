<?php
// prevent direct access to the file
if (!defined('ABSPATH')) {
    exit;
}

class Second_Plugin
{
    public function __construct()
    {
        $this->init();
    }

    // initialize the plugin
    public function init()
    {
        add_shortcode('greeting', array($this, 'greeting_shortcode')); // register the shortcode

        add_action('admin_menu', array($this, 'add_settings_page'));  // add admin settings page

        add_action('admin_init', array($this, 'register_settings')); // register plugin settings
    }

    // shortcode to display greeting
    public function greeting_shortcode()
    {
        return $this->display_greeting();
    }

    // display the greeting message 
    public function display_greeting()
    {
        $logged_in_message = get_option('logged_in_message', 'Welcome back, [username]!');
        $guest_message = get_option('guest_message', 'Welcome, Guest! Please log in.');

        if (is_user_logged_in()) {
            $current_user = wp_get_current_user();
            $message = str_replace('[username]', esc_html($current_user->display_name), $logged_in_message);
        } else {
            $message = $guest_message;
        }

        return "<p>$message</p>";
    }

    // add settings page under the "Settings" menu
    public function add_settings_page()
    {
        add_options_page(
            esc_html__('Second Plugin Settings', 'second-plugin'),
            esc_html__('Second Plugin', 'second-plugin'),
            'manage_options',
            'second-plugin-settings',
            array($this, 'render_settings_page')
        );
    }

    // wp-admin/options.php
    // esc_html -> safe HTML output - escape special HTML characters
    // renders the settings page for the plugin in the WordPress admin area
    // the page is displayed when the user navigates to the "Settings > Second Plugin" menu
    public function render_settings_page()
    {
        echo '<div class="wrap">';
        echo '<h1>' . esc_html__('Second Plugin Settings', 'second-plugin') . '</h1>';
        echo '<form method="post" action="options.php">';

        settings_fields('second_plugin_settings_group');
        do_settings_sections('second-plugin-settings');
        submit_button();

        echo '</form>';
        echo '</div>';
    }


    // registers the two settings we want to store in the WordPress database
    // logged_in_message and guest_message.
    public function register_settings()
    {
        // the first parameter is the name of the group of settings we want to register
        // the second and third parameters are the names of the two settings we want to register
        // the fourth parameter is the callback function to validate the input for the settings
        register_setting('second_plugin_settings_group', 'logged_in_message', array($this, 'validate_settings'));
        register_setting('second_plugin_settings_group', 'guest_message', array($this, 'validate_settings'));

        // the first parameter is the name of the section we want to add
        // the second parameter is the title of the section we want to add
        // the third parameter is the callback function to render the description of the section
        // the fourth parameter is the name of the page we want to add the section to
        add_settings_section(
            'second_plugin_main_section',
            esc_html__('Customize Greeting Messages', 'second-plugin'),
            null,
            'second-plugin-settings'
        );

        // the first parameter is the name of the field we want to add
        // the second parameter is the title of the field we want to add
        // the third parameter is the callback function to render the field
        // the fourth parameter is the name of the page we want to add the field to
        // the fifth parameter is the name of the section we want to add the field to
        add_settings_field(
            'logged_in_message',
            esc_html__('Logged-In User Greeting', 'second-plugin'),
            array($this, 'logged_in_message_callback'),
            'second-plugin-settings',
            'second_plugin_main_section'
        );

        add_settings_field(
            'guest_message',
            esc_html__('Guest Greeting', 'second-plugin'),
            array($this, 'guest_message_callback'),
            'second-plugin-settings',
            'second_plugin_main_section'
        );
    }

    // validate settings
    // it is called when the settings are saved
    // checks if the input for the settings is valid and sanitizes them.
    public function validate_settings($input)
    {
        // check if the input is a string and sanitize it
        if (is_string($input)) {
            // sanitization: remove any HTML tags and special characters to prevent XSS attacks - esc_
            return sanitize_text_field($input);
        }

        // uf the input is not valid, return the original / default value
        return '';
    }

    // esc_ -> sanitize HTML output / safety measures
    // renders the input field for logged-in message
    public function logged_in_message_callback()
    {
        $message = get_option('logged_in_message', 'Welcome back, [username]!');
        echo '<input type="text" name="logged_in_message" value="' . esc_attr($message) . '" style="width: 100%;" />';
    }

    // renders the input field for guest message
    public function guest_message_callback()
    {
        $message = get_option('guest_message', 'Welcome, Guest! Please log in.');
        echo '<input type="text" name="guest_message" value="' . esc_attr($message) . '" style="width: 100%;" />';
    }
}

$second_plugin = new Second_Plugin();
$second_plugin->init();
