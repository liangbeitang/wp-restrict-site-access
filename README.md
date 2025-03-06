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

通过简单的开关设置，限制未登录用户访问整个WordPress网站内容，强制跳转至默认登录页面。

== 描述 ==

一个轻量级的内容访问控制插件，主要功能包括：

**核心功能**
- 全局访问限制：一键启用后强制未登录用户跳转至WP登录页面
- 智能排除机制：自动跳过登录/注册/密码重置页面
- 管理员控制：后台提供直观的启用/禁用开关
- 性能优化：零数据库查询增加，轻量级代码架构
- 多语言支持：已包含.pot语言模板文件
- 跨版本兼容：完美支持经典编辑器/Gutenberg区块编辑器

**高级特性**
- 用户状态检测：精准识别已登录用户权限
- 安全防护机制：防止登录页面循环跳转
- 配置持久化：选项设置自动保存至数据库
- 代码规范：100%遵循WordPress插件开发标准

== 安装 ==

1. 通过WordPress插件目录上传ZIP包安装
2. 在后台插件页面激活"Restrict Site Access"
3. 前往「设置」→「Site Restriction」配置选项
4. 勾选"Enable Site Restriction"并保存更改

== 文件结构 ==

```text
restrict-site-access/
├── restrict-site-access.php      - 主入口文件
├── uninstall.php                 - 卸载清理脚本
├── languages/                    - 国际化文件
│   └── restrict-site-access.pot  - 翻译模板
├── includes/                     - 核心代码
│   ├── class-settings.php        - 后台设置模块
│   └── class-access-control.php  - 访问控制引擎
└── admin/                        - 后台资源
    └── css/
        └── admin.css             - 设置页面样式表
