<?php // phpcs:ignore
namespace TTRECURRING;

// if direct access than exit the file.
defined( 'ABSPATH' ) || exit;

/**
 * Class Modify_Stripe_Subs
 *
 * This class modifies Stripe subscription arguments and endpoints.
 */
class Modify_Stripe_Subs {

	/**
	 * Constructor for Modify_Stripe_Subs class.
	 */
	public function __construct() {

		add_filter( 'mepr_stripe_subs_args', array( $this, 'modify_stripe_args' ), 10, 3 );
		add_filter( 'mepr_stripe_subscription_endpoint', array( $this, 'modify_stripe_endpoint' ), 10, 2 );
	}

	/**
	 * Modify the Stripe subscription arguments.
	 *
	 * @param array  $args     The original subscription arguments.
	 * @param string $endpoint The endpoint being used.
	 * @param mixed  $item2    Additional item for modification.
	 *
	 * @return array The modified subscription arguments.
	 */
	public function modify_stripe_args( $args, $endpoint, $item2 ) {

		if ( empty( $args['items'] || 'subscription_schedules' === $endpoint ) ) {
			return $args;
		}

		$plan1 = $args['items'][0] ?? '';
		$plan2 = $item2 ?? '';

		$current_time         = time();
		$first_phase_end_date = $current_time + ( 365 * 24 * 60 * 60 );

		unset( $args['items'] );
		unset( $args['expand'] );
		unset( $args['payment_behavior'] );
		unset( $args['description'] );
		unset( $args['payment_settings'] );

		$args['start_date'] = $current_time;
		$args['phases']     = array(
			array(
				'items'    => array(
					array(
						'plan'     => $plan1,
						'quantity' => 1,
					),
				),
				'end_date' => $first_phase_end_date,
			),
			array(
				'items'    => array(
					array(
						'plan'     => $plan2,
						'quantity' => 1,
					),
				),
				'end_date' => null,
			),
		);

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
