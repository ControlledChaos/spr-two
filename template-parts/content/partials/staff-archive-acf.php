<?php
/**
 * ACF article content for archive post type: staff
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
		<a href="<?php the_permalink(); ?>">
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
