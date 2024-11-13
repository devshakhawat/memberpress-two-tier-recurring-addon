<?php // phpcs:ignore
namespace TTRECURRING;



// if direct access than exit the file.
defined( 'ABSPATH' ) || exit;

class Modify_Stripe_Subs {
    
    public function __construct() {
        add_filter( 'mepr_stripe_subscription_args', array( $this, 'modify_stripe_request' ), 20, 3 );
        
    }
       
     
}