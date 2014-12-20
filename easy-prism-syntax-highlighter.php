<?php
/**
 * Easy Prism Syntax Highlither
 *
 * Highlight programming code with Prism.JS script.
 *
 * @package   easy-prism-syntax-highlighter
 * @author    Dmitriy Belyaev <admin@codemotion.ru>
 * @license   GPL-2.0+
 * @link      http://codemotion.ru
 * @copyright 12-17-2014 codemotion
 *
 * @wordpress-plugin
 * Plugin Name: Easy Prism Syntax Highlighter
 * Plugin URI:  http://codemotion.ru
 * Description: Tired to search for normal, easy to install programming code highlight plugin? This one will help you to end this adventure.
 * Version:     1.0.1
 * Author:      Dmitriy Belyaev
 * Author URI:  http://codemotion.ru
 * Text Domain: easy-prism-locale
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /lang
 */

// If this file is called directly, abort.
if (!defined("WPINC")) {
	die;
}

require_once(plugin_dir_path(__FILE__) . "PrismSyntaxHighlither.php");

// Register hooks that are fired when the plugin is activated, deactivated, and uninstalled, respectively.
// register_activation_hook(__FILE__, array("PrismSyntaxHighlither", "activate"));
// register_deactivation_hook(__FILE__, array("PrismSyntaxHighlither", "deactivate"));

PrismSyntaxHighlither::get_instance();