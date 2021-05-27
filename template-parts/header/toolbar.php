<?php
/**
 * Toolbar
 *
 * @package    SPR_Two
 * @subpackage Templates
 * @category   Headers
 * @since      1.0.0
 */

namespace SPR_Two;

// Alias namespaces.
use SPR_Two\Classes\Front as Front;

$phone_icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M497.39 361.8l-112-48a24 24 0 0 0-28 6.9l-49.6 60.6A370.66 370.66 0 0 1 130.6 204.11l60.6-49.6a23.94 23.94 0 0 0 6.9-28l-48-112A24.16 24.16 0 0 0 122.6.61l-104 24A24 24 0 0 0 0 48c0 256.5 207.9 464 464 464a24 24 0 0 0 23.4-18.6l24-104a24.29 24.29 0 0 0-14.01-27.6z"/></svg>';

$mail_icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M502.3 190.8c3.9-3.1 9.7-.2 9.7 4.7V400c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V195.6c0-5 5.7-7.8 9.7-4.7 22.4 17.4 52.1 39.5 154.1 113.6 21.1 15.4 56.7 47.8 92.2 47.6 35.7.3 72-32.8 92.3-47.6 102-74.1 131.6-96.3 154-113.7zM256 320c23.2.4 56.6-29.2 73.4-41.4 132.7-96.3 142.8-104.7 173.4-128.7 5.8-4.5 9.2-11.5 9.2-18.9v-19c0-26.5-21.5-48-48-48H48C21.5 64 0 85.5 0 112v19c0 7.4 3.4 14.3 9.2 18.9 30.6 23.9 40.7 32.4 173.4 128.7 16.8 12.2 50.2 41.8 73.4 41.4z"/></svg>';

$edit_icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M402.6 83.2l90.2 90.2c3.8 3.8 3.8 10 0 13.8L274.4 405.6l-92.8 10.3c-12.4 1.4-22.9-9.1-21.5-21.5l10.3-92.8L388.8 83.2c3.8-3.8 10-3.8 13.8 0zm162-22.9l-48.8-48.8c-15.2-15.2-39.9-15.2-55.2 0l-35.4 35.4c-3.8 3.8-3.8 10 0 13.8l90.2 90.2c3.8 3.8 10 3.8 13.8 0l35.4-35.4c15.2-15.3 15.2-40 0-55.2zM384 346.2V448H64V128h229.8c3.2 0 6.2-1.3 8.5-3.5l40-40c7.6-7.6 2.2-20.5-8.5-20.5H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V306.2c0-10.7-12.9-16-20.5-8.5l-40 40c-2.2 2.3-3.5 5.3-3.5 8.5z"/></svg>';

// Text and icon for login/logout.
if ( is_user_logged_in() ) {
	$log_text = __( 'Log Out', 'spr-two' );
	$log_icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M180 448H96c-53 0-96-43-96-96V160c0-53 43-96 96-96h84c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12H96c-17.7 0-32 14.3-32 32v192c0 17.7 14.3 32 32 32h84c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12zm117.9-303.1l77.6 71.1H184c-13.3 0-24 10.7-24 24v32c0 13.3 10.7 24 24 24h191.5l-77.6 71.1c-10.1 9.2-10.4 25-.8 34.7l21.9 21.9c9.3 9.3 24.5 9.4 33.9.1l152-150.8c9.5-9.4 9.5-24.7 0-34.1L353 88.3c-9.4-9.3-24.5-9.3-33.9.1l-21.9 21.9c-9.7 9.6-9.3 25.4.7 34.6z"/></svg>';
	$log_url  = esc_url( wp_logout_url( site_url( '/' ) ) );

} else {
	$log_text = __( 'Log In', 'spr-two' );
	$log_icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M137.2 110.3l21.9-21.9c9.3-9.3 24.5-9.4 33.9-.1L344.9 239c9.5 9.4 9.5 24.7 0 34.1L193 423.7c-9.4 9.3-24.5 9.3-33.9-.1l-21.9-21.9c-9.7-9.7-9.3-25.4.8-34.7l77.6-71.1H24c-13.3 0-24-10.7-24-24v-32c0-13.3 10.7-24 24-24h191.5l-77.6-71.1c-10-9.1-10.4-24.9-.7-34.5zM512 352V160c0-53-43-96-96-96h-84c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h84c17.7 0 32 14.3 32 32v192c0 17.7-14.3 32-32 32h-84c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h84c53 0 96-43 96-96z"/></svg>';
	$log_url  = esc_url( wp_login_url( site_url( '/' ) ) );
}

$log_link = sprintf(
	'<a href="%s" title="%s"><span class="toolbar-icon toolbar-loginout-icon" role="presentation">%s</span> <span class="toolbar-link-text">%s</span></a>',
	$log_url,
	$log_text,
	$log_icon,
	$log_text
);

