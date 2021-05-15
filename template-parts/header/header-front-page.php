<?php
/**
 * The front page header
 *
 * @package    SPR_Two
 * @subpackage Templates
 * @category   Headers
 * @since      1.0.0
 */

namespace SPR_Two;

// Alias namespaces.
use SPR_Two\Classes\Front as Front;

$overlay = get_field( 'spr_hero_overlay' );
$message = get_field( 'spr_hero_message' );
$logo    = get_field( 'spr_hero_logo' );

// Default hero image, located in assets/images.
$hero = get_theme_file_uri( '/assets/images/default-header.jpg' );

if ( has_header_image() ) {
	$header_image = get_custom_header_markup();
} else {
	$header_image = sprintf(
		'<div id="wp-custom-header" class="wp-custom-header default-builtin-header"><img src="%s" alt="%s"></div>',
		$hero,
		__( 'Panoramic view of Three Rivers, California, from Lake Kaweah to the Sierra Nevada Mountains', 'spr-two' )
	);
}

if ( $overlay ) {
	$overlay = $overlay;
} else {
	$overlay = 0;
}

if ( $message ) {
	$message = $message;
} else {
	$message = sprintf(
		'<p>%1s</p>',
		__( 'Three Rivers, Exeter, Porterville, Visalia, and Tulare County, California', 'seq-pac-theme' )
	);
}

if ( $logo ) {

	// Image variables.
	$url     = $logo['url'];
	$title   = $logo['title'];
	$alt     = $logo['alt'];

	// Image size attributes.
	$width  = $logo['sizes'][$size . '-width'];
	$height = $logo['sizes'][$size . '-height'];
	$srcset = wp_get_attachment_image_srcset( $logo['ID'], $size );

	$logo  = sprintf(
		'<img class="hero-logo" src="%1s" srcset="%2s" sizes="(max-width: 640px) 640px, (max-width: 960px) 960px, 640px" width="%3s" height="%4s" alt="%5s" />',
		esc_attr( $url ),
		esc_attr( $srcset ),
		esc_attr( $width ),
		esc_attr( $height ),
		esc_attr( $alt )
	);
} else {
	$logo = null;
}

?>
<header id="masthead" class="site-header" role="banner" itemscope="itemscope" itemtype="http://schema.org/Organization">

	<div class="site-branding">

		<?php echo Front\tags()->site_logo(); ?>

		<div class="site-title-description">

			<?php if ( is_front_page() ) : ?>
				<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
				<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_attr( esc_url( get_bloginfo( 'url' ) ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php endif;

			$site_description = get_bloginfo( 'description', 'display' );
			if ( $site_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $site_description; ?></p>
			<?php endif; ?>

		</div>
	</div>

	<div class="front-page-hero">
		<style>.custom-header-media:before { background: rgba(0, 0, 0, 0.<?php echo $overlay; ?>);}</style>

		<div class="front-page-hero-media custom-header-media">
			<?php echo $header_image; ?>
		</div>

		<div class="front-page-hero-content">
			<div class="global-wrapper">
				<?php echo $logo; ?>
				<?php $spr_theme_description = get_bloginfo( 'description', 'display' );
				if ( $spr_theme_description || is_customize_preview() ) : ?>
				<h3 class="site-description"><?php echo $spr_theme_description; ?></h3>
				<?php echo $message; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</header>
