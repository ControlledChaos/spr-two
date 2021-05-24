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

$intro_content   = get_field( 'spr_intro_content_front' );
$use_image_links = get_field( 'spr_front_image_links_use' );
$links_heading   = get_field( 'spr_front_image_links_heading' );

if ( $links_heading ) {
	$links_heading = $links_heading;
} else {
	$links_heading = __( 'Featured Services', 'spr-two' );
}

// Down arrow.
$down_arrow = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M441.9 89.7L232.5 299.1c-4.7 4.7-12.3 4.7-17 0L6.1 89.7c-4.7-4.7-4.7-12.3 0-17l19.8-19.8c4.7-4.7 12.3-4.7 17 0L224 233.6 405.1 52.9c4.7-4.7 12.3-4.7 17 0l19.8 19.8c4.7 4.7 4.7 12.3 0 17zm0 143l-19.8-19.8c-4.7-4.7-12.3-4.7-17 0L224 393.6 42.9 212.9c-4.7-4.7-12.3-4.7-17 0L6.1 232.7c-4.7 4.7-4.7 12.3 0 17l209.4 209.4c4.7 4.7 12.3 4.7 17 0l209.4-209.4c4.7-4.7 4.7-12.3 0-17z"/></svg>';

?>
<style>
.front-page-hero { background-image: url( <?php echo $hero_src; ?> ); }
.front-page-hero:before { background: rgba(0, 0, 0, 0.<?php echo $hero_overlay; ?>); }
</style>
<div class="front-page-hero">

	<div class="front-page-hero-content">

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
</div>

