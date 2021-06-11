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

$mail_icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M502.3 190.8c3.9-3.1 9.7-.2 9.7 4.7V400c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V195.6c0-5 5.7-7.8 9.7-4.7 22.4 17.4 52.1 39.5 154.1 113.6 21.1 15.4 56.7 47.8 92.2 47.6 35.7.3 72-32.8 92.3-47.6 102-74.1 131.6-96.3 154-113.7zM256 320c23.2.4 56.6-29.2 73.4-41.4 132.7-96.3 142.8-104.7 173.4-128.7 5.8-4.5 9.2-11.5 9.2-18.9v-19c0-26.5-21.5-48-48-48H48C21.5 64 0 85.5 0 112v19c0 7.4 3.4 14.3 9.2 18.9 30.6 23.9 40.7 32.4 173.4 128.7 16.8 12.2 50.2 41.8 73.4 41.4z"/></svg>';

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
					<a href="<?php the_permalink( $staff_member->ID ); ?>">
						<img class="front-staff-avatar avatar" src="<?php echo $src; ?>" alt="<?php esc_html_e( "$name's profile pic" ); ?>" width="240" height="240" />
					</a>
					<figcaption>
						<h4><?php echo $name; ?>
							<?php if ( $email ) : ?>
							<a class="staff-email-icon-link" href="mailto:<?php echo $email; ?>">
								<?php echo $mail_icon; ?><span class="screen-reader-text"> <?php echo $email; ?></span>
							</a>
							<?php endif; ?>
						</h4>
						<p><?php echo $position; ?></p>
					</figcaption>
				</figure>
				<p class="bio"><?php echo wp_trim_words( $bio, 30, $trim ); ?></p>
			</div>
			<div id="<?php echo "{$staff_member->ID}-bio-modal"; ?>" class="front-staff-modal" style="display: none;">
				<img class="alignleft avatar" src="<?php echo $src; ?>" alt="<?php esc_html_e( "$name's profile pic" ); ?>" width="120" height="120" />
				<p class="modal-heading"><?php echo $name; ?>
					<?php if ( $email ) : ?>
					<a class="staff-email-icon-link" href="mailto:<?php echo $email; ?>">
						<?php echo $mail_icon; ?><span class="screen-reader-text"> <?php echo $email; ?></span>
					</a>
					<?php endif; ?>
				</p>
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
