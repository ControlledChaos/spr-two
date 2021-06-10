<?php
/**
 * Front page staff members for ACF
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
$staff_members = get_sub_field( 'spr_front_staff_members' );

if ( $staff_members ) :

?>
	<ul class="front-staff-slides">
	<?php foreach ( $staff_members as $staff_member ) :
		$name     = get_the_title( $staff_member->ID );
		$photo    = get_field( 'spr_staff_photo', $staff_member->ID );
		$email    = get_field( 'spr_staff_email', $staff_member->ID );
		$position = get_field( 'spr_staff_position', $staff_member->ID );
		$bio      = get_field( 'spr_staff_bio', $staff_member->ID );

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

		$trim = sprintf(
			'&hellip; <a class="hide-if-no-js front-staff-read-more" href="javascript:void;" data-src="#%s-bio-modal" data-fancybox>%s</a>',
			$staff_member->ID,
			__( 'Read more', 'spr-two' )
		);

		?>
		<li style="display: inline-block;">
			<div class="front-staff-slide-wrap">
				<figure>
					<img class="front-staff-avatar avatar" src="<?php echo $src; ?>" alt="<?php esc_html_e( "$name's profile pic" ); ?>" width="240" height="240" />
					<figcaption>
						<h4><?php echo $name; ?></h4>
						<p><?php echo $position; ?></p>
					</figcaption>
				</figure>
				<p class="bio"><?php echo wp_trim_words( $bio, 30, $trim ); ?></p>
			</div>
			<div id="<?php echo "{$staff_member->ID}-bio-modal"; ?>" class="front-staff-modal" style="display: none;">
				<img class="alignleft avatar" src="<?php echo $src; ?>" alt="<?php esc_html_e( "$name's profile pic" ); ?>" width="120" height="120" />
				<p class="modal-heading"><?php echo $name; ?></p>
				<p><?php echo $position; ?></p>
				<div class="bio">
					<?php echo $bio; ?>
				</div>
			</div>
		</li>
		<?php endforeach; ?>
	</ul>
<?php

endif;