<article id="front-page-content" <?php post_class(); ?> role="article">

	<?php if ( ! $intro_content ) : ?>
	<header class="entry-header">
		<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
	</header>
	<?php endif; ?>

	<div class="entry-content" itemprop="articleBody">

		<?php
		if ( have_rows( 'spr_front_page_content' ) ) :
		$counters = [];
		?>
		<div class="front-acf-content">
			<?php while ( have_rows( 'spr_front_page_content' ) ) : the_row();

			$get_layout = get_row_layout();
			if ( ! isset( $counters[ $get_layout ] ) ) {
				$counters[ $get_layout ] = 1;
			} else {
				$counters[ $get_layout ]++;
			}
			$layout = 'layout_' . get_row_layout() . '_' . $counters[ $get_layout ];

			?>

				<?php if ( get_row_layout() == 'spr_front_content_block' ) : ?>
				<section id="<?php echo $layout; ?>" class="front-content-section front-editor-content">

					<h2><?php the_sub_field( 'spr_front_content_heading' ); ?></h2>

					<?php the_sub_field( 'spr_front_content_block_editor' ); ?>

				</section>

				<?php elseif ( get_row_layout() == 'spr_front_content_two_panel' ) : ?>
				<section id="<?php echo $layout; ?>" class="front-content-section front-two-panel-content">

					<h2><?php the_sub_field( 'spr_front_content_heading' ); ?></h2>

					<?php
					if ( have_rows( 'spr_front_content_two_panel_layouts' ) ) : ?>

					<div class="two-panel-content front-two-panel-content">

						<?php while ( have_rows( 'spr_front_content_two_panel_layouts' ) ) : the_row();

						if ( get_row_layout() == 'spr_front_content_two_panel_block_editor' ) : ?>

							<div class="two-panel-content-side">
								<?php the_sub_field( 'spr_front_content_two_panel_block_editor' ); ?>
							</div>

						<?php elseif ( get_row_layout() == 'spr_front_content_two_panel_sidebar' ) : ?>

							<div class="two-panel-content-side sticky-wrapper">
								<?php
								$sidebar = get_sub_field( 'spr_front_content_two_panel_sidebar' );

								if ( is_active_sidebar( $sidebar ) ) {
									get_sidebar( $sidebar );
							   }

								?>
							</div>

						<?php endif; ?>

						<?php endwhile; ?>

					</div>

					<?php endif; ?>

				</section>

				<?php elseif ( get_row_layout() == 'spr_front_content_shortcode' ) : ?>
				<section id="<?php echo $layout; ?>" class="front-content-section front-shortcode-content">

					<div class="shortcode-section">
						<div class="shortcode-section-content">

							<h2><?php the_sub_field( 'spr_front_content_heading' ); ?></h2>

							<div class="front-content-block-message">
								<?php the_sub_field( 'spr_front_content_message' ); ?>
							</div>

							<?php
							$code = get_sub_field( 'spr_front_content_shortcode_code' );
							echo do_shortcode( $code );
							?>
						</div>
						<?php
						$sidebar = get_sub_field( 'spr_front_content_shortcode_sidebar' );
						if ( $sidebar ) {
							$sidebar = $sidebar;
						} else {
							$sidebar = 'front-section';
						}

						if ( is_active_sidebar( $sidebar ) ) :

						?>
						<div class="sticky-wrapper">
							<?php get_sidebar( $sidebar ); ?>
						</div>
						<?php

						endif;

						?>
					</div>
				</section>

				<?php elseif ( get_row_layout() == 'spr_front_content_properties' ) : ?>
				<section id="<?php echo $layout; ?>" class="front-content-section front-featured-properties hide-if-no-js">

					<h2><?php the_sub_field( 'spr_front_content_heading' ); ?></h2>

					<div class="front-content-block-message">
						<?php the_sub_field( 'spr_front_content_message' ); ?>
					</div>

					<?php if ( have_rows( 'spr_front_content_featured_properties' ) ) : ?>
					<ul>
					<?php while( have_rows( 'spr_front_content_featured_properties' ) ) : the_row(); ?>
						<li>
						<?php
						$featured = get_sub_field( 'spr_front_content_featured_property' );
						if ( $featured ) : ?>

							<div class="featured-details">
								<div>

									<h3><?php echo esc_html( $featured->post_title ); ?></h3>

									<p class="featured-price">$<?php the_field( 'spl_sale_price', $featured->ID ); ?></p>

									<p class="featured-location">
									<?php
									// Get the location(s).
									$locations = get_field( 'spl_location', $featured->ID );
									if ( $locations ) {
										foreach ( $locations as $location ) { echo sprintf( '<span class="location">%1s</span>', $location->name ); };
									} else {
										echo sprintf( '<span class="location">%1s</span>', get_field( 'spl_post_office', $featured->ID ) );
									} ?>
									</p>
								</div>

								<div>
									<p class="featured-details-link"><a class="button" href="<?php the_permalink(); ?>"><?php _e( 'View Details', 'spr-two' ); ?></a></p>
								</div>
							</div>

							<p><?php the_field( 'spl_summary', $featured->ID ); ?></p>

							<?php

							// Get the featured image.
							$image = get_field( 'spl_featured_image', $featured->ID );

							// Image variables.
							$url     = $image['url'];
							$title   = $image['title'];
							$alt     = sprintf(
								'%1s | %2s - %3s | %4s%5s',
								esc_html( get_the_title() ),
								'$' . esc_html( get_field( 'spl_sale_price' ) ),
								esc_html( get_field( 'spl_summary' ) ),
								get_field( 'spl_post_office' ),
								__( ', California', 'spr-two' )
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
							<a href="<?php the_permalink(); ?>">
								<img src="<?php echo $thumb; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" alt="<?php echo $alt; ?>" longdesc="<?php echo esc_url( get_permalink() . '#listing-description' ); ?>" />
							</a>

						<?php endif; ?>
						</li>
					<?php endwhile; ?>
					</ul>
					<?php endif; ?>

				</section>

				<?php elseif ( get_row_layout() == 'spr_front_content_image_links' ) : ?>
				<section id="<?php echo $layout; ?>" class="front-content-section front-image-links">

					<h2><?php the_sub_field( 'spr_front_content_heading' ); ?></h2>

					<div class="front-content-block-message">
						<?php the_sub_field( 'spr_front_content_message' ); ?>
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
			<?php endwhile; ?>
		</div>
		<?php endif; ?>
	</div>
</article>
