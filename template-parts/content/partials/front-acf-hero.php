<?php
/**
 * Front page hero content for ACF
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
$hero_loading     = get_field( 'spr_hero_loading_text' );
$hero_heading     = get_field( 'spr_hero_heading' );
$hero_message     = get_field( 'spr_hero_message' );
$hero_menu        = get_field( 'spr_hero_menu' );
$hero_gallery     = get_field( 'spr_hero_gallery' );
$hero_overlay     = get_field( 'spr_hero_overlay' );
$hero_display     = get_field( 'spr_hero_content_display' );
$hero_code_option = get_field( 'spr_hero_shortcode_option' );
$hero_shortcode   = get_field( 'spr_hero_shortcode' );
$search_location  = get_field( 'spr_hero_search_location' );
$search_params    = get_field( 'spr_hero_search_parameters' );
$search_results   = get_field( 'spr_hero_search_results' );
$search_view      = get_field( 'spr_hero_search_map' );
$search_button    = get_field( 'spr_hero_search_button_text' );

// Random gallery image.
if ( $hero_gallery ) {

	$random_gallery = array_rand( $hero_gallery, 1 );

	// Preferred image size.
	if ( has_image_size( 'x-large-banner' ) ) {
		$hero_src = $hero_gallery[$random_gallery]['sizes']['x-large-banner'];

	// Fallback image size.
	} else {
		$get_src  = wp_get_attachment_image_src( $hero_gallery[ $random_gallery ]['ID'], 'full' );
		$hero_src = $get_src{0};
	}

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
	$hero_message = '';
}

// Hero loading text.
if ( get_field( 'spr_front_loading_text' ) ) {
	$hero_loading = get_field( 'spr_front_loading_text' );
} else {
	$hero_loading = __( 'Loading&hellip;', 'spr-two' );
}

// Hero loader display conditions.
if ( 'shortcode' === $hero_display ) {
	$use_shortcode = true;
	$loader_class  = 'hero-has-loader';
} else {
	$use_shortcode = false;
	$loader_class  = 'hero-no-loader';
}

// Build shortcode.
$font_stack = 'system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", Helvetica, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"';

// Use location search field.
if ( ! $search_location ) {
	$search_location = 'off';
} else {
	$search_location = 'on';
}

// Text of the search submit button.
if ( $search_button ) {
	$search_button = $search_button;
} else {
	$search_button = __( 'Search Properties', 'spr-two' );
}

// Search min/max fields.
if ( is_array( $search_params ) && ! empty( $search_params ) ) {
	$search_params = implode( ',', $search_params );
} else {
	$search_params - 'beds,baths,square_footage,list_price';
}

// Show map at the top of search results.
if ( ! $search_view ) {
	$search_view = 'list';
} else {
	$search_view = 'map';
}

// Number of search results per page.
if ( $search_results ) {
	$search_results = $search_results;
} else {
	$search_results = '10';
}

// The search form shortcode.
if ( 'paste' == $code_option && $hero_shortcode ) {
	$form_code = $hero_shortcode;
} elseif ( 'build' == $code_option ) {
	$form_code = sprintf(
		'[idx_search title="" link="1lkpig7k5t4z" buttontext="%s" detailed_search="on" destination="local" user_sorting="off" location_search="%s" property_type_enabled="off" property_type="A,B,D" std_fields="%s" theme="hori_square_light" orientation="horizontal" title_font="%s" field_font="%s" border_style="squared" widget_drop_shadow="off" background_color="#222222" title_text_color="#ffffff" field_text_color="#ffffff" detailed_search_text_color="#ffffff" submit_button_shine="none" submit_button_background="#222222" submit_button_text_color="#ffffff" allow_sold_searching="off" default_view="%s" listings_per_page="%s" allow_pending_searching="off"]',
		$search_button,
		$search_location,
		$search_params,
		$font_stack,
		$font_stack,
		$search_view,
		$search_results
	);
} else {
	$form_code = sprintf(
		'[idx_search title="" link="1lkpig7k5t4z" buttontext="%s" detailed_search="on" destination="local" user_sorting="off" location_search="%s" property_type_enabled="off" property_type="A,B,D" std_fields="%s" theme="hori_square_light" orientation="horizontal" title_font="%s" field_font="%s" border_style="squared" widget_drop_shadow="off" background_color="#222222" title_text_color="#ffffff" field_text_color="#ffffff" detailed_search_text_color="#ffffff" submit_button_shine="none" submit_button_background="#222222" submit_button_text_color="#ffffff" allow_sold_searching="off" default_view="%s" listings_per_page="%s" allow_pending_searching="off"]',
		$search_button,
		$search_location,
		$search_params,
		$font_stack,
		$font_stack,
		$search_view,
		$search_results
	);
}

// Down arrow.
$down_arrow = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M441.9 89.7L232.5 299.1c-4.7 4.7-12.3 4.7-17 0L6.1 89.7c-4.7-4.7-4.7-12.3 0-17l19.8-19.8c4.7-4.7 12.3-4.7 17 0L224 233.6 405.1 52.9c4.7-4.7 12.3-4.7 17 0l19.8 19.8c4.7 4.7 4.7 12.3 0 17zm0 143l-19.8-19.8c-4.7-4.7-12.3-4.7-17 0L224 393.6 42.9 212.9c-4.7-4.7-12.3-4.7-17 0L6.1 232.7c-4.7 4.7-4.7 12.3 0 17l209.4 209.4c4.7 4.7 12.3 4.7 17 0l209.4-209.4c4.7-4.7 4.7-12.3 0-17z"/></svg>';

?>
<style>
.front-page-hero { background-image: url( <?php echo $hero_src; ?> ); }
.front-page-hero:before { background: rgba( 0, 0, 0, 0.<?php echo $hero_overlay; ?> ); }
</style>
<div class="front-page-hero">

	<div class="front-page-hero-content <?php echo $loader_class; ?>">

		<h3 class="hero-site-description"><?php echo $hero_heading; ?></h3>

		<?php echo $hero_message; ?>

	<?php if ( 'shortcode' === $hero_display ) : ?>
		<?php echo do_shortcode( $form_code ); ?>
	<?php else : ?>

		<?php
		if ( $hero_menu && has_nav_menu( $hero_menu ) ) :
		wp_nav_menu( [
			'theme_location' => $hero_menu,
			'container'      => null,
			'menu_id'        => $hero_menu . '-menu',
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

	<?php if ( $use_shortcode ) : ?>
	<div class="front-page-hero-loader">
		<div class="spinner"></div>
		<div class="loading">
			<p><?php echo $hero_loading; ?></p>
		</div>
	</div>
	<?php endif; ?>
</div>
