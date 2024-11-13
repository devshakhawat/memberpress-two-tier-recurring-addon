<?php // phpcs:ignore
namespace TTRECURRING;

// if direct access than exit the file.
defined( 'ABSPATH' ) || exit;

/**
 * Class Plugin
 *
 * @return void
 */
class Plugin {

	/**
	 * Define Instance.
	 *
	 * @var $instance.
	 */
	private static $instance;

	/**
	 * Returns an instance of the Plugin class.
	 *
	 * @return self
	 */
	public static function get_instance() {

		if ( ! self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Constructor for the class.
	 */
	public function __construct() {

		new Hooks();
		new Scripts();
		new Template_Loader();
		new Meta_Fields();
		new Manage_Columns();
		new Modify_Stripe_Subs();
	}
}

/**
 * Returns an instance of the Plugin class.
 *
 * @return self
 */
function plugin() { // phpcs:ignore
	return Plugin::get_instance();
}

add_action(
	'plugins_loaded',
	function () {
		plugin();
	},
	0
);
