<?php // phpcs:ignore
namespace TTRECURRING;

use function ElementorDeps\DI\get;

// if direct access than exit the file.
defined( 'ABSPATH' ) || exit;

class Manage_Columns {

    /**
	 * Constructor for the Hooks class.
	 */
	public function __construct() {
		add_filter( 'mepr-admin-memberships-columns', array( $this, 'membership_columns' ) );
		add_action( 'manage_pages_custom_column', array( $this, 'custom_columns' ), 10, 2 );
	}

    public function membership_columns( $columns ) {
		unset( $columns['url'] );
		$columns['tt_payment'] = esc_html__( 'Recurring from 2nd Year', 'ttrecurring' );
		$columns['url']        = esc_html__( 'URL', 'ttrecurring' );

		return $columns;
	}

	public function custom_columns( $column, $post_id ) {

		if ( $column == 'tt_payment' ) {
			$tt_payment = get_post_meta( $post_id, 'mepr_tt_product_price', true );
			echo esc_html( $tt_payment );
		}
	}

}