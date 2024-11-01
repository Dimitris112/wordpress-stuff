<?php
// check if file is accessed directly
if (! defined('WPINC')) {
    exit("Do not access directly");
}


// WordpressStuff class
class WordpressStuff
{
    // use init function instead of constructor
    public function init()
    {
        //add action init
        add_action('init', array($this, 'registerPostType'));
    }

    //register post type
    public function registerPostType()
    {   // generate via Codeium or other - tweaked
        $labels = [
            'name' => 'Wordpress Stuff',
            'singular_name' => 'Wordpress Stuff',
            'menu_name' => 'Wordpress Stuff',
            'name_admin_bar' => 'Wordpress Stuff',
            'add_new' => 'Add New Stuff',
            'add_new_item' => 'Add New Stuff',
            'edit_item' => 'Edit Stuff',
            'new_item' => 'New Stuff',
            'view_item' => 'View Stuff',
            'all_items' => 'All Stuff',
            'search_items' => 'Search Stuff',
            'parent_item_colon' => '',
            'not_found' => 'No Wordpress Stuff found',
            'not_found_in_trash' => 'No Wordpress Stuff found in Trash',
        ];

        // args
        $args = [
            'label' => 'Wordpress Stuff',
            'labels' => $labels,
            'description' => 'Intro to Wordpress Plugins',
            'show_ui' => true, // show in admin dashboard
        ];

        //register
        register_post_type('wordpress-stuff', $args);
    }
}

// initialize
// new WordpressStuff();

$init = new WordpressStuff();
$init->init();
