<?php
class RSA_Access_Control {
    public function __construct() {
        add_action('template_redirect', [$this, 'check_access']);
    }

    // 访问控制逻辑
    public function check_access() {
        $option = get_option('rsa_restriction_enabled');

        if ('yes' !== $option || $this->is_excluded_page()) {
            return;
        }

        if (!is_user_logged_in()) {
            auth_redirect();
        }
    }

    // 排除特定页面
    private function is_excluded_page() {
        return in_array(
            $GLOBALS['pagenow'],
            ['wp-login.php', 'wp-register.php', 'wp-signup.php']
        );
    }

    // 激活时设置默认选项
    public static function plugin_activation() {
        if (!get_option('rsa_restriction_enabled')) {
            update_option('rsa_restriction_enabled', 'no');
        }
    }

    // 停用时清理选项
    public static function plugin_deactivation() {
        delete_option('rsa_restriction_enabled');
    }
}