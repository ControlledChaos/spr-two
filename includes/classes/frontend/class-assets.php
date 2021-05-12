<?php
/**
 * Frontend assets
 *
 * Methods for enqueueing and printing assets
 * such as JavaScript and CSS files.
 *
 * @package    SPR_Two
 * @subpackage Classes
 * @category   Frontend
 * @since      1.0.0
 */

namespace SPR_Two\Classes\Front;

// Alias namespaces.
use  SPR_Two\Classes\Core as Core;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Assets {

	/**
	 * Constructor magic method
	 *
	 * @since  1.0.0
	 * @access public
	 * @return self
	 */
	public function __construct() {

		// Frontend scripts.
		add_action( 'wp_enqueue_scripts', [ $this, 'frontend_scripts' ] );

		// Frontend styles.
		add_action( 'wp_enqueue_scripts', [ $this, 'frontend_styles' ] );
	}

	/**
	 * Frontend scripts
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function frontend_scripts() {

		// Instantiate the Assets class.
		$assets = new Core\Assets;

		// Enqueue jQuery.
		wp_enqueue_script( 'jquery' );

		// Navigation toggle and dropdown.
		wp_enqueue_script( 'sprt-navigation', get_theme_file_uri( '/assets/js/navigation' . $assets->suffix() . '.js' ), [], SPRT_VERSION, true );

		// Skip link focus, for accessibility.
		wp_enqueue_script( 'sprt-skip-link-focus-fix', get_theme_file_uri( '/assets/js/skip-link-focus-fix' . $assets->suffix() . '.js' ), [], SPRT_VERSION, true );

		// FitVids for responsive video embeds.
		wp_enqueue_script( 'sprt-fitvids', get_theme_file_uri( '/assets/js/jquery.fitvids' . $assets->suffix() . '.js' ), [ 'jquery' ], SPRT_VERSION, true );
		wp_add_inline_script( 'sprt-fitvids', 'jQuery(document).ready(function($){ $( ".entry-content" ).fitVids(); });', true );

		// Comments scripts.
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}

	/**
	 * Frontend styles
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function frontend_styles() {

		// Instantiate the Assets class.
		$assets = new Core\Assets;

		// Google fonts.
		// wp_enqueue_style( 'sprt-google-fonts', 'add-url-here', [], 'SPRT_VERSION, 'screen' );

		/**
		 * Theme stylesheet
		 *
		 * This enqueues the minified stylesheet compiled from SASS (.scss) files.
		 * The main stylesheet, in the root directory, only contains the theme header but
		 * it is necessary for theme activation. DO NOT delete the main stylesheet!
		 */
		wp_enqueue_style( 'sprt-theme', get_theme_file_uri( '/assets/css/style' . $assets->suffix() . '.css' ), [], SPRT_VERSION, 'all' );

		// Right-to-left languages.
		if ( is_rtl() ) {
			wp_enqueue_style( 'sprt-theme-rtl', get_theme_file_uri( 'assets/css/style-rtl' . $assets->suffix() . '.css' ), [ 'sprt-theme' ], SPRT_VERSION, 'all' );
		}

		// Block styles.
		if ( function_exists( 'has_blocks' ) ) {
			if ( has_blocks() ) {
				wp_enqueue_style( 'sprt-blocks', get_theme_file_uri( '/assets/css/blocks' . $assets->suffix() . '.css' ), [ 'sprt-theme' ], SPRT_VERSION, 'all' );
			}
		}

		// Print styles.
		wp_enqueue_style( 'sprt-print', get_theme_file_uri( '/assets/css/print' . $assets->suffix() . '.css' ), [], SPRT_VERSION, 'print' );
	}
}
