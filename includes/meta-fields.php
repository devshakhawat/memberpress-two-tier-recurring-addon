<?php // phpcs:ignore
namespace TTRECURRING;

// if direct access than exit the file.
defined( 'ABSPATH' ) || exit;

/**
 * Handles plugin shortcode.
 *
 * @since 1.0.0
 */
class Meta_Fields {

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_filter( 'mepr_view_get_string_/admin/products/form', array( $this, 'get_membership_terms' ) );
		add_action( 'save_post', array( $this, 'save_tt_pricing_field' ) );
	}

	/**
	 * Adds membership terms to the view.
	 *
	 * @param string $views The current view content.
	 * @return string The modified view content.
	 */
	public function get_membership_terms( $views ) {

		$tt_payment = get_post_meta( get_the_ID(), 'tt_payment', true );
		$post_meta  = get_post_meta( get_the_ID(), 'mepr_tt_product_price', true );

		ob_start();
		?>

		<div class="mp_second_year inside">
			<div class="tt_switcher">
				<input type="checkbox" id="tt_payment" name="tt_payment" <?php checked( $tt_payment, true ); ?> >
				<label for="tt_payment"><strong><?php esc_html_e( 'Enable Two Tier Payment', 'ttrecurring' ); ?></strong></label>
			</div><br>
			<div class="second_year_price">				
				<strong><?php esc_html__( 'Second Year Price( $ ):', 'ttrecurring' ); ?></strong>			
				<input name="mepr_tt_product_price" id="mepr_tt_product_price" type="text" value="<?php echo esc_attr( $post_meta ); ?>">
			</div>
		</div>

		<?php

		$views .= ob_get_clean();

		return $views;
	}

	/**
	 * Saves the two-tier pricing field.
	 *
	 * @param int $post_id The ID of the post being saved.
	 */
	public function save_tt_pricing_field( $post_id ) {

		if ( ! wp_verify_nonce( ( isset( $_POST['mepr_products_nonce'] ) ) ? $_POST['mepr_products_nonce'] : '', 'mepr_products_nonce' . wp_salt() ) ) {
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

		$enable_tt_payment = ( 'on' === $enable_tt_payment ) ? true : false;

		update_post_meta( $post_id, 'tt_payment', $enable_tt_payment );
		update_post_meta( $post_id, 'mepr_tt_product_price', $tt_recurring_price );
	}
}