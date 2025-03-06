<?php
if (!defined('WP_UNINSTALL_PLUGIN')) exit;

// 清理插件选项
delete_option('rsa_restriction_enabled');