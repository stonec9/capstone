<?php
/**
 * Output the Google Fonts CSS.
 *
 * @package   olympus-google-fonts
 * @copyright Copyright (c) 2018, Danny Cooper
 * @license   http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

/**
 * Output the font CSS to wp_head.
 */
function ogf_output_css() {
	?>
	<!-- Fonts Plugin CSS - https://fontsplugin.com/ -->
	<style>
		<?php
		foreach ( ogf_get_elements() as $id => $values ) {
			ogf_generate_css( $values['selectors'], $id );
		}
		foreach ( ogf_get_custom_elements() as $id => $values ) {
			ogf_generate_css( $values['selectors'], $id );
		}
		?>
	</style>
	<!-- Fonts Plugin CSS -->
	<?php
}

// Output custom CSS to live site.
add_action( 'wp_head', 'ogf_output_css' );

/**
 * Helper function to build the CSS styles.
 *
 * @param string $selector    The CSS selector to apply the styles to.
 * @param string $option_name The option name to pull from the database.
 */
function ogf_generate_css( $selector, $option_name ) {
	$family      = get_theme_mod( $option_name . '_font', false );
	$font_size   = get_theme_mod( $option_name . '_font_size', false );
	$line_height = get_theme_mod( $option_name . '_line_height', false );
	$weight      = get_theme_mod( $option_name . '_font_weight', false );
	$style       = get_theme_mod( $option_name . '_font_style', false );
	$color       = get_theme_mod( $option_name . '_font_color', false );

	$return = '';

	if ( $family || $font_size || $line_height || $weight || $style || $color ) {

		$return .= $selector . ' {' . PHP_EOL;

		// Return font-family CSS.
		if ( false !== $family && 'default' !== $family ) {

			$stack = ogf_build_font_stack( $family );

			if ( ! empty( $stack ) ) {
				$return .= sprintf(
					'font-family: %s;' . PHP_EOL,
					$stack . ogf_is_forced()
				);
			}
		}

		// Return font-size CSS.
		if ( $font_size ) {
			$return .= sprintf(
				'font-size: %s;' . PHP_EOL,
				absint( $font_size ) . 'px' . ogf_is_forced()
			);
		}

		// Return font line-height CSS.
		if ( $line_height && '0' !== $line_height ) {
			$return .= sprintf(
				'line-height: %s;' . PHP_EOL,
				absint( $line_height ) . ogf_is_forced()
			);
		}

		// Return font-style CSS.
		if ( $style && 'normal' !== $style ) {
			$return .= sprintf(
				'font-style: %s;' . PHP_EOL,
				esc_attr( $style ) . ogf_is_forced()
			);
		}

		// Return font-weight CSS.
		if ( $weight && '0' !== $weight ) {
			$return .= sprintf(
				'font-weight: %s;' . PHP_EOL,
				absint( $weight ) . ogf_is_forced()
			);
		}

		// Return font-color CSS.
		if ( $color ) {
			$return .= sprintf(
				'color: %s;' . PHP_EOL,
				esc_attr( $color ) . ogf_is_forced()
			);
		}

		$return .= ' }' . PHP_EOL;

		echo wp_kses_post( $return );

	}
}

/**
 * Build a font stack using the users font choice.
 *
 * @param  string $font_id The users font choice.
 * @return string The built font stack.
 */
function ogf_build_font_stack( $font_id ) {
	$google_fonts = ogf_fonts_array();

	if ( array_key_exists( $font_id, $google_fonts ) ) {

		$stack = '"' . $google_fonts[ $font_id ]['family'] . '"';

		return $stack;

	}

}

/**
 * Check if the styles should be forced.
 */
function ogf_is_forced() {
	if ( 1 === (int) get_theme_mod( 'ogf_force_styles' ) ) {
		return ' !important';
	}

}
