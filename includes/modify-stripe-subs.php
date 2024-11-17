<?php // phpcs:ignore
namespace TTRECURRING;

use MeprStripeGateway;

// if direct access than exit the file.
defined( 'ABSPATH' ) || exit;

class Modify_Stripe_Subs extends MeprStripeGateway {

	public function __construct() {

		// add_filter( 'mepr_stripe_request_args', array( $this, 'modify_stripe_args' ) );
		// add_filter( 'mepr_stripe_request', array( $this, 'modify_stripe_body' ) );
		// add_filter( 'mepr_stripe_subscription_endpoint', array( $this, 'modify_stripe_endpoint' ), 10, 2 );
	}

	// public function modify_stripe_args( $args ) {

	// if( empty( $args['items'] ) ) {
	// return $args;
	// }

	// $product_id     = $args['metadata']['memberpress_product_id'];
	// $renewal_price  = get_post_meta( $product_id, 'mepr_tt_product_price', true );

	// if( empty( $renewal_price ) ) {
	// return $args;
	// }

	// $data   = $this->get_args_data(  $renewal_price, 'usd', 'year' );
	// $price1 = $this->send_stripe_request('prices', $data, 'post');
	// $price2 = $this->send_stripe_request('prices', $data, 'post');


	// $args['items'] = [
	// 'phases' => [
	// [
	// 'plans' => [
	// [
	// 'price' => $price1,
	// 'quantity' => 1,
	// ]
	// ],
	// 'end_date' => strtotime('+1 year')
	// ],
	// [
	// 'plans' => [
	// [
	// 'price' => $price2,
	// 'quantity' => 1,
	// ],
	// ]
	// ],
	// ],
	// ];


	// return $args;
	// }

	public function modify_stripe_body( $args ) {

		$body = $args['body'];

		if ( empty( $body ) ) {
			return $args;
		}

		pretty_log( $args, 'args' );

		$product_id    = $args['metadata']['memberpress_product_id'];
		$renewal_price = get_post_meta( $product_id, 'mepr_tt_product_price', true );

		$data   = $this->get_args_data( $renewal_price, 'usd', 'year' );
		$price1 = $this->send_stripe_request( 'prices', $data, 'post' );
		$price2 = $this->send_stripe_request( 'prices', $data, 'post' );

		unset( $body['items'] );

		$body['phases'] = array(
			array(
				'plans'    => array(
					array(
						'price'    => $price1,
						'quantity' => 1,
					),
				),
				'end_date' => strtotime( '+1 year' ),
			),
			array(
				'plans' => array(
					array(
						'price'    => $price2,
						'quantity' => 1,
					),
				),
			),
		);

		pretty_log( $args, 'args after' );

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

	/**
	 * Get arguments data for Stripe request.
	 *
	 * @param int    $amount   The amount in cents.
	 * @param string $currency The currency code.
	 * @param string $interval The interval for the subscription.
	 *
	 * @return array The data array for the Stripe request.
	 */
	public function get_args_data( $amount = 1000, $currency = 'usd', $interval = 'year' ) {
		$data = array(
			'unit_amount'  => $amount,
			'currency'     => $currency,
			'recurring'    => array( 'interval' => $interval ),
			'product_data' => array(
				'name' => 'Annual Subscription',
			),
		);

		return $data;
	}
}
