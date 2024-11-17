<?php // phpcs:ignore

/**
 * Plugin Name: MemberPress Two Tier Recurring Addon
 * Description: this plugin will enhance memberpress plugin features.
 * Version: 1.0
 * Author: Shakhawat
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: ttrecurring
 * Domain Path: /languages
 * Requires Plugins: memberpress
 *
 * @package   Skt_Memberpress
 */

/**
 * Protect direct access
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Defining constants
 */
if ( ! defined( 'SKT_VERSION' ) ) {
	define( 'SKT_VERSION', '1.0.0' );
}
if ( ! defined( 'SKT_PLUGIN_FILE' ) ) {
	define( 'SKT_PLUGIN_FILE', __FILE__ );
}
if ( ! defined( 'SKT_PLUGIN_DIR' ) ) {
	define( 'SKT_PLUGIN_DIR', trailingslashit( plugin_dir_path( SKT_PLUGIN_FILE ) ) );
}
if ( ! defined( 'SKT_PLUGIN_URI' ) ) {
	define( 'SKT_PLUGIN_URI', trailingslashit( plugins_url( '', SKT_PLUGIN_FILE ) ) );
}

/**
 * Load essential files
 */
// require_once SKT_PLUGIN_DIR . 'includes/functions.php'; // phpcs:ignore
require_once SKT_PLUGIN_DIR . 'includes/autoloader.php';
require_once SKT_PLUGIN_DIR . 'includes/plugin.php';
