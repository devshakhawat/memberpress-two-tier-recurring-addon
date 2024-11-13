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
		// add_filter( 'mepr_stripe_request', [ $this, 'modify_stripe_request' ] );

		// add_filter( 'mepr_stripe_subscription_args', array( $this, 'modify_stripe_request' ), 20, 3 );
	}

	public function modify_stripe_request( $args, $txn, $sub ) {

		pretty_log( $args, 'args' );
		pretty_log( $txn, 'txn' );
		pretty_log( $sub, 'sub' );


		return $args;
		
	} 

	
}