$dashboard_icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M288 32C128.94 32 0 160.94 0 320c0 52.8 14.25 102.26 39.06 144.8 5.61 9.62 16.3 15.2 27.44 15.2h443c11.14 0 21.83-5.58 27.44-15.2C561.75 422.26 576 372.8 576 320c0-159.06-128.94-288-288-288zm102.77 119.59l-61.33 184C343.13 347.33 352 364.54 352 384c0 11.72-3.38 22.55-8.88 32H232.88c-5.5-9.45-8.88-20.28-8.88-32 0-33.94 26.5-61.43 59.9-63.59l61.34-184.01c4.17-12.56 17.73-19.45 30.36-15.17 12.57 4.19 19.35 17.79 15.17 30.36z"/></svg>';

$palette_icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M204.3 5C104.9 24.4 24.8 104.3 5.2 203.4c-37 187 131.7 326.4 258.8 306.7 41.2-6.4 61.4-54.6 42.5-91.7-23.1-45.4 9.9-98.4 60.9-98.4h79.7c35.8 0 64.8-29.6 64.9-65.3C511.5 97.1 368.1-26.9 204.3 5zM96 320c-17.7 0-32-14.3-32-32s14.3-32 32-32 32 14.3 32 32-14.3 32-32 32zm32-128c-17.7 0-32-14.3-32-32s14.3-32 32-32 32 14.3 32 32-14.3 32-32 32zm128-64c-17.7 0-32-14.3-32-32s14.3-32 32-32 32 14.3 32 32-14.3 32-32 32zm128 64c-17.7 0-32-14.3-32-32s14.3-32 32-32 32 14.3 32 32-14.3 32-32 32z"/></svg>';

global $post;
$post_id  = get_post_type( $post->ID );
$get_type = get_post_type_object( $post_id );
$type     = $get_type->labels->singular_name;

// Get the contact page ID.
$contact_page = get_page_by_path( 'contact' );
$contact_id   = '';
if ( $contact_page ) {
	$contact_id = $contact_page->ID;
}

?>
<div id="theme-toolbar">
	<div class="inner">
		<div class="theme-toolbar-one">
			<p><a href="<?php echo esc_url( 'tel:15595612200' ); ?>"><span class="toolbar-icon toolbar-phone-icon" role="presentation"><?php echo $phone_icon; ?></span> <span class="toolbar-link-text"><?php _e( 'Call:', 'spr-two' ); ?></span>  1-559-561-2200</a></p>
		</div>

		<div class="theme-toolbar-two">
			<ul>
				<?php

				// Edit link.
				if ( is_singular() && is_user_logged_in() && current_user_can( 'edit_posts' ) ) : ?>
					<li><a href="<?php echo esc_url( get_edit_post_link() ); ?>" title="<?php _e( 'Edit this page', 'spr-two' ); ?>"><span class="toolbar-icon toolbar-dashboard-icon" role="presentation"><?php echo $edit_icon; ?></span> <span class="toolbar-link-text"><?php echo __( 'Edit', 'spr-two' ) . ' ' . $type; ?></span></a></li>
				<?php

				endif;

				// Dashboard link.
				if ( is_user_logged_in() && current_user_can( 'edit_posts' ) ) :

				?>
				<li><a href="<?php echo esc_url( admin_url( '/' ) ); ?>" title="<?php _e( 'Go to the dashboard', 'spr-two' ); ?>"><span class="toolbar-icon toolbar-dashboard-icon" role="presentation"><?php echo $dashboard_icon; ?></span> <span class="toolbar-link-text"><?php _e( 'Dashboard', 'spr-two' ); ?></span></a></li>

				<?php

				endif;

				if ( current_user_can( 'customize' ) ) :

				?>
				<li><a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" title="<?php _e( 'Customize this site', 'spr-two' ); ?>"><span class="toolbar-icon toolbar-customizer-icon" role="presentation"><?php echo $palette_icon; ?></span> <span class="toolbar-link-text"><?php _e( 'Customize', 'spr-two' ); ?></span></a></li>

				<?php

				endif;

				// Contact page link.
				if ( ! is_user_logged_in() && $contact_page ) :

				?>
				<li><a href="<?php the_permalink( $contact_id ); ?>" title="<?php echo __( 'Contact', 'spr-two' ) . ' ' . get_bloginfo( 'name' ); ?>"><span class="toolbar-icon toolbar-email-icon" role="presentation"><?php echo $mail_icon; ?></span> <span class="toolbar-link-text"><?php _e( 'Contact', 'spr-two' ); ?></span></a></li>
				<?php

				endif;

				?>

				<li><?php echo $log_link; ?></li>
			</ul>
		</div>
	</div>
</div>
