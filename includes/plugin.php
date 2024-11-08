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

	public $hooks; // phpcs:ignore
	public $scripts; // phpcs:ignore
	public $generate_css; // phpcs:ignore
	public $video_btn; // phpcs:ignore
	public $admin_menu; // phpcs:ignore
	public $save_video; // phpcs:ignore
	public $display_video; // phpcs:ignore

	/**
	 * Constructor for the class.
	 */
	public function __construct() {

		$this->hooks         = new Hooks();
		$this->scripts       = new Scripts();
		$this->generate_css  = new Generate_CSS();

		new Template_Loader();
		new Add_tt_fields();
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
