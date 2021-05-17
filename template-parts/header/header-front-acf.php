<?php
/**
 * The front page header if ACF is active
 *
 * @package    SPR_Two
 * @subpackage Templates
 * @category   Headers
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

// Default hero image, located in assets/images.
} else {

	// URL of the default hero image, located in assets/images.
	$hero_src = get_theme_file_uri( '/assets/images/default-header.jpg' );
}

// Hero image markup.
$hero_image = sprintf(
	'<div id="wp-custom-header" class="wp-custom-header default-builtin-header"><img src="%s" alt="%s"></div>',
	$hero_src,
	__( 'Panoramic view of Three Rivers, California, from Lake Kaweah to the Sierra Nevada Mountains', 'spr-two' )
);

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
		__( 'Three Rivers, Exeter, Porterville, Visalia, and Tulare County, California', 'seq-pac-theme' )
	);
}

?>
<header id="masthead" class="site-header" role="banner" itemscope="itemscope" itemtype="http://schema.org/Organization">

	<div class="site-branding">

		<?php echo Front\tags()->site_logo(); ?>

		<div class="site-title-description">

			<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>

			<?php
			$site_description = get_bloginfo( 'description', 'display' );
			if ( $site_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $site_description; ?></p>
			<?php endif; ?>

		</div>
	</div>

	<div class="front-page-hero">
		<style>.custom-header-media:before { background: rgba(0, 0, 0, 0.<?php echo $hero_overlay; ?>);}</style>

		<div class="front-page-hero-media custom-header-media">
			<?php echo $hero_image; ?>
		</div>

		<div class="front-page-hero-content">

			<div class="global-wrapper">

				<h3 class="hero-site-description"><?php echo $hero_heading; ?></h3>

				<?php echo $hero_message; ?>
			</div>
		</div>
	</div>
</header>
