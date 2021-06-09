<?php
/**
 * Header staff list
 *
 * Queries the `staff` post type and displays
 * staff members in the header, with the first
 * in the list displayed as top-level list.
 *
 * @package    SPR_Two
 * @subpackage Templates
 * @category   Headers
 * @since      1.0.0
 */

namespace SPR_Two;

// Alias namespaces.
use SPR_Two\Classes\Front as Front;

// Query the `staff` post type.
$args = [
	'post_type'           => [ 'staff' ],
	'post_status'         => [ 'publish' ],
	'nopaging'            => true,
	'posts_per_page'      => '-1',
	'ignore_sticky_posts' => true,
	'order'               => 'ASC',
	'orderby'             => 'menu_order',
];
$query = new \WP_Query( $args );

if ( $query->have_posts() ) : $count = 0; ?>
<ul>
<?php while ( $query->have_posts() ) : $query->the_post(); $count++; ?>

	<?php if ( 1 == $count ) : ?>
	<li>
	<?php
	$position = get_field( 'spr_staff_position' );
	$photo    = get_field( 'spr_staff_photo' );

	if ( $photo ) {
		$url  = $photo['url'];
		$size = 'thumbnail';
		$src  = $photo['sizes'][ $size ];
	} else {
		$src = esc_url( SPRT_URL . '/assets/images/mystery.png' );
	}
	?>
		<figure class="header-staff-figure">
			<img class="front-staff-avatar avatar" src="<?php echo $src; ?>" alt="<?php esc_html_e( "$name's profile pic" ); ?>" width="64" height="64" />
			<figcaption class="screen-reader-text">
				<?php echo get_the_title() . ' | ' . $position; ?>
			</figcaption>
		</figure>
		<div class="header-staff-content">
			<h4><?php the_title(); ?></h4>
			<p><?php echo $position; ?></p>
		</div>
	</li>
	<?php endif; ?>

<?php endwhile; ?>
</ul>
<?php endif;

wp_reset_postdata();
