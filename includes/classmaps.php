<?php // phpcs:ignore
namespace TTRECURRING;

// if direct access than exit the file.
defined( 'ABSPATH' ) || exit;

return array(
	'Scripts'            => 'includes/scripts.php',
	'Helpers'            => 'includes/helpers.php',
	'Generate_CSS'       => 'includes/generate-css.php',
	'Meta_Fields'        => 'includes/meta-fields.php',
	'Update_Recurrance'  => 'includes/update-recurrance.php',
	'Manage_Columns'     => 'includes/manage-columns.php',
	'Modify_Stripe_Subs' => 'includes/modify-stripe-subs.php',
	'Modify_Paypal_Subs' => 'includes/modify-paypal-subs.php',
);
