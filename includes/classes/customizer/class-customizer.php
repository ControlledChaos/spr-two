<?php
/**
 * Theme Customizer
 *
 * @package    SPR_Two
 * @subpackage Classes
 * @category   Customizer
 */

namespace SPR_Two\Classes\Customize;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Customizer {

	/**
	 * Constructor magic method
	 *
	 * @since  1.0.0
	 * @access public
	 * @return self
	 */
	public function __construct() {

		// Remove sections from the customizer.
		add_action( 'customize_register', [ $this, 'remove_customize' ] );
	}

	/**
	 * Remove sections from the customizer
	 *
	 * Try to allow access to select customizer sections
	 * only for Greg Sweet. I normally wouldn't do this
	 * but there has been some negative interference with
	 * the website so this is website security,
	 * not job security.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object $wp_customize The customizer class.
	 * @return void
	 */
	public function remove_customize( $wp_customize ) {

		// Get data for Greg Sweet.
		$user_name  = get_user_by( 'login', 'CCDzine' );
		$user_email = get_user_by( 'email', 'greg@ccdzine.com' );

		// Remove if not Greg Sweet or a user with `develop` capabilities.
		if ( ! current_user_can( 'develop' ) || ! $user_name || ! $user_email ) {
			$wp_customize->remove_panel( 'themes' );
			$wp_customize->remove_section( 'colors' );
			$wp_customize->remove_section( 'custom_css' );
			$wp_customize->remove_control( 'custom_logo' );
			$wp_customize->remove_control( 'site_icon' );
		}

		// This just clutters up the UI. Go to Reading Settings.
		$wp_customize->remove_section( 'static_front_page' );
	}
}
