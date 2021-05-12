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

class Template_Tags {

	/**
	 * The class object
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    string
	 */
	protected static $class_object;

	/**
	 * Instance of the class
	 *
	 * This method can be used to call an instance
	 * of the class from outside the class.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object Returns an instance of the class.
	 */
	public static function instance() {

		if ( is_null( self :: $class_object ) ) {
			self :: $class_object = new self();
		}

		// Return the instance.
		return self :: $class_object;
	}

	/**
	 * Constructor magic method
	 *
	 * @since  1.0.0
	 * @access public
	 * @return self
	 */
	public function __construct() {}

	/**
	 * Load the `<head>` section
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function head() {
		do_action( 'SPR_Two\head' );
	}

	/**
	 * Additional hook for scripts & styles
	 *
	 * Triggered after the opening `<body>` tag.
	 *
	 * @link https://make.wordpress.org/themes/2019/03/29/addition-of-new-wp_body_open-hook/
	 * @link https://developer.wordpress.org/reference/functions/wp_body_open/
	 */
	public function body_open() {
		do_action( 'wp_body_open' );
		do_action( 'SPR_Two\body_open' );
	}

	/**
	 * Load the page header
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function header() {
		do_action( 'SPR_Two\header' );
	}

	/**
	 * Load the page footer
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function footer() {
		do_action( 'SPR_Two\footer' );
	}

	/**
	 * Open template tags
	 *
	 * Following are template tags which may be used
	 * by this theme and are provided for further
	 * development by the theme author, child themes,
	 * or plugins.
	 *
	 * These are named generically since template part
	 * of various types may be loaded.
	 *
	 * @todo Possibly add more open tags but perhaps not,
	 *       as this is a starter theme.
	 *
	 * @since  1.0.0
	 * @access public
	 */

	// Fires after opening `body` and before `#page`.
	public function before_page() {
		do_action( 'SPR_Two\before_page' );
	}

	// Fires before `SPR_Two\header`.
	public function before_header() {
		do_action( 'SPR_Two\before_header' );
	}

	// Fires after `SPR_Two\header`.
	public function after_header() {
		do_action( 'SPR_Two\after_header' );
	}

	// Fires before `SPR_Two\footer`.
	public function before_footer() {
		do_action( 'SPR_Two\before_footer' );
	}

	// Fires after `SPR_Two\footer`.
	public function after_footer() {
		do_action( 'SPR_Two\after_footer' );
	}

	// Fires after `#page` and before `wp_footer`.
	public function after_page() {
		do_action( 'SPR_Two\after_page' );
	}

	/**
	 * Site Schema
	 *
	 * Conditional Schema attributes for `<div id="page"`.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Returns the relevant itemtype.
	 */
	public function site_schema() {

		// Change page slugs and template names as needed.
		if ( is_page( 'about' ) || is_page( 'about-us' ) || is_page_template( 'page-about.php' ) || is_page_template( 'about.php' ) ) {
			$itemtype = esc_attr( 'AboutPage' );
		} elseif ( is_page( 'contact' ) || is_page( 'contact-us' ) || is_page_template( 'page-contact.php' ) || is_page_template( 'contact.php' ) ) {
			$itemtype = esc_attr( 'ContactPage' );
		} elseif ( is_page( 'faq' ) || is_page( 'faqs' ) || is_page_template( 'page-faq.php' ) || is_page_template( 'faq.php' ) ) {
			$itemtype = esc_attr( 'QAPage' );
		} elseif ( is_page( 'cart' ) || is_page( 'shopping-cart' ) || is_page( 'checkout' ) || is_page_template( 'cart.php' ) || is_page_template( 'checkout.php' ) ) {
			$itemtype = esc_attr( 'CheckoutPage' );
		} elseif ( is_front_page() || is_page() ) {
			$itemtype = esc_attr( 'WebPage' );
		} elseif ( is_author() || is_plugin_active( 'buddypress/bp-loader.php' ) && bp_is_home() || is_plugin_active( 'bbpress/bbpress.php' ) && bbp_is_user_home() ) {
			$itemtype = esc_attr( 'ProfilePage' );
		} elseif ( is_search() ) {
			$itemtype = esc_attr( 'SearchResultsPage' );
		} else {
			$itemtype = esc_attr( 'Blog' );
		}

		// Print the Schema itemtype.
		echo $itemtype;
	}

