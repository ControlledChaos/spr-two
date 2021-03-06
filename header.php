<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @package    SPR_Two
 * @subpackage Templates
 * @category   Headers
 * @since      1.0.0
 *
 * @todo Add hooks for nav above or below header.
 */

namespace SPR_Two;

// Alias namespaces.
use SPR_Two\Classes\Front as Front;

// Conditional canonical link.
if ( is_home() && ! is_front_page() ) {
    $canonical = get_permalink( get_option( 'page_for_posts' ) );
} elseif ( is_archive() ) {
    $canonical = get_permalink( get_option( 'page_for_posts' ) );
} else {
    $canonical = get_permalink();
}

?>
<!doctype html>
<?php

// Hook for ACF forms & similar.
do_action( 'before_html' ); ?>

<html xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml" <?php language_attributes(); ?> class="no-js">

<?php Front\tags()->head(); ?>

<body <?php body_class(); ?>>

<?php
Front\tags()->body_open();
Front\tags()->before_page();
?>
<a class="skip-link screen-reader-text" href="#content"><?php esc_attr( esc_html_e( 'Skip to content', 'spr-two' ) ); ?></a>
<div id="page" class="site" itemscope="itemscope" itemtype="<?php esc_attr( Front\tags()->site_schema() ); ?>">

	<div class="site-header-wrap">
		<?php Front\tags()->before_header(); ?>
		<div class="header-inner">
			<?php Front\tags()->header(); ?>
			<?php Front\tags()->after_header(); ?>
		</div>
	</div>
