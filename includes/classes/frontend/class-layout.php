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
		add_action( 'SPR_Two\before_header', [ $this, 'main_navigation' ] );

		// Add the default header.
		add_action( 'SPR_Two\header', [ $this, 'default_header' ] );

		// Add the default header.
		add_action( 'SPR_Two\footer', [ $this, 'default_footer' ] );
	}

	/**
	 * Load main navigation
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function main_navigation() {
		include get_theme_file_path( '/template-parts/navigation/main-navigation.php' );
	}

	/**
	 * Load default header
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function default_header() {
		include get_theme_file_path( '/template-parts/header/default-header.php' );
	}

	/**
	 * Load default footer
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function default_footer() {
		include get_theme_file_path( '/template-parts/footer/default-footer.php' );
	}
}
