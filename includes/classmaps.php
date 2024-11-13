<?php // phpcs:ignore
namespace TTRECURRING;

// if direct access than exit the file.
defined( 'ABSPATH' ) || exit;

return array(
	'Hooks'                    => 'includes/hooks.php',
	'Scripts'                  => 'includes/scripts.php',
	'Template_Loader'          => 'includes/template-loader.php',
	'Helpers'                  => 'includes/helpers.php',
	'Generate_CSS'             => 'includes/generate-css.php',
	'Meta_Fields'              => 'includes/meta-fields.php',
	'Update_Recurrance'        => 'includes/update-recurrance.php',
	'Manage_Columns'           => 'includes/manage-columns.php',
	'Modify_Stripe_Subs'       => 'includes/modify-stripe-subs.php',
);
