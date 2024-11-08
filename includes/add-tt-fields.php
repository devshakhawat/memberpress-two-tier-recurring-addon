<?php // phpcs:ignore
namespace TTRECURRING;

// if direct access than exit the file.
defined( 'ABSPATH' ) || exit;

/**
 * Handles plugin shortcode.
 *
 * @since 1.0.0
 */
class Add_tt_fields {

	public function __construct() {
        add_action( 'admin_footer', array( $this, 'add_tt_pricing_field' ) );
        add_action( 'save_post', array( $this, 'save_tt_pricing_field' ) );
	}

	public function add_tt_pricing_field() {

        $tt_payment = get_post_meta( get_the_ID(), 'tt_payment', true );
        $post_meta  = get_post_meta( get_the_ID(), 'mepr_tt_product_price', true );

		?>
		<script type="text/javascript">

            jQuery(function($){

                let periodType = $('#_mepr_product_period_type-presets').val();
                add_field( periodType );

                if( $('#tt_payment').is(':checked') ) {
                    $('.second_year_price').show();
                } else {
                    $('.second_year_price').hide();
                }

                $( '#tt_payment' ).on( 'change', function() {
                    if( $(this).is(':checked') ) {
                        $('.second_year_price').show();                        
                    } else {
                        $('.second_year_price').hide();                        
                    }
                });
                
                $('#_mepr_product_period_type-presets').on('change', function() {
                
                    periodType = $(this).val();

                    if(periodType == 'yearly') {
                        add_field( periodType );
                    } else {
                        $( '#mepr-recurring-options' ).find( '.mp_second_year' ).remove();
                    }
                    
                });

                function add_field( periodType ) {

                    if (periodType == 'yearly') {                    
                        $( '#mepr-recurring-options' ).append( '<div class="mp_second_year"><p><input type="checkbox" id="tt_payment" name="tt_payment" <?php if($tt_payment){ echo 'checked'; }?> ><label for="tt_payment"><?php echo esc_html( 'Enable Two Tier Payment', 'ttrecurring' ); ?></label></p><div class="second_year_price"><p><strong><?php esc_html_e('Second Year Price ($):', 'ttrecurring'); ?></strong></p><p><input name="mepr_tt_product_price" id="mepr_tt_product_price" type="text" value="<?php echo esc_attr( $post_meta ); ?>"></p></div></div>' );
                    }
                }

            });
					
		</script>
		<?php
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