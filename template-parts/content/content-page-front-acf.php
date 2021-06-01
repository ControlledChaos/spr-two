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

// Get the hero content.
get_template_part( 'template-parts/content/partials/front-acf', 'hero' );

?>
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

					<h2><?php the_sub_field( 'spr_front_content_heading' ); ?></h2>

					<div class="shortcode-section">

						<div class="shortcode-section-content">

							<div class="front-content-block-message">
								<?php the_sub_field( 'spr_front_content_message' ); ?>
							</div>

							<?php
							$shortcode   = get_sub_field( 'spr_front_shortcode' );
							$grid_width  =  get_sub_field( 'spr_front_grid_width' );
							$grid_height =  get_sub_field( 'spr_front_grid_height' );

							// Grid shortcode.
							$grid_display = sprintf(
								'[idx_slideshow link="default" horizontal="%s" vertical="%s" source="location" location="PostalCode=93271&93271|PostalCode=93221&93221|PostalCode=93244&93244|PostalCode=93286&93286" display="all" sort="recently_changed" additional_fields="beds,baths,sqft" destination="local" send_to="photo"]',
								$grid_width,
								$grid_height
							);

							if ( $shortcode ) {
								echo do_shortcode( $shortcode );
							} else {
								// Build code.
							}
							?>
						</div>
						<?php
						$sidebar = get_sub_field( 'spr_front_shortcode_sidebar' );
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

					<?php get_template_part( 'template-parts/content/partials/front-acf', 'featured' ); ?>

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
