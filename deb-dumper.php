<?php
/**
 * Plugin Name: Deb Dumper
 * Description: Safe debug dumper with UI to enable logging, view and clear logs.
 * Version: 1.2
 * Author: AbelardoR
 */

if (!defined('ABSPATH')) exit;

// Define plugin constants
define('DEBDUMPER_VERSION', '1.2.0');
define('DEBDUMPER_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('DEBDUMPER_PLUGIN_URL', plugin_dir_url(__FILE__));

// Include functionality
require_once DEBDUMPER_PLUGIN_DIR . 'includes/logger.php';
require_once DEBDUMPER_PLUGIN_DIR . 'includes/dumper.php';
require_once DEBDUMPER_PLUGIN_DIR . 'includes/settings-page.php';
require_once DEBDUMPER_PLUGIN_DIR . 'includes/constants-check.php';

// Register activation hook
register_activation_hook(__FILE__, function () {
    set_transient('deb_dumper_just_activated', true, 30);

    if (deb_dumper_is_enabled()) {
        deb_dumper_log('Deb Dumper plugin activated.', 'INFO');
    }
});
