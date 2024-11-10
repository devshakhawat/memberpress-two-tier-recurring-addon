<?php // phpcs:ignore
namespace TTRECURRING;

// if direct access than exit the file.
defined( 'ABSPATH' ) || exit;

/**
 * Handles plugin shortcode.
 *
 * @since 1.0.0
 */
class Save_tt_fields {

	public function __construct() {        
        add_action( 'save_post', array( $this, 'save_tt_pricing_field' ) );
	}

    public function save_tt_pricing_field( $post_id ) {

        if ( ! wp_verify_nonce( ( isset( $_POST[ 'mepr_products_nonce' ] ) ) ? $_POST[ 'mepr_products_nonce' ] : '', 'mepr_products_nonce' . wp_salt() ) ) {
			return $post_id;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}

		if ( defined( 'DOING_AJAX' ) ) {
			return;
		}

        $enable_tt_payment = ( isset( $_POST['tt_payment'] ) ) ? sanitize_text_field( $_POST['tt_payment'] ) : '';

        $tt_recurring_price = ( isset( $_POST['mepr_tt_product_price'] ) ) ? sanitize_text_field( $_POST['mepr_tt_product_price'] ) : '';

        $enable_tt_payment = ( $enable_tt_payment == 'on' ) ? true : false;

        update_post_meta( $post_id, 'tt_payment', $enable_tt_payment );
        update_post_meta( $post_id, 'mepr_tt_product_price', $tt_recurring_price );        
    } 
}