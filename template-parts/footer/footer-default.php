<?php
/**
 * The default header of any page
 *
 * @package    SPR_Two
 * @subpackage Templates
 * @category   Headers
 * @since      1.0.0
 */

namespace SPR_Two;

// Alias namespaces.
use SPR_Two\Classes\Front as Front;

// Copyright HTML.
$copyright = sprintf(
	'<p class="copyright-text" itemscope="itemscope" itemtype="http://schema.org/CreativeWork">&copy; <span class="screen-reader-text">%1s</span><span itemprop="copyrightYear">%2s</span> <span itemprop="copyrightHolder">%3s.</span> %4s.</p>',
	esc_html__( 'Copyright ', 'spr-two' ),
	get_the_time( 'Y' ),
	esc_attr( get_bloginfo( 'name' ) ),
	esc_html__( 'All rights reserved', 'spr-two' )
);

/**
 * Footer background images
 *
 * Uses the gallery fields from the front page and defaults
 * to the header image(s) from the customizer.
 */

// Get the ID of the static front page.
$front_page = get_option( 'show_on_front' );
$front_id   = get_option( 'page_on_front' );
$gallery    = get_field( 'spr_hero_gallery', $front_id );

// Random gallery image.
if ( 'page' == $front_page && $front_id && $gallery ) {

	$random_gallery = array_rand( $gallery, 1 );

	// Preferred image size.
	if ( has_image_size( 'x-large-banner' ) ) {
		$footer_bg_src = $gallery[$random_gallery]['sizes']['x-large-banner'];

	// Fallback image size.
	} else {
		$get_src  = wp_get_attachment_image_src( $gallery[ $random_gallery ]['ID'], 'full' );
		$footer_bg_src = $get_src{0};
	}

// Use the header image from the customizer.
} elseif ( has_header_image() ) {
	$footer_bg_src = get_header_image();

// Default hero image, located in assets/images.
} else {

	// URL of the default hero image, located in assets/images.
	$footer_bg_src = get_theme_file_uri( '/assets/images/kaweah-country.jpg' );
}

?>
<style>
.footer-widgets { background-image: url( <?php echo $footer_bg_src; ?> ); }
<?php if ( ! empty( $footer_bg_src ) ) : ?>
.site-footer { background-color: #2c3e50; }
<?php endif; ?>
</style>
<aside class="footer-widgets">

	<div class="inner">
		<div class="footer-one">
			<?php dynamic_sidebar( 'footer-one' ); ?>
		</div>
		<div class="footer-two">
			<?php dynamic_sidebar( 'footer-two' ); ?>
		</div>
		<div class="footer-one">
			<?php dynamic_sidebar( 'footer-three' ); ?>
		</div>
		<div class="footer-two">
			<?php dynamic_sidebar( 'footer-four' ); ?>
		</div>
	</div>

</aside>
<footer id="colophon" class="site-footer">
	<div class="footer-content global-wrapper footer-wrapper">
			<?php echo apply_filters( 'sprt_footer_copyright', $copyright ); ?>
	</div>
</footer>