<?php
// Prevent direct access to the file
if (! defined('WPINC')) {
    exit("Do not access directly");
}

class WordpressStuff
{
    // Set up the plugin's actions
    public function init()
    {
        add_action('init', array($this, 'registerPostType'));
    }

    public function registerPostType()
    {
        // Labels for the custom post type (supports translations)
        // this array will be used to generate the labels for the custom post type
        // in the dashboard, such as the title on the edit screen
        // each key should be a valid argument for the register_post_type() function
        // the values should be strings that will be displayed in the dashboard
        // esc_html__ helps in translating the strings to the correct language - security issues / sanitized before display

        $labels = [
            'name'                  => esc_html__('Wordpress Stuff', 'wordpress-stuff'),
            'singular_name'         => esc_html__('Wordpress Stuff', 'wordpress-stuff'),
            'menu_name'             => esc_html__('Wordpress Stuff', 'wordpress-stuff'),
            'name_admin_bar'        => esc_html__('Wordpress Stuff', 'wordpress-stuff'),
            'add_new'               => esc_html__('Add New Stuff', 'wordpress-stuff'),
            'add_new_item'          => esc_html__('Add New Stuff', 'wordpress-stuff'),
            'edit_item'             => esc_html__('Edit Stuff', 'wordpress-stuff'),
            'new_item'              => esc_html__('New Stuff', 'wordpress-stuff'),
            'view_item'             => esc_html__('View Stuff', 'wordpress-stuff'),
            'all_items'             => esc_html__('All Stuff', 'wordpress-stuff'),
            'search_items'          => esc_html__('Search Stuff', 'wordpress-stuff'),
            'not_found'             => esc_html__('No Wordpress Stuff found', 'wordpress-stuff'),
            'not_found_in_trash'    => esc_html__('No Wordpress Stuff found in Trash', 'wordpress-stuff'),
        ];

        // Settings for the custom post type
        // this array will be used to define the properties of the custom post type
        $args = [
            'label'                 => esc_html__('Wordpress Stuff', 'wordpress-stuff'),
            'labels'                => $labels,
            'description'           => esc_html__('Intro to Wordpress Plugins', 'wordpress-stuff'),
            'public'                => true,  // visible on the front end
            'show_ui'               => true,  // visible in the dashboard
            'show_in_menu'          => true,  // in the dashboard menu
            'capability_type'       => 'post', // acts like a standard post
            'has_archive'           => true,
            'supports'              => ['title', 'editor', 'thumbnail'], // core features
        ];

        // Register the post type
        register_post_type('wordpress-stuff', $args);
    }
}

$init = new WordpressStuff();
$init->init();
