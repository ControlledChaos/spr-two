<?php
/**
 * Frontend content
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

class Content {

	/**
	 * Constructor magic method
	 *
	 * @since  1.0.0
	 * @access public
	 * @return self
	 */
	public function __construct() {

		// Filter archives title.
		add_filter( 'get_the_archive_title', [ $this, 'archives_title' ] );
	}

	/**
	 * Filter archives title
	 *
	 * Remove prefixes such as "Archives:".
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string $title
	 * @return void
	 */
	public function archives_title( $title ) {

		if ( is_tax() ) {
			$title = single_term_title( '', false );
		} elseif ( is_tag() ) {
			$title = single_tag_title( '', false );
		} elseif ( is_category() ) {
			$title = single_cat_title( '', false );
		} elseif ( is_post_type_archive() ) {
			$title = post_type_archive_title( '', false );
		} elseif ( is_archive() ) {
			$title = post_type_archive_title( '', false );
		}
		return $title;
	}
}
