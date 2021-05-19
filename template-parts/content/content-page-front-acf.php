<?php
/**
 * Template part for displaying page content in front-page.php
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

$intro_content   = get_field( 'spr_intro_content_front' );
$use_image_links = get_field( 'spr_front_image_links_use' );
$links_heading   = get_field( 'spr_front_image_links_heading' );

if ( $links_heading ) {
	$links_heading = $links_heading;
} else {
	$links_heading = __( 'Featured Services', 'seq-pac-theme' );
}

?>

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

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">

	<?php if ( ! $intro_content ) : ?>
	<header class="entry-header">
		<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
	</header>
	<?php endif; ?>

	<div class="entry-content" itemprop="articleBody">

		<?php if ( $intro_content ) : ?>
		<section class="front-intro-content">
			<?php echo $intro_content; ?>
		</section>
		<?php endif; ?>

		<?php
		// Featured listings loop.
		$args = [
			'post_type'     => [ 'listing' ],
			'tag_slug__and' => [ 'featured' ],
			'order'         => 'ASC',
			'orderby'       => 'menu_order'
		];
		$query = new \WP_Query( $args );

		/**
		 * If there is at least one listing marked as featured then
		 * display the Featured Properties section.
		 */
		if ( $query->have_posts() ) : ?>
		<section class="front-featured-properties">
			<h2><?php _e( 'Featured Properties', 'seq-pac-theme' ); ?></h2>
			<ul>
			<?php while ( $query->have_posts() ) : ?>
				<?php $query->the_post();

				// Get the listing fields.

				?>
				<li>
					<div class="featured-details">
						<div>
							<h4><?php the_title(); ?></h4>
							<p class="featured-price">$<?php the_field( 'spl_sale_price' ); ?></p>
							<p class="featured-location"><?php
							// Get the location(s).
							$locations = get_field( 'spl_location' );
							if ( $locations ) {
								foreach ( $locations as $location ) { echo sprintf( '<span class="location">%1s</span>', $location->name ); };
							} else {
								echo sprintf( '<span class="location">%1s</span>', get_field( 'spl_post_office' ) );
							} ?></p>
						</div>
						<div>
							<p class="featured-details-link"><a href="<?php the_permalink(); ?>"><?php _e( 'View Details', 'seq-pac-theme' ); ?></a></p>
						</div>
					</div>
					<p><?php the_field( 'spl_summary' ); ?></p>
					<?php
					// Get the featured image.
					$image = get_field( 'spl_featured_image' );

					// Image variables.
					$url     = $image['url'];
					$title   = $image['title'];
					$alt     = sprintf(
						'%1s | %2s - %3s | %4s%5s',
						esc_html( get_the_title() ),
						'$' . esc_html( get_field( 'spl_sale_price' ) ),
						esc_html( get_field( 'spl_summary' ) ),
						get_field( 'spl_post_office' ),
						__( ', California', 'seq-pac-plugin' )
					);

					// Check for our custom image size in the companion plugin.
					if ( has_image_size( 'wide-large' ) ) {
						$size = 'wide-large';

					// Otherwise use the large size.
					} else {
						$size = 'large';
					}

					// Image size attributes.
					$thumb  = $image['sizes'][$size];
					$width  = $image['sizes'][$size . '-width'];
					$height = $image['sizes'][$size . '-height'];
					$srcset = wp_get_attachment_image_srcset( $image['ID'], $size );
					?>
					<a href="<?php the_permalink(); ?>"><img src="<?php echo $thumb; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" alt="<?php echo $alt; ?>" longdesc="<?php echo esc_url( get_permalink() . '#listing-description' ); ?>" /></a>
				</li>
			<?php endwhile; ?>
			</ul>
		</section>
		<?php else :
			/**
			 * If there are no listings marked as featured then
			 * this section will be ignored.
			 */
		endif;
		// Restore original Post Data
		wp_reset_postdata(); ?>

		<?php if ( $use_image_links ) : ?>
		<section class="front-image-links">
			<h2><?php echo $links_heading; ?></h2>
			<div class="front-image-links-message">
				<?php the_field( 'spr_front_image_links_message' ); ?>
			</div>
			<?php if ( have_rows( 'spr_front_image_links' ) ) : ?>
			<ul>
			<?php while ( have_rows( 'spr_front_image_links' ) ) : the_row();

				// Get fields.
				$image = get_sub_field( 'spr_front_image_link_image' );
				$text  = get_sub_field( 'spr_front_image_link_text' );
				$link  = get_sub_field( 'spr_front_image_link_url' );

				// Image variables.
				$url     = $image['url'];
				$title   = $image['title'];
				$alt     = $image['alt'];

				// Check for our custom image size in the companion plugin.
				if ( has_image_size( 'wide-medium' ) ) {
					$size = 'wide-medium';

				// Otherwise use the medium size.
				} else {
					$size = 'medium';
				}

				// Image size attributes.
				$thumb  = $image['sizes'][$size];
				$width  = $image['sizes'][$size . '-width'];
				$height = $image['sizes'][$size . '-height'];
				$srcset = wp_get_attachment_image_srcset( $image['ID'], $size );
				?>
				<li><a href="<?php echo $link; ?>">
					<figure>
						<img src="<?php echo $thumb; ?>" srcset="<?php echo esc_attr( $srcset ); ?>" sizes="(max-width: 640px) 640px, (max-width: 960px) 960px, 640px" width="<?php echo $width; ?>" height="<?php echo $height; ?>" alt="<?php echo $alt; ?>" />
						<figcaption><?php echo $text; ?></figcaption>
					</figure>
				</a></li>
			<?php endwhile; ?>
			</ul>
			<?php endif; ?>
		</section>
		<?php endif; ?>
	</div>
</article>
