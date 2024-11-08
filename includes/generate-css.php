<?php // phpcs:ignore
namespace TTRECURRING;

// if direct access than exit the file.
defined( 'ABSPATH' ) || exit;

/**
 * Handles plugin shortcode.
 *
 * @since 1.0.0
 */
class Generate_CSS {

	/**
	 * Generate CSS
	 *
	 * @param string $selector The CSS selector.
	 * @param mixed  $targets The target elements.
	 * @param string $prop The CSS property.
	 * @param string $value The CSS value.
	 */
	public function generate_css( $selector, $targets, $prop, $value ) {

		$selectors = array();

		if ( gettype( $targets ) !== 'array' ) {
			$targets = array( $targets );
		}

		foreach ( $targets as $target ) {
			$selectors[] = $selector . $target;
		}

		$css = sprintf( '%s{%s:%s}', join( ',', $selectors ), $prop, $value );

		wp_add_inline_style( 'skt_public', $css );
	}

	/**
	 * Generate custom CSS based on settings and shortcode ID.
	 *
	 * @param array $settings The settings array.
	 * @return string The generated CSS.
	 */
	public function generate_custom_css( $settings ) {

		$parent_selector = '.skt-input-field';

		ob_start();

		// if ( ! empty( $settings['review_btn_color'] ) ) {
		// 	$this->generate_css( $parent_selector, ' #skt_modal_btn', 'background', $settings['review_btn_color'] );
		// }


		return ob_get_clean();
	}
}
