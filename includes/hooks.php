<?php // phpcs:ignore
namespace TTRECURRING;

use function ElementorDeps\DI\get;

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
		add_filter( 'mepr-admin-memberships-columns', array( $this, 'membership_columns' ) );
		add_action( 'manage_pages_custom_column', array( $this, 'custom_columns' ), 10, 2 );
		add_filter( 'mepr_view_get_string_/admin/products/form', array( $this, 'get_membership_terms' ) );
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
}
