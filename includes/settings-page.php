<?php

if (!defined('ABSPATH')) exit;

add_action('admin_menu', function () {
    add_options_page(
        'Deb Dumper Settings',
        'Deb Dumper',
        'manage_options',
        'deb-dumper',
        'deb_dumper_settings_page'
    );
});

add_action('admin_init', function () {
    register_setting('deb_dumper_settings_group', 'deb_dumper_settings');
});

add_filter('pre_update_option_deb_dumper_settings', function ($new, $old) {
    if (!empty($old)) {
        return array_merge($old ?? [], $new);
    }
    return $new;
}, 10, 2);

/**
 * Enqueues CSS and JavaScript assets if the dump is enabled.
 */
add_action('admin_enqueue_scripts', 'debug_dumper_enqueue_settings_page');
function debug_dumper_enqueue_settings_page()
{
    wp_enqueue_style('dd-settings-page-style', DEBDUMPER_PLUGIN_URL . 'assets/settings-page.css', [], DEBDUMPER_VERSION, 'all');
    wp_enqueue_script('dd-settings-page-script', DEBDUMPER_PLUGIN_URL . 'assets/settings-page.js', array('jquery'), DEBDUMPER_VERSION, true);
}


/**
 * The function deb_dumper_settings_page includes the settings-view.php template file within a PHP
 * script.
 */
function deb_dumper_settings_page()
{
    include DEBDUMPER_PLUGIN_DIR . 'templates/settings-view.php';
}


/**
 * The function `deb_dumper_settings_fields` generates hidden input fields for WordPress settings
 * fields with proper escaping.
 * 
 * @param array option_group The `option_group` parameter in the `deb_dumper_settings_fields` function is
 * used to generate hidden input fields for WordPress settings fields. It is typically a unique
 * identifier for a group of settings fields, allowing WordPress to handle and save the settings
 * associated with that group.
 * 
 * @return string The function `deb_dumper_settings_fields` returns a string containing hidden input
 * fields for the option page, action, and a WordPress nonce field.
 */
function deb_dumper_settings_fields($option_group): string
{
    $html = "<input type='hidden' name='option_page' value='" . esc_attr($option_group) . "' />";
    $html .= '<input type="hidden" name="action" value="update" />';
    $html .= wp_nonce_field("$option_group-options", '_wpnonce', true, false);
    return $html;
}

/**
 * The function `deb_dumper_render_checkbox` renders a checkbox input with label and handles its
 * checked state based on options in PHP.
 * 
 * @param array args The `deb_dumper_render_checkbox` function takes an array `` as a parameter. Here is
 * what each key in the `` array represents:
 * 
 * @return string The function `deb_dumper_render_checkbox` returns an HTML string that represents a checkbox
 * input field with a label. The checkbox input field is pre-checked based on the value stored in the
 * options for the specified name.
 */
function deb_dumper_render_checkbox($args): string
{
    $options = get_option('deb_dumper_settings');
    $checked = (isset($options[$args['name']]) && $options[$args['name']] == 'on') ? 'checked' : '';
    $html = '<div class="dd-input-checkbox">';
    $html .= '<label for="' . esc_attr($args['id']) . '">' . $args['label'] . ' input</label>';
    $html .= '<input type="hidden" name="deb_dumper_settings[' . esc_attr($args['name']) . ']" value="off" ' . $checked . ' />';
    $html .= '<input type="checkbox" name="deb_dumper_settings[' . esc_attr($args['name']) . ']"  id="' . esc_attr($args['id']) . '" value="on" ' . $checked . ' />';
    $html .= '</div>';
    return $html;
}
