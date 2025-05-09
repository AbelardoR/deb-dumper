<?php
// Add to the top-level plugin file
add_action('admin_notices', 'deb_dumper_check_wp_debug_constants');
add_action('admin_init', 'deb_dumper_check_on_activation');

function deb_dumper_check_wp_debug_constants() {
    if (!current_user_can('manage_options')) return;

    $issues = [];

    if (!defined('WP_DEBUG') || WP_DEBUG !== true) {
        $issues[] = "define('WP_DEBUG', true);";
    }
    if (!defined('WP_DEBUG_LOG') || WP_DEBUG_LOG !== true) {
        $issues[] = "define('WP_DEBUG_LOG', true);";
    }
    if (!defined('WP_DEBUG_DISPLAY') || WP_DEBUG_DISPLAY !== true) {
        $issues[] = "define('WP_DEBUG_DISPLAY', true);";
    }

    if (!empty($issues)) {
        echo '<div class="notice notice-warning"><p><strong>Deb Dumper Warning:</strong><br>';
        echo 'The following constants should be added or set to <code>true</code> in your <code>wp-config.php</code> file:<br><br>';
        echo '<pre>' . implode("\n", $issues) . '</pre>';
        echo '</p></div>';
    }
}

function deb_dumper_check_on_activation() {
    // Just run the admin notice hook manually after activation
    if (get_transient('deb_dumper_just_activated')) {
        delete_transient('deb_dumper_just_activated');
        add_action('admin_notices', 'deb_dumper_check_wp_debug_constants');
    }
}

