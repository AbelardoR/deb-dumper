<?php

if (!defined('ABSPATH')) exit;

/**
 * The function `dump_is_enabled` checks if the user is an admin and if the option 'dump_is_enabled' is
 * set to '1'.
 * 
 * @return boolean
 */
function dump_is_enabled()
{
    $options = get_option( 'deb_dumper_settings' );
    $option_is_enabled = isset( $options['dump_is_enabled'] ) && $options[ 'dump_is_enabled'] == 'on';
    return is_admin() && $option_is_enabled;    
}

/**
 * Enqueues CSS and JavaScript assets if the dump is enabled.
 */
add_action('admin_enqueue_scripts', 'debug_dumper_enqueue_assets');
function debug_dumper_enqueue_assets() {
    if (dump_is_enabled()) {
        wp_enqueue_style('debug-dumper-style', DEBDUMPER_PLUGIN_URL . 'assets/debug-dumper.css', [], DEBDUMPER_VERSION, 'all');
        wp_enqueue_script('debug-dumper-script', DEBDUMPER_PLUGIN_URL. 'assets/debug-dumper.js', array('jquery'), DEBDUMPER_VERSION, true );
    }
}

/**
 * Dumps the given code with syntax highlighting.
 *
 * @param mixed $codes The code to dump.
 * 
 */
function dump(...$codes)
{
    if (!dump_is_enabled()) return;
    
    echo '<code class="dump">';
    foreach ($codes as $code) {
         $type = gettype($code);
        echo '<span class="' . $type . '">';
         var_dump($code);
        echo '</span>';
    }
    echo '</code>';
}


/**
 * Dumps the given code with syntax highlighting.
 *
 * @param mixed $prints The code to dump.
 *
 */
function dump_print(...$prints)
{
    if (!dump_is_enabled()) return;
    
    echo '<code class="dump">';
    foreach ($prints as $code) {
        $type = gettype($code);
        echo '<span class="' . $type . '">';
        print_r($code);
        echo '</span>';
    }
    echo '</code>';
}