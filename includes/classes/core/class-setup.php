<?php
/**
 * Theme setup
 *
 * @package    SPR_Two
 * @subpackage Classes
 * @category   Setup
 * @since      1.0.0
 */

namespace SPR_Two\Classes\Core;

// Alias namespaces.
use  SPR_Two\Classes\Core as Core;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Setup {

	/**
	 * Constructor magic method
	 *
	 * @since  1.0.0
	 * @access public
	 * @return self
	 */
	public function __construct() {

		// Theme setup.
		add_action( 'after_setup_theme', [ $this, 'setup' ] );

		// Body element classes.
		add_filter( 'body_class', [ $this, 'body_classes' ] );

		// jQuery UI fallback for HTML5 Contact Form 7 form fields.
		add_filter( 'wpcf7_support_html5_fallback', '__return_true' );

		// Remove WooCommerce styles.
		add_filter( 'woocommerce_enqueue_styles', '__return_false' );

		// Login styles.
		add_action( 'login_enqueue_scripts', [ $this, 'login_styles' ] );

		// Login title.
		add_filter( 'login_headertext', [ $this, 'login_title' ] );

		// Login URL.
		add_filter( 'login_headerurl', [ $this, 'login_url' ] );

		// Login logo.
		add_action( 'login_header', [ $this, 'login_logo' ] );

		// User color scheme classes.
		add_filter( 'body_class', [ $this, 'color_scheme_classes' ] );

		// Print styles to head.
		add_action( 'SPR_Two\after_wp_head', [ $this, 'print_styles_after' ] );
	}

	/**
	 * Theme setup
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function setup() {

		/**
		 * Load domain for translation
		 *
		 * @since 1.0.0
		 */
		load_theme_textdomain( 'spr-two' );

		/**
		 * Add theme support
		 *
		 * @since 1.0.0
		 */

		// Browser title tag support.
		add_theme_support( 'title-tag' );

		// Background color & image support.
		add_theme_support( 'custom-background' );

		// RSS feed links support.
		add_theme_support( 'automatic-feed-links' );

		// HTML 5 tags support.
		add_theme_support( 'html5', [
			'search-form',
			'comment-form',
			'comment-list',
			'gscreenery',
			'caption'
		 ] );

		 // Refresh widgets.
		 add_theme_support( 'customize-selective-refresh-widgets' );

		// Featured image support.
		add_theme_support( 'post-thumbnails' );

		/**
		 * Custom header
		 */
		$default_image = register_default_headers( [
			'kaweah_country' => [
				'url'           => '%s/assets/images/kaweah-country.jpg',
				'thumbnail_url' => '%s/assets/images/kaweah-country.jpg',
				'description'   => __( 'Kaweah Country', 'spr-two' ),
			],
			'river_scene' => [
				'url'           => '%s/assets/images/kaweah-river-scene.jpg',
				'thumbnail_url' => '%s/assets/images/kaweah-river-scene.jpg',
				'description'   => __( 'Kaweah River', 'spr-two' ),
			],
			'high_country_sunset' => [
				'url'           => '%s/assets/images/sunset-from-high-country.jpg',
				'thumbnail_url' => '%s/assets/images/sunset-from-high-country.jpg',
				'description'   => __( 'Sunset View from the High Country', 'spr-two' ),
			],
			'sequoia_trunk' => [
				'url'           => '%s/assets/images/sequoia-trunk.jpg',
				'thumbnail_url' => '%s/assets/images/sequoia-trunk.jpg',
				'description'   => __( 'Sequoia Tree Trunk', 'spr-two' ),
			],
			/*
			'sequoia_trees' => [
				'url'           => '%s/assets/images/sequoia-trees.jpg',
				'thumbnail_url' => '%s/assets/images/sequoia-trees.jpg',
				'description'   => __( 'Sequoia Forest', 'spr-two' ),
			],
			'pacific_waves' => [
				'url'           => '%s/assets/images/pacific-waves.jpg',
				'thumbnail_url' => '%s/assets/images/pacific-waves.jpg',
				'description'   => __( 'Kaweah River', 'spr-two' ),
			],
			'pacific_rocky_shore' => [
				'url'           => '%s/assets/images/pacific-rocky-shore.jpg',
				'thumbnail_url' => '%s/assets/images/pacific-rocky-shore.jpg',
				'description'   => __( 'Kaweah River', 'spr-two' ),
			],
			'moro_rock_snow' => [
				'url'           => '%s/assets/images/moro-rock-snow.jpg',
				'thumbnail_url' => '%s/assets/images/moro-rock-snow.jpg',
				'description'   => __( 'Moro Rock in Snow', 'spr-two' ),
			],
			*/
		] );

		add_theme_support( 'custom-header', apply_filters( 'sprt_custom_header_args', [
			'width'              => 2048,
			'height'             => 878,
			'flex-width'         => false,
        	'flex-height'        => false,
			'default-image'      => $default_image,
			'random-default'     => true,
			'video'              => false,
			'wp-head-callback'   => [ $this, 'header_style' ]
		] ) );

		/**
		 * Custom logo
		 *
		 * @since 1.0.0
		 */

		// Logo arguments.
		$logo_args = [
			'width'       => 160,
			'height'      => 160,
			'flex-width'  => true,
			'flex-height' => true
		];

		// Apply a filter to logo arguments.
		$logo = apply_filters( 'sprt_header_image', $logo_args );

		// Add logo support.
		add_theme_support( 'custom-logo', $logo );

		 /**
		 * Set content width.
		 *
		 * @since 1.0.0
		 */
		$sprt_content_width = apply_filters( 'sprt_content_width', 1440 );

		if ( ! isset( $content_width ) ) {
			$content_width = $sprt_content_width;
		}

		// Embed sizes.
		update_option( 'embed_size_w', 1440 );
		update_option( 'embed_size_h', 810 );

		/**
		 * Register theme menus.
		 *
		 * @since  1.0.0
		 */
		register_nav_menus( [
			'main'   => __( 'Main Menu', 'spr-two' ),
			'hero'   => __( 'Hero Menu', 'spr-two' ),
			'footer' => __( 'Footer Menu', 'spr-two' ),
			'social' => __( 'Social Menu', 'spr-two' )
		] );

		/**
		 * Add stylesheet for the content editor.
		 *
		 * @since 1.0.0
		 */
		add_editor_style( '/assets/css/editor.min.css', [ 'sprt-admin' ], '', 'screen' );
	}

	/**
	 * Body classes
	 *
	 * Adds custom classes to the array of body classes.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array $classes Classes for the body element.
	 * @return array Returns the array of body classes.
	 */
	public function body_classes( $classes ) {

		$classes[] = '';

		// Random theme color class.
		$random = [
			'spr-blue',
			'spr-green',
			'spr-red',
			'spr-yellow'
		];
		$classes[] .= $random[ array_rand( $random ) ];

		// Adds a class of hfeed to non-singular pages.
		if ( ! is_singular() ) {
			$classes[] .= 'hfeed';
		}

		// Add class for the static front page.
		if ( is_front_page() && 'page' == get_option( 'show_on_front' ) ) {
			$classes[] .= 'static-front';
		 }

		// Adds a class of no-sidebar when there is no default sidebar present.
		if (
			! is_active_sidebar( 'default' ) ||
			! is_active_sidebar( 'front-section' ) ||
			is_page_template( [
				'page-templates/no-sidebar.php',
				'page-templates/featured-image-no-sidebar.php'
			] )
		) {
			$classes[] .= ' no-sidebar';
		}

		// Return the modified array of body classes.
		return $classes;
	}

	/**
	 * Style the header image and text
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Returns an HTML style block.
	 *
	 */
	public function header_style() {

		$header_text_color = get_header_textcolor();

		/*
		 * Stop if no custom options for text are set.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text.
		 * Default: add_theme_support( 'custom-header' ).
		 */
		if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
			return;
		}

		if ( ! display_header_text() ) {
			$style = sprintf(
				'<style type="text/css">%1s</style>',
				'.site-title,
				 .site-title a,
				 .site-description {
					position: absolute;
					clip: rect(1px, 1px, 1px, 1px);
				}'
			);

		} else {
			$style = sprintf(
				'<style type="text/css">%1s</style>',
				'.site-title,
				 .site-title a,
				 .site-description {
					color: #' . esc_attr( $header_text_color ) . ';
				}'
			);
		}

		// Print the style block.
		echo $style;
	}

	/**
	 * Login styles
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function login_styles() {

		// Instantiate the Assets class.
		$assets = new Assets;

		wp_enqueue_style( 'sprt-login', get_theme_file_uri( '/assets/css/login' . $assets->suffix() . '.css' ), [], SPRT_VERSION, 'screen' );
	}

	/**
	 * Login URL
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Returns the URL.
	 */
	public function login_url() {
		return site_url( '/' );
	}

	/**
	 * Login title
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Returns the title text.
	 */
	public function login_title() {
		return get_bloginfo( 'name' );
	}

	/**
	 * Login logo
	 */
	public function login_logo() {
		printf(
			'<div class="login-logo"><a href="%s"><img src="%s" alt="%s %s" /></a></div>',
			esc_url( site_url( '/' ) ),
			esc_url( get_theme_file_uri( '/assets/images/sequoia-pacific-web-logo.svg' ) ),
			get_bloginfo( 'name' ),
			__( 'logo', 'spr-two' )
		);
	}

	/**
     * User color scheme classes
	 *
	 * Add a class to the body element according to
	 * the user's admin color scheme preference.
     *
     * @since  1.0.0
	 * @access public
	 * @return array Returns a modified array of body classes.
     */
	public function color_scheme_classes( $classes ) {

		// Add a class if user is logged in and admin bar is showing.
		if ( is_user_logged_in() && is_admin_bar_showing() ) {

			// Get the user color scheme option.
			$scheme = get_user_option( 'admin_color' );

			// Return body classes with `user-color-$scheme`.
			return array_merge( $classes, array( 'user-color-' . $scheme ) );
		}

		// Return the unfiltered classes if user is not logged in.
		return $classes;
	}

	/**
	 * Print styles
	 *
	 * Hooked after 'wp_head()`.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Returns the style blocks.
	 */
	public function print_styles_after() {

		$styles = '<style>';

		if ( is_user_logged_in() && is_admin_bar_showing() ) {
			$styles .= 'html { margin: 0px !important }';
			$styles .= '#wpadminbar { display: none !important }';
		}

		$styles .= '</style>';

		echo $styles;
	}
}
