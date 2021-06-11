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

$mail_icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M464 64H48C21.49 64 0 85.49 0 112v288c0 26.51 21.49 48 48 48h416c26.51 0 48-21.49 48-48V112c0-26.51-21.49-48-48-48zm0 48v40.805c-22.422 18.259-58.168 46.651-134.587 106.49-16.841 13.247-50.201 45.072-73.413 44.701-23.208.375-56.579-31.459-73.413-44.701C106.18 199.465 70.425 171.067 48 152.805V112h416zM48 400V214.398c22.914 18.251 55.409 43.862 104.938 82.646 21.857 17.205 60.134 55.186 103.062 54.955 42.717.231 80.509-37.199 103.053-54.947 49.528-38.783 82.032-64.401 104.947-82.653V400H48z"/></svg>';

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
