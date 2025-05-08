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

/**
 * Activates WordPress debug mode and displays errors.
 */
register_activation_hook(__FILE__, 'debug_dumper_activate');

function debug_dumper_activate() {
    // Define the WordPress debug constants to activate
    $debugConstants = [
        'WP_DEBUG',
        'WP_DEBUG_LOG',
        'WP_DEBUG_DISPLAY'
    ];

    // Activate each debug constant if it's not already set to true
    foreach ($debugConstants as $constant) {
        if (!defined($constant) || constant($constant) === false) {
            define($constant, true);
        }
    }

    // Enable display of errors if it's currently disabled
    if (ini_get('display_errors') === '0') {
        ini_set('display_errors', '1');
    }
}
