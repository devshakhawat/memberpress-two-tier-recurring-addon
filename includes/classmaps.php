<?php // phpcs:ignore
namespace TTRECURRING;

// if direct access than exit the file.
defined( 'ABSPATH' ) || exit;

return array(
	'Hooks'                => 'includes/hooks.php',
	'Scripts'              => 'includes/scripts.php',
	'Template_Loader'      => 'includes/template-loader.php',
	'Helpers'              => 'includes/helpers.php',
	'Generate_CSS'         => 'includes/generate-css.php',
	'Save_tt_fields'        => 'includes/save-tt-fields.php',
	'Update_Recurrance'    => 'includes/update-recurrance.php',
);
