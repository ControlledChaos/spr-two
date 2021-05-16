<?php
/**
 * Default 404 error page content
 *
 * @package    SPR_Two
 * @subpackage Templates
 * @category   Content
 * @since      1.0.0
 */

namespace SPR_Two;

// Access widgets to check if they're registered.
global $wp_widget_factory;

?>
<div class="page-content">

	<h1 class="page-title"><?php esc_html_e( 'That page can\'t be found.', 'spr-two' ); ?></h1>

	<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'spr-two' ); ?></p>

	<?php
	get_search_form();

	if ( isset( $wp_widget_factory->widgets['WP_Widget_Recent_Posts'] ) ) {
		the_widget( 'WP_Widget_Recent_Posts' );
	} ?>

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

	if ( isset( $wp_widget_factory->widgets['WP_Widget_Archives'] ) ) {
		the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
	}

	if ( isset( $wp_widget_factory->widgets['WP_Widget_Tag_Cloud'] ) ) {
		the_widget( 'WP_Widget_Tag_Cloud' );
	} ?>

</div>
