<?php
/**
 * 404 page
 *
 * The template for displaying 404 pages (not found),
 *
 * @package    SPR_Two
 * @subpackage Templates
 * @category   Errors
 * @since      1.0.0
 */

namespace SPR_Two;

// Alias namespaces.
use SPR_Two\Classes\Front as Front;

// Get server protocol.
if (
	( ! empty( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] != 'off' ) ||
	$_SERVER['SERVER_PORT'] == 443
) {
	$protocol = 'https://';
} else {
	$protocol = 'http://';
}

// Get the current URL.
$url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

// Get the default header file.
get_header();

?>
<div id="content" class="site-content">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" itemscope itemprop="mainContentOfPage">

			<?php

			// If the error template is displayed for the site base URL.
			if (
				$url === trailingslashit( get_bloginfo( 'url' ) ) ||
				$url === trailingslashit( get_bloginfo( 'wpurl' ) )
			) {

				/**
				 * If the home page option is set to a static page
				 * and the option's page ID is not found and the
				 * current user can manage options.
				 */
				if ( 'page' == get_option( 'show_on_front' ) && current_user_can( 'manage_options' ) ) {
					get_template_part( 'template-parts/content/content', '404-front' );

				// Fall back to the default.
				} else {
					get_template_part( 'template-parts/content/content', '404' );
				}

			// If not the site base URL.
			} else {
				get_template_part( 'template-parts/content/content', '404' );
			} ?>

		</main>
	</div>
</div><!-- #content -->
<?php

// Get the default footer file.
get_footer();
