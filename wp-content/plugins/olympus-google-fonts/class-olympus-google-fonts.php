<?php
/**
 * Main Olympus_Google_Fonts Class
 *
 * @package   olympus-google-fonts
 * @copyright Copyright (c) 2018, Danny Cooper
 * @license   http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

/**
 * Main Olympus_Google_Fonts Class
 */
class Olympus_Google_Fonts {

	/**
	 * Initialize plugin.
	 */
	public function __construct() {

		$this->includes();

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ), 1000 ); // ensure our Google Font styles load last.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'customize_controls_enqueue' ) );
		add_action( 'customize_preview_init', array( $this, 'customize_preview_enqueue' ) );

		add_filter( 'plugin_action_links_' . plugin_basename( OGF_DIR_PATH . 'olympus-google-fonts.php' ), array( $this, 'links' ) );

		if ( ! defined( 'OGF_PRO' ) ) {
			add_action( 'customize_register', array( $this, 'remove_pro_sections' ) );
		}

	}

	/**
	 * Load plugin files.
	 */
	public function includes() {

		// Required files for building the Google Fonts URL.
		include OGF_DIR_PATH . 'includes/functions.php';
		include OGF_DIR_PATH . 'includes/class-ogf-fonts.php';

		// Required files for the customizer settings.
		require OGF_DIR_PATH . 'includes/customizer/panels.php';
		include OGF_DIR_PATH . 'includes/customizer/settings.php';
		include OGF_DIR_PATH . 'includes/customizer/output-css.php';

		// Feedback request class.
		include OGF_DIR_PATH . 'includes/class-ogf-feedback.php';

		// Welcome notice class.
		include OGF_DIR_PATH . 'includes/class-ogf-welcome.php';

		// Deactivation class.
		require OGF_DIR_PATH . 'includes/class-ogf-deactivation.php';

	}

	/**
	 * Load plugin textdomain.
	 */
	public function load_textdomain() {

		load_plugin_textdomain( 'olympus-google-fonts', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );

	}

	/**
	 * Enqeue the Google Fonts URL.
	 */
	public function enqueue() {

		$fonts = new OGF_Fonts();

		if ( $fonts->has_custom_fonts() ) {
			wp_enqueue_style( 'olympus-google-fonts', $fonts->build_url(), array(), OGF_VERSION );
		}

	}

	/**
	 * Register control scripts/styles.
	 */
	public function customize_controls_enqueue() {

		wp_enqueue_script( 'ogf-customize-controls', esc_url( OGF_DIR_URL . 'assets/js/customize-controls.js' ), array( 'customize-controls' ), OGF_VERSION, true );
		wp_enqueue_style( 'ogf-customize-controls', esc_url( OGF_DIR_URL . 'assets/css/customize-controls.css' ), array(), OGF_VERSION );

		wp_localize_script( 'ogf-customize-controls', 'ogf_font_array', ogf_fonts_array() );
		wp_localize_script( 'ogf-customize-controls', 'ogf_font_choices', ogf_font_choices_for_select() );

	}

	/**
	 * Load preview scripts/styles.
	 */
	public function customize_preview_enqueue() {

		wp_enqueue_script( 'ogf-customize-preview', esc_url( OGF_DIR_URL . 'assets/js/customize-preview.js' ), array( 'jquery' ), OGF_VERSION, true );

		$elements = array_merge( ogf_get_elements(), ogf_get_custom_elements() );

		wp_localize_script( 'ogf-customize-preview', 'ogf_elements', $elements );

	}

	/**
	 * Add custom links to plugin settings page.
	 *
	 * @param array $links Current links array.
	 */
	public function links( $links ) {

		// Customizer Settings Link.
		$customizer_url = admin_url( 'customize.php?autofocus[panel]=ogf_google_fonts' );

		$settings_link = '<a href="' . esc_url( $customizer_url ) . '">' . esc_html__( 'Settings', 'olympus-google-fonts' ) . '</a>';

		array_push( $links, $settings_link );

		// Upgrade Link.
		$pro_link = '<a href="https://fontsplugin.com?utm_source=wpadmin-settings">' . esc_html__( 'Upgrade to Pro', 'olympus-google-fonts' ) . '</a>';

		array_push( $links, $pro_link );

		return $links;

	}

	/**
	 * Remove pro sections from basic version.
	 *
	 * @param object $wp_customize Access to the $wp_customize object.
	 */
	public function remove_pro_sections( $wp_customize ) {
		$wp_customize->remove_section( 'ogf_custom' );
		$wp_customize->remove_section( 'ogf_advanced__custom' );
	}

}
