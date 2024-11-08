<?php // phpcs:ignore
namespace TTRECURRING;

// if direct access than exit the file.
defined( 'ABSPATH' ) || exit;

/**
 * Handles plugin shortcode.
 *
 * @since 1.0.0
 */
class Scripts {

	use Helpers;

	/**
	 * Initialize the class
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'public_enqueue_scripts' ) );
	}

	/**
	 * Enqueue scripts
	 *
	 * @since 1.0.0
	 *
	 * @param string $hook The current admin page.
	 */
	public function admin_enqueue_scripts( $hook ) {

		// Styles.
		wp_enqueue_style( 'skt_admin', SKT_PLUGIN_URI . 'assets/admin/css/admin.min.css', array(), SKT_VERSION );

		// Scripts.
		wp_enqueue_script( 'skt_admin', SKT_PLUGIN_URI . 'assets/admin/js/admin.min.js', array( 'jquery' ), SKT_VERSION, true );

	}

	/**
	 * Enqueue public-facing scripts and styles.
	 *
	 * @since 1.0.0
	 */
	public function public_enqueue_scripts() {

		wp_enqueue_style( 'skt_public', SKT_PLUGIN_URI . 'assets/public/css/public.min.css', array(), SKT_VERSION );
		wp_enqueue_script( 'skt_public', SKT_PLUGIN_URI . 'assets/public/js/public.min.js', array( 'jquery' ), SKT_VERSION, true );

	}

}
