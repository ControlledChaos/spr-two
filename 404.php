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

// Get the default header file.
get_header();

?>
<div id="content" class="site-content">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" itemscope itemprop="mainContentOfPage">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'That page can\'t be found.', 'spr-two' ); ?></h1>
				</header>

				<div class="page-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'spr-two' ); ?></p>

					<?php
					get_search_form();

					the_widget( 'WP_Widget_Recent_Posts' );
					?>

					<div class="widget widget_categories">
						<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'spr-two' ); ?></h2>
						<ul>
							<?php
							wp_list_categories( [
								'orderby'    => 'count',
								'order'      => 'DESC',
								'show_count' => 1,
								'title_li'   => '',
								'number'     => 10,
							] );
							?>
						</ul>
					</div>

					<?php
					$archive_content = sprintf(
						'<p>%1s</p>',
						esc_html__( 'Try looking in the monthly archives.', 'spr-two' )
					);
					the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );

					the_widget( 'WP_Widget_Tag_Cloud' );
					?>

				</div>
			</section>

		</main>
	</div>
</div><!-- #content -->
<?php

// Get the default footer file.
get_footer();
