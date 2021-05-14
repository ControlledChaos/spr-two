<?php
/**
 * Frontend template tags
 *
 * Call new instance of this class in header files.
 * Use of the `$sprt_tags` variable is recommended
 * to instantiate, where the prefix matches the
 * rest of this theme's prefixes.
 *
 * @package    SPR_Two
 * @subpackage Classes
 * @category   Frontend
 * @since      1.0.0
 */

namespace SPR_Two\Classes\Front;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Layout {

	/**
	 * Constructor magic method
	 *
	 * @since  1.0.0
	 * @access public
	 * @return self
	 */
	public function __construct() {

		// Add main navigation before header.
		add_action( 'SPR_Two\before_header', [ $this, 'navigation_main' ] );

		// Add the default header.
		add_action( 'SPR_Two\header', [ $this, 'page_header' ] );

		// Add the default header.
		add_action( 'SPR_Two\footer', [ $this, 'page_footer' ] );
	}

	/**
	 * Load main navigation
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function navigation_main() {
		get_template_part( 'template-parts/navigation/navigation-main' );
	}

	/**
	 * Load default header
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function page_header() {

		if ( is_front_page() ) {
			get_template_part( 'template-parts/header/header-front-page' );
		} else {
			get_template_part( 'template-parts/header/header-default' );
		}
	}

	/**
	 * Load default footer
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function page_footer() {
		get_template_part( 'template-parts/footer/footer-default' );
	}
}
