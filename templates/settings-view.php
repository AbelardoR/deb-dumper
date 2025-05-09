<?php
$log_file = plugin_dir_path(__DIR__) . 'debug.log';
$log_contents = file_exists($log_file) ? file_get_contents($log_file) : '';
$log_contents = esc_textarea($log_contents);

// Handle clear request
if (isset($_POST['deb_dumper_clear_log']) && check_admin_referer('deb_dumper_clear_log_action')) {
    file_put_contents($log_file, '');
    $log_contents = '';
    echo '<div class="updated"><p>Log cleared.</p></div>';
}


?>
<div class="dd-box-header">
    <h1>Deb Dumper</h1>
</div>

<div class="dd-box">
    <!-- Settings -->
    <div class="dd-box-wrapp" id="dd-settings">
        <h2>Settings</h2>
        <form class="dd-form-fields" method="post" action="options.php">
            <?php
            echo deb_dumper_settings_fields('deb_dumper_settings_group');
            do_settings_sections('deb_dumper_settings_group');
            ?>
            <div class="dd-form-fields">
                <?php
                echo deb_dumper_render_checkbox([
                    'id' => 'logger_is_enabled',
                    'label' => 'Enable Logging',
                    'name' => 'logger_is_enabled',
                ]);

                echo deb_dumper_render_checkbox([
                    'id' => 'dump_is_enabled',
                    'label' => 'Enable on screen dumper',
                    'name' => 'dump_is_enabled',
                ]);
                echo get_submit_button();
                ?>
            </div>
        </form>
    </div>
    <!-- Log Viewer -->
    <div class="dd-box-wrapp" id="dd-Log-Viewer">
        <h2>Log Viewer</h2>
        <form class="dd-form-fields" method="post">
            <div class="dd-form-fields">
                <textarea rows="10" style="width: 100%;" readonly>
                    <?php echo $log_contents; ?>
                </textarea>
                <?php wp_nonce_field('deb_dumper_clear_log_action', '_wpnonce', true, true); ?>
                <p class="submit">
                    <input type="submit" name="deb_dumper_clear_log" class="button button-secondary" value="Clear Log">
                </p>
            </div>
        </form>
    </div>
</div>