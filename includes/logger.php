<?php

if (!defined('ABSPATH')) exit;

/**
 * The function `deb_dumper_is_enabled` checks if the user is an admin and if the option
 * 'deb_dumper_enabled' is set to '1'.
 * 
 * @return boolean
 */
function deb_dumper_is_enabled()
{
    $options = get_option( 'deb_dumper_settings' );
    $option_is_enabled = isset( $options['logger_is_enabled'] ) && $options[ 'logger_is_enabled'] == 'on';
    return is_admin() && $option_is_enabled;
}

/**
 * The function `deb_dumper_log` logs debug information to a file if debugging is enabled.
 * 
 * @param mixed data The `data` parameter in the `deb_dumper_log` function is the information that you want
 * to log for debugging purposes. It can be any variable, array, object, or value that you want to
 * inspect and log to the debug log file.
 * @param string label The parameter in the `deb_dumper_log` function is a string that represents a
 * label or identifier for the log entry. By default, it is set to 'DEBUG', but you can provide a
 * custom label when calling the function to categorize or differentiate different types of log entries
 * in
 * 
 * @return void
 */
function deb_dumper_log($data, $label = 'DEBUG')
{
    if (!deb_dumper_is_enabled()) return;

    $log_file = plugin_dir_path(__DIR__) . 'debug.log';
    $timestamp = date('Y-m-d H:i:s');
    $output = print_r($data, true);
    $entry = "[$timestamp][$label] $output" . PHP_EOL;

    file_put_contents($log_file, $entry, FILE_APPEND);
}
