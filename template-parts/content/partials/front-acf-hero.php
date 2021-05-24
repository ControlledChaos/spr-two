<?php
/**
 * Front page hero content for ACF
 *
 * @package    SPR_Two
 * @subpackage Templates
 * @category   Content
 * @since      1.0.0
 */

namespace SPR_Two;

// Alias namespaces.
use SPR_Two\Classes\Front as Front;

// Get ACF fields.
$hero_image   = get_field( 'spr_front_hero_image' );
$hero_overlay = get_field( 'spr_hero_overlay' );
$hero_heading = get_field( 'spr_hero_heading' );
$hero_message = get_field( 'spr_hero_message' );

// If the hero image field is not empty.
if ( $hero_image ) {

	// Preferred image size.
	if ( has_image_size( 'x-large-banner' ) ) {
		$hero_size = 'x-large-banner';

	// Fallback image size.
	} else {
		$hero_size = 'large';
	}

	// URL of the hero image from the field.
	$hero_src = $hero_image['sizes'][ $hero_size ];

// Use the header image from the customizer.
} elseif ( has_header_image() ) {
	$hero_src = get_header_image();

// Default hero image, located in assets/images.
} else {

	// URL of the default hero image, located in assets/images.
	$hero_src = get_theme_file_uri( '/assets/images/default-header.jpg' );
}

// Hero image overlay from the field.
if ( $hero_overlay ) {
	$hero_overlay = $hero_overlay;

// Transparent if no overlay field.
} else {
	$hero_overlay = 0;
}

// Get hero heading from the field.
if ( $hero_heading ) {
	$hero_heading = $hero_heading;

// Use the site name if the field is empty.
} else {
	$hero_heading = get_bloginfo( 'name', 'display' );
}

// Get hero message from the field.
if ( $hero_message ) {
	$hero_message = $hero_message;

// Use the following if the field is empty.
} else {
	$hero_message = sprintf(
		'<p>%1s</p>',
		__( 'Three Rivers, Exeter, Porterville, Visalia, and Tulare County, California', 'spr-two' )
	);
}

// Hero loading text.
if ( get_field( 'spr_front_loading_text' ) ) {
	$hero_loading = get_field( 'spr_front_loading_text' );
} else {
	$hero_loading = __( 'Loading&hellip;', 'spr-two' );
}

// Hero loader display conditions.
if ( 'shortcode' === get_field( 'spr_hero_content_display' ) ) {
	$use_shortcode = true;
	$loader_class  = 'hero-has-loader';
} else {
	$use_shortcode =false;
	$loader_class  = 'hero-no-loader';
}

// Down arrow.
$down_arrow = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M441.9 89.7L232.5 299.1c-4.7 4.7-12.3 4.7-17 0L6.1 89.7c-4.7-4.7-4.7-12.3 0-17l19.8-19.8c4.7-4.7 12.3-4.7 17 0L224 233.6 405.1 52.9c4.7-4.7 12.3-4.7 17 0l19.8 19.8c4.7 4.7 4.7 12.3 0 17zm0 143l-19.8-19.8c-4.7-4.7-12.3-4.7-17 0L224 393.6 42.9 212.9c-4.7-4.7-12.3-4.7-17 0L6.1 232.7c-4.7 4.7-4.7 12.3 0 17l209.4 209.4c4.7 4.7 12.3 4.7 17 0l209.4-209.4c4.7-4.7 4.7-12.3 0-17z"/></svg>';

?>
<style>
.front-page-hero { background-image: url( <?php echo $hero_src; ?> ); }
.front-page-hero:before { background: rgba( 0, 0, 0, 0.<?php echo $hero_overlay; ?> ); }
</style>
<div class="front-page-hero">

	<div class="front-page-hero-content <?php echo $loader_class; ?>">

		<h3 class="hero-site-description"><?php echo $hero_heading; ?></h3>

	<?php if ( 'shortcode' === get_field( 'spr_hero_content_display' ) ) : ?>
		<?php echo do_shortcode( get_field( 'spr_hero_shortcode' ) ); ?>
	<?php else : ?>

		<?php echo $hero_message; ?>

		<?php
		$menu = get_field( 'spr_hero_menu' );
		if ( $menu && has_nav_menu( $menu ) ) :
		wp_nav_menu( [
			'theme_location' => $menu,
			'container'      => null,
			'menu_id'        => $menu . '-menu',
			'menu_class'     => 'hero-menu',
			'fallback_cb'    => null,
		] );
		else :
			echo sprintf(
				'<a class="front-page-hero-scroll-content" href="#front-page-content"><span class="screen-reader-text">%s</span> %s</a>',
				__( 'Scroll to content', 'spr-two' ),
				$down_arrow
			);
		endif; ?>
	<?php endif; ?>
	</div>

	<?php if ( $use_shortcode ) : ?>
	<div class="front-page-hero-loader">
		<div class="spinner"></div>
		<div class="loading">
			<p><?php echo $hero_loading; ?></p>
		</div>
	</div>
	<?php endif; ?>
</div>
