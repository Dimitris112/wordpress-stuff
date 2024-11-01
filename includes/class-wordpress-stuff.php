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
    {
        // args
        $args = [
            'label' => 'Wordpress Stuff',
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
