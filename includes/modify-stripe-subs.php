<?php // phpcs:ignore
namespace TTRECURRING;

// if direct access than exit the file.
defined( 'ABSPATH' ) || exit;

class Modify_Stripe_Subs {

	public function __construct() {

		// add_filter( 'mepr_stripe_subscription_args', array( $this, 'modify_stripe_args' ) );
		add_filter( 'mepr_stripe_subscription_endpoint', array( $this, 'modify_stripe_endpoint' ), 10, 2 );
	}

	public function modify_stripe_args( $args, $renewal_plan ) {

		if ( empty( $args['items'] || $args['metadata'] ) ) {
			return $args;
		}

		$product_id    = $args['metadata']['memberpress_product_id'] ?? '';
		$renewal_price = get_post_meta( $product_id, 'mepr_tt_product_price', true );

		if ( empty( $renewal_price ) ) {
			return $args;
		}

        $plan1  = $args['items'][0] ?? '';
        // $plan2  = $this->get_stripe_plan_id($sub, $prd, $renewal_price);


        $current_time = time();
        $first_phase_end_date = $current_time + (365 * 24 * 60 * 60);		

		unset( $args['items'] );
		unset( $args['expand'] );
		unset( $args['payment_behavior'] );
		unset( $args['description'] );
		unset( $args['payment_settings'] );

		$args['start_date'] = $current_time;
		$args['phases'] = array(
			array(
				'items'    => array(       
					array(                 
					'plan'    => $plan1,
					'quantity' => 1,   
					)                     
				),
				'end_date' => $first_phase_end_date,
			),
			array(
				'items' => array(
					array(
					'plan'    => $plan1,
					'quantity' => 1,     
					),                   
				),
				'end_date' => null,
			),
		);

		pretty_log( $args, 'modified args' );

		return $args;
	}

	/**
	 * Modify the Stripe endpoint.
	 *
	 * @param string $endpoint   The original endpoint.
	 * @param int    $product_id The product ID.
	 *
	 * @return string The modified endpoint.
	 */
	public function modify_stripe_endpoint( $endpoint, $product_id ) {

		$renewal_price = get_post_meta( $product_id, 'mepr_tt_product_price', true );

		if ( ! empty( $renewal_price ) && 'subscriptions' === $endpoint ) {
			$endpoint = 'subscription_schedules';
		}

		return $endpoint;
	}

}
