<?php
class RSA_Settings {
    public function __construct() {
        add_action('admin_menu', [$this, 'add_settings_page']);
        add_action('admin_init', [$this, 'register_settings']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_assets']);
    }

    // 添加设置页面
    public function add_settings_page() {
        add_options_page(
            __('Site Access Control', 'restrict-site-access'),
            __('Site Restriction', 'restrict-site-access'),
            'manage_options',
            'restrict-site-access',
            [$this, 'render_settings_page']
        );
    }

    // 注册设置选项
    public function register_settings() {
        register_setting(
            'rsa_settings_group',
            'rsa_restriction_enabled',
            [
                'type' => 'string',
                'sanitize_callback' => 'sanitize_text_field',
                'default' => 'no'
            ]
        );
    }

    // 输出设置页面
    public function render_settings_page() {
        ?>
        <div class="wrap">
            <h1><?php _e('Site Access Control Settings', 'restrict-site-access'); ?></h1>
            <form method="post" action="options.php">
                <?php
                settings_fields('rsa_settings_group');
                do_settings_sections('rsa_settings_group');
                ?>
                <table class="form-table">
                    <tr>
                        <th scope="row">
                            <?php _e('Enable Site Restriction', 'restrict-site-access'); ?>
                        </th>
                        <td>
                            <label>
                                <input type="checkbox" 
                                    name="rsa_restriction_enabled" 
                                    value="yes" 
                                    <?php checked('yes', get_option('rsa_restriction_enabled')); ?>>
                                <?php _e('Require login to access site content', 'restrict-site-access'); ?>
                            </label>
                        </td>
                    </tr>
                </table>
                <?php submit_button(); ?>
            </form>
        </div>
        <?php
    }

    // 加载后台样式
    public function enqueue_admin_assets($hook) {
        if ('settings_page_restrict-site-access' !== $hook) return;
        
        wp_enqueue_style(
            'rsa-admin-css',
            RSA_PLUGIN_URL . 'admin/css/admin.css',
            [],
            RSA_VERSION
        );
    }
}