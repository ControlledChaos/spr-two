<?php
/**
 * Display a slider of featured listings
 *
 * @package    SPR_Two
 * @subpackage Templates
 * @category   Content
 * @since      1.0.0
 */

namespace SPR_Two;

// Alias namespaces.
use SPR_Two\Classes\Front as Front;

<?php
// Featured listings loop.
$args = [
	'post_type'     => [ 'listing', 'rental' ],
	'tag_slug__and' => [ 'featured' ],
	'order'         => 'ASC',
	'orderby'       => 'menu_order'
];
$query = new \WP_Query( $args );

/**
 * If there is at least one listing marked as featured then
 * display the Featured Properties section.
 */
if ( $query->have_posts() ) :

?>
<section class="front-featured-properties hide-if-no-js">
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
wp_reset_postdata();
