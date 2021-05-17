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

// Default hero image, located in assets/images.
$hero_src = get_theme_file_uri( '/assets/images/default-header.jpg' );

// Use the header image from the customizer.
if ( has_header_image() ) {
	$header_image = get_custom_header_markup();

// Use the fallback if no header image is set.
} else {
	$header_image = sprintf(
		'<div id="wp-custom-header" class="wp-custom-header default-builtin-header"><img src="%s" alt="%s"></div>',
		$hero_src,
		__( 'Panoramic view of Three Rivers, California, from Lake Kaweah to the Sierra Nevada Mountains', 'spr-two' )
	);
}

// Use the site description/tagline if it is set.
$site_description = get_bloginfo( 'description', 'display' );
if ( $site_description ) {
	$message = $site_description;

// Use the following if the description is empty.
} else {
	$message = sprintf(
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

			<?php if ( $site_description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo $site_description; ?></p>
			<?php endif; ?>

		</div>
	</div>

	<div class="front-page-hero">

		<div class="front-page-hero-media custom-header-media">
			<?php echo $header_image; ?>
		</div>

		<div class="front-page-hero-content">

			<div class="global-wrapper">

			<?php if ( get_bloginfo( 'name', 'display' ) || is_customize_preview() ) : ?>
				<h3 class="hero-site-description"><?php echo get_bloginfo( 'name', 'display' ); ?></h3>
			<?php endif; ?>

				<?php echo $message; ?>
			</div>
		</div>
	</div>
</header>
