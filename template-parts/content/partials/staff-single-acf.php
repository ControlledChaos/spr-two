<?php
/**
 * ACF article content for single post type: staff
 *
 * @package    SPR_Two
 * @subpackage Templates
 * @category   Content
 * @since      1.0.0
 */

namespace SPR_Two;

// Alias namespaces.
use SPR_Two\Classes\Front as Front;

// Post data.
$id = get_the_ID();

// Get ACF fields.
$name     = get_the_title();
$photo    = get_field( 'spr_staff_photo' );
$email    = get_field( 'spr_staff_email' );
$position = get_field( 'spr_staff_position' );
$bio      = get_field( 'spr_staff_bio' );

if ( $photo ) {
	$url  = $photo['url'];
	if ( has_image_size( 'x-large-thumbnail' ) ) {
		$size = 'x-large-thumbnail';
	} else {
		$size = 'thumbnail';
	}
	$src  = $photo['sizes'][ $size ];
} else {
	$src = esc_url( SPRT_URL . '/assets/images/mystery.png' );
}

?>
<div class="entry-content staff-content" itemprop="articleBody">
	<figure class="staff-photo">
		<a href="mailto:<?php echo $email; ?>">
			<img class="staff-avatar avatar" src="<?php echo $src; ?>" alt="<?php esc_html_e( "$name's profile pic" ); ?>" width="240" height="240" />
		</a>
		<figcaption class="screen-reader-text">
			<?php esc_html_e( "$name's profile pic" ); ?>
		</figcaption>
	</figure>
	<div id="<?php echo "{$id}-bio"; ?>" class="staff-details">
		<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
		<p class="staff-position"><?php echo $position; ?></p>
		<div class="staff-bio">
			<?php echo $bio; ?>
		</div>
		<?php if ( $email ) : ?>
		<p class="staff-email"><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></p>
		<?php endif; ?>
	</div>
</div>

<?php
$args = [
    'post_type'      => 'staff',
    'post_status'    => 'publish',
    'posts_per_page' => 100,
    'order'          => 'ASC',
	'orderby'        => 'menu_order',
    'post__not_in'   => [ $id ],
];
$staff = new \WP_Query( $args );

if ( $staff->have_posts() ) :

?>
<div class="more-staff">
	<h2><?php _e( 'More Sequoia Pacific Realty Staff Members', 'spr-two' ); ?></h2>
	<ul>
		<?php while ( $staff->have_posts() ) : $staff->the_post();

		$photo = get_field( 'spr_staff_photo' );

		if ( $photo ) {
			$url  = $photo['url'];
			$size = 'thumbnail';
			$src  = $photo['sizes'][ $size ];
		} else {
			$src = esc_url( SPRT_URL . '/assets/images/mystery.png' );
		}
		?>
		<li>
			<a href="<?php the_permalink(); ?>">
				<figure class="staff-photo">
					<img class="staff-avatar avatar" src="<?php echo $src; ?>" alt="<?php esc_html_e( "$name's profile pic" ); ?>" width="160" height="160" />
					<figcaption>
						<?php the_title(); ?>
					</figcaption>
				</figure>
			</a>
		</li>
		<?php endwhile; ?>
	</ul>
</div>
<?php
endif; wp_reset_postdata();
