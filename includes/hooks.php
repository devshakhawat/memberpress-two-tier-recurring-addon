<?php // phpcs:ignore
namespace TTRECURRING;

// if direct access than exit the file.
defined( 'ABSPATH' ) || exit;


/**
 * Class Hooks
 *
 * Handles AJAX requests for review settings.
 */
class Hooks {

	use Helpers;

	/**
	 * Constructor for the Hooks class.
	 */
	public function __construct() {
		add_filter( 'mepr-admin-memberships-columns', [ $this, 'membership_columns' ] );
		add_action( 'manage_pages_custom_column', [ $this, 'custom_columns' ], 10, 2 );

		add_filter( 'mepr-process-subscription-txn', [ $this, 'test' ], 10, 1 );
	}

	public function membership_columns( $columns ) {
		unset( $columns['url'] );
		$columns['tt_payment']   = esc_html__( 'Recurring from 2nd Year', 'ttrecurring' );
		$columns['url'] 		 = esc_html__( 'URL', 'ttrecurring' );

		return $columns;		
	} 

	public function custom_columns( $column, $post_id ) {

		if(  $column == 'tt_payment' ) {
			$tt_payment = get_post_meta( $post_id, 'mepr_tt_product_price', true );
			echo esc_html( $tt_payment );
		}
		
	} 
	
	public function test( $hello ) {

		pretty_log( $hello, 'hello' );

		
	} 


}