	/**
	 * Site logo
	 *
	 * @since  1.0.0
	 * @access public
	 * @return mixed Returns the logo markup or null.
	 */
	public function site_logo( $html = null ) {

		// Get the custom logo URL.
		$logo = get_theme_mod( 'custom_logo' );
		$src  = wp_get_attachment_image_src( $logo , 'full' );

		// Markup if a logo has been set.
		if ( has_custom_logo( get_current_blog_id() ) ) {

			$html = '<div class="site-logo">';

			// Do not link if on the front page.
			if ( is_front_page() ) {

				$html .= sprintf(
					'<img src="%s" />',
					esc_attr( esc_url( $src[0] ) )
				);

			// Linked markup.
			} else {

				$html .= sprintf(
					'<a href="%s"><img src="%s" /></a>',
					esc_attr( esc_url( get_bloginfo( 'url' ) ) ),
					esc_attr( esc_url( $src[0] ) )
				);
			}
			$html .= '</div>';
		}

		// Return the logo markup or null.
		return $html;
	}

	/**
	 * Posted on
	 *
	 * Prints HTML with meta information for the current post-date/time.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Returns the date posted.
	 */
	public function posted_on() {

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'spr-two' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

	}

	/**
	 * Posted by
	 *
	 * Prints HTML with meta information for the current author.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Returns the author name.
	 */
	public function posted_by() {

		$byline = sprintf(
			esc_html_x( 'by %s', 'post author', 'spr-two' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}

	/**
	 * Entry footer
	 *
	 * Prints HTML with meta information for the categories, tags and comments.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Returns various post-related links.
	 */
	public function entry_footer() {

		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {

			$categories_list = get_the_category_list( esc_html__( ', ', 'spr-two' ) );
			if ( $categories_list ) {
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'spr-two' ) . '</span>', $categories_list );
			}

			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'spr-two' ) );

			if ( $tags_list ) {
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'spr-two' ) . '</span>', $tags_list );
			}

		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {

			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'spr-two' ),
						[
							'span' => [
								'class' => [],
							],
						]
					),
					get_the_title()
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					__( ' Edit <span class="screen-reader-text">%s</span>', 'spr-two' ),
					[
						'span' => [
							'class' => [],
						],
					]
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);

	}

	/**
	 * Post thumbnail
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Returns HTML for the post thumbnail.
	 */
	public function post_thumbnail() {

		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		// Check for the large 16:9 video image size.
		if ( has_image_size( 'image-name' ) ) {
			$size = 'large-video';
		} else {
			$size = 'post-thumbnail';
		}

		// Thumbnail image arguments.
		$args = [
			'alt'  => '',
			'role' => 'presentation'
		];


		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail( $size, $args ); ?>
			</div>

			<?php
		else : ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php the_post_thumbnail( $size, $args ); ?>
			</a>

			<?php
		endif;
	}

	/**
	 * Theme toggle script
	 *
	 * Toggles a body class and toggles the
	 * text of the toggle button.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return mixed
	 */
	public function theme_mode_script() {

	?>
		<script>jQuery(document).ready(function(e){var t=e('.theme-toggle');localStorage.theme?(e('body').addClass(localStorage.theme),e(t).text(localStorage.text)):(e('body').addClass('light-mode'),e(t).text('<?php esc_html_e( 'Dark Theme', 'spr-two' ); ?>')),e(t).click(function(){e('body').hasClass('light-mode')?(e('body').removeClass('light-mode').addClass('dark-mode'),e(t).text('<?php esc_html_e( 'Light Theme', 'spr-two' ); ?>'),localStorage.theme='dark-mode',localStorage.text='<?php esc_html_e( 'Light Theme', 'spr-two' ); ?>'):(e('body').removeClass('dark-mode').addClass('light-mode'),e(t).text('<?php esc_html_e( 'Dark Theme', 'spr-two' ); ?>'),localStorage.theme='light-mode',localStorage.text='<?php esc_html_e( 'Dark Theme', 'spr-two' ); ?>')})});</script>
	<?php

	}

	/**
	 * Theme toggle functionality
	 *
	 * Prints the toggle button and adds the
	 * toggle script to the footer.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return mixed
	 */
	public function theme_mode() {

		// Add the toggle script to the footer.
		add_action( 'wp_footer', [ $this, 'theme_mode_script' ] );

		// Toggle button markup.
		$button = sprintf(
			'<button class="theme-toggle" type="button" name="dark_light" title="%1s">%2s</button>',
			esc_html__( 'Toggle light/dark theme', 'spr-two' ),
			esc_html__( 'Light Theme', 'spr-two' )
		);

		// Print the toggle button.
		echo $button;
	}
}

/**
 * Instance of the class
 *
 * @since  1.0.0
 * @access public
 * @return object Template_Tags Returns an instance of the class.
 */
function tags() {
	return Template_Tags :: instance();
}
