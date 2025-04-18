<?php

/*
Plugin Name: Debug Dumper
Description: A plugin that provides a dump function to display variable or object contents in a formatted way.
Version: 1.0
Author: Abelardo Recalde
Author URI:
License: GPL2
*/

/**
 * The function "dump" in PHP is used to display the type and value of a variable in a formatted way,
 * with the option to print the output.
 * The function takes two arguments:
 * @param mixed $code: the variable to be dumped (i.e., its contents will be output)
 * @param $print: an optional boolean argument that defaults to false
 * 
 */

function dump($code, $print = false) {
    $before = '<code class="dump">';
    $before.= '<span class="'.gettype($code).'">';
    $after = '</span>'; 
    $after.= '</code>';
    echo $before;
    ($print) ? print_r($code) : var_dump($code);
    echo $after;  
}


// Enqueue CSS stylesheet
add_action('admin_enqueue_scripts', 'debug_dumper_enqueue_css');

function debug_dumper_enqueue_css() {
    wp_enqueue_style('debug-dumper-css', plugins_url('assets/debug-dumper.css', __FILE__));
}

// Enqueue JavaScript
add_action( 'admin_enqueue_scripts', 'debug_dumper_enqueue_js' );
function debug_dumper_enqueue_js() {
    wp_enqueue_script('debug-dumper-js', plugin_dir_url( __FILE__ ). 'assets/debug-dumper.js', array('jquery'), '1.0', true );
}

// Activate debug mode when the plugin is installed
register_activation_hook(__FILE__, 'debug_dumper_activate');

function debug_dumper_activate() {
    // Check if debug mode is not enabled
    if (!WP_DEBUG) {
        // Define debug constants
        define('WP_DEBUG', true);
        define('WP_DEBUG_LOG', true);
        define('WP_DEBUG_DISPLAY', true);
        @ini_set('display_errors', 1);
    }
}
