<?php
/**
 * Plugin Name: Restrict Site Access
 * Plugin URI: https://www.liangbeitang.com/open-source-coding/wp-plugin/restrict-site-access/
 * Description: Restrict site access to logged-in users only.
 * Version: 1.0.0
 * Author: 梁北棠 <contact@liangbeitang.com>
 * Author URI: https://www.liangbeitang.com
 * License: GPL-2.0+
 * Text Domain: restrict-site-access
 * Domain Path: /languages
 */

defined('ABSPATH') || exit;

// 定义插件常量
define('RSA_VERSION', '1.0.0');
define('RSA_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('RSA_PLUGIN_URL', plugin_dir_url(__FILE__));

// 自动加载类文件
spl_autoload_register(function ($class) {
    $prefix = 'RSA_';
    $base_dir = RSA_PLUGIN_DIR . 'includes/';
    
    if (0 !== strpos($class, $prefix)) return;
    
    $relative_class = substr($class, strlen($prefix));
    $file = $base_dir . 'class-' . strtolower(str_replace('_', '-', $relative_class)) . '.php';
    
    if (file_exists($file)) {
        require $file;
    }
});

// 初始化插件
add_action('plugins_loaded', 'rsa_init_plugin');

function rsa_init_plugin() {
    // 加载翻译文件
    load_plugin_textdomain(
        'restrict-site-access',
        false,
        dirname(plugin_basename(__FILE__)) . '/languages/'
    );

    // 实例化核心类
    if (is_admin()) {
        new RSA_Settings();
    }
    
    new RSA_Access_Control();
}

// 注册激活/停用钩子
register_activation_hook(__FILE__, ['RSA_Access_Control', 'plugin_activation']);
register_deactivation_hook(__FILE__, ['RSA_Access_Control', 'plugin_deactivation']);