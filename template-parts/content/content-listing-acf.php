<?php
/**
 * Listing post type content for ACF
 *
 * @package    SPR_Two
 * @subpackage Templates
 * @category   Content
 * @since      1.0.0
 */

// Bail if Advanced Custom Fields is not active.
if ( ! class_exists( 'acf' ) ) {
	return;
}

// Get the featured image.
$image = get_field( 'spl_featured_image' );

// Image variables.
$url     = $image['url'];
$title   = $image['title'];
$alt     = $image['alt'];

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

// Google map.
$map = get_field( 'spl_google_map' );

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<h3 class="listing-address">
			<?php the_field( 'spl_street_address' ); ?>
			<?php the_field( 'spl_suite' ); ?>
			<?php the_field( 'spl_post_office' ); ?>
			<?php _e( 'CA' ); ?>
			<?php the_field( 'spl_zip_code' ); ?>
		</h3>
		<p class="listing-type"><?php
		// Get the type(s).
		$types = get_field( 'spl_listing_type' );
		if ( $types ) {
			foreach ( $types as $type ) { echo sprintf( '<span class="type">%1s</span>', $type->name ); };
		} else {
			echo '';
		} ?></p>
		<h3 class="listing-price">$<?php the_field( 'spl_sale_price' ); ?></h3>
		<img class="listing-featured-image" src="<?php echo $thumb; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" alt="<?php echo $alt; ?>" />
	</header>

	<div itemprop="articleBody">

		<div id="listing-description" class="listing-description">
			<h2><?php _e( 'Listing Description', 'seq-pac-theme' ); ?></h2>
			<?php the_field( 'spl_description' ); ?>
		</div>

		<div id="listing-details" class="listing-details">
			<h2><?php _e( 'Listing Details', 'seq-pac-theme' ); ?></h2>
			<div class="listing-details-list four-wide top">
				<span><strong><?php _e( 'Square Footage:', 'seq-pac-theme' ); ?></strong> <?php the_field( 'spl_square_footage' ); ?></span>
				<span><strong><?php _e( 'Lot Size:', 'seq-pac-theme' ); ?></strong> <?php the_field( 'spl_acreage' ); ?></span>
				<span><strong><?php _e( 'Parcels:', 'seq-pac-theme' ); ?></strong> <?php the_field( 'spl_parcels' ); ?></span>
				<span><strong><?php _e( 'Year Built:', 'seq-pac-theme' ); ?></strong> <?php the_field( 'spl_year_built' ); ?></span>
			</div>

			<div class="listing-details-list four-wide">
				<span><strong><?php _e( 'Stories:', 'seq-pac-theme' ); ?></strong> <?php the_field( 'spl_stories' ); ?></span>
				<span><strong><?php _e( 'Bedrooms:', 'seq-pac-theme' ); ?></strong> <?php the_field( 'spl_bedrooms' ); ?></span>
				<span><strong><?php _e( 'Bathrooms:', 'seq-pac-theme' ); ?></strong> <?php the_field( 'spl_bathrooms' ); ?></span>
				<span><strong><?php _e( 'Garage Spaces:', 'seq-pac-theme' ); ?></strong> <?php the_field( 'spl_garage_spaces' ); ?></span>
			</div>

			<div class="listing-details-list four-wide">
				<span><strong><?php _e( 'Cooling:', 'seq-pac-theme' ); ?></strong> <?php the_field( 'spl_cooling' ); ?></span>
				<span><strong><?php _e( 'Heating:', 'seq-pac-theme' ); ?></strong> <?php the_field( 'spl_heating' ); ?></span>
				<span><strong><?php _e( 'Fireplace:', 'seq-pac-theme' ); ?></strong> <?php the_field( 'spl_fireplace' ); ?></span>
				<span><strong><?php _e( 'Pool:', 'seq-pac-theme' ); ?></strong> <?php the_field( 'spl_pool' ); ?></span>
			</div>
		</div>
		<?php
		// Image gallery.
		$images = get_field( 'spl_image_gallery' );

		if ( $images ) : ?>
		<div id="listing-gallery" class="listing-gallery">

			<h2><?php _e( 'Listing Gallery', 'seq-pac-theme' ); ?></h2>

			<ul class="image-gallery">
				<?php foreach( $images as $image ): ?>
					<li>
						<a data-fancybox="images" href="<?php echo $image['url']; ?>">
							<img src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>" />
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<?php endif; ?>

		<?php if ( have_rows( 'spl_videos' ) ) : ?>
		<div id="listing-video" class="listing-video">

			<h2><?php _e( 'Listing Video', 'seq-pac-theme' ); ?></h2>

			<?php while ( have_rows( 'spl_videos' ) ) : the_row();

			$embed = get_sub_field( 'spl_video_embed' ) ?>
			<h3><?php the_sub_field( 'spl_video_heading' ); ?></h3>

			<?php echo do_shortcode( $embed ); ?>

			<?php endwhile; ?>
		</div>
		<?php endif; ?>

		<?php if ( ! empty( $map ) ) : ?>
		<div id="listing-map" class="listing-map">
			<div class="marker" data-lat="<?php echo $map['lat']; ?>" data-lng="<?php echo $map['lng']; ?>"></div>
		</div>
		<?php endif; ?>
	</div>
</article>
