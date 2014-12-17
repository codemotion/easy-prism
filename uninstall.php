<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * @package   prism-syntax-highlither
 * @author    Dmitriy Belyaev <admin@codemotion.ru>
 * @license   GPL-2.0+
 * @link      http://codemotion.ru
 * @copyright 12-17-2014 codemotion
 */

// If uninstall, not called from WordPress, then exit
if (!defined("WP_UNINSTALL_PLUGIN")) {
	exit;
}

// TODO: Define uninstall functionality here