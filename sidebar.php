<?php
/**
 * The sidebar containing the main widget area
 *
 * @package    SPR_Two
 * @subpackage Templates
 * @category   Asides
 * @since      1.0.0
 */

namespace SPR_Two;

// Alias namespaces.
use SPR_Two\Classes\Front as Front;

?>
<aside id="secondary" class="widget-area">

	<?php
		if ( is_active_sidebar( 'sidebar-default' ) ) :

		dynamic_sidebar( 'sidebar-default' );

		else : ?>

		<?php the_widget(
			'SPR_Two\Classes\Widgets\Theme_Mode',
			[ 'title' => __( 'Toggle Theme Mode', 'spr-two' ) ],
			[
				'before_title' => '<h3>',
				'after_title'  => '</h3>'
			]
			); ?>

    	<?php get_search_form(); ?>

    	<h3><?php _e( 'Archives', 'spr-two' ); ?></h3>
    	<ul>
    		<?php wp_get_archives( 'type=monthly' ); ?>
		</ul>

		<?php the_widget(
			'WP_Widget_Categories',
			null,
			[
				'before_title' => '<h3>',
				'after_title'  => '</h3>'
			]
		); ?>

    	<h3><?php _e( 'Meta', 'spr-two' ); ?></h3>
    	<ul>
			<?php wp_register(); ?>
			<?php if ( is_user_logged_in() ) : ?>
			<li>
				<a href="<?php echo get_edit_user_link(); ?>"><?php _e( 'Your Profile', 'spr-two' ); ?></a>
			</li>
			<?php endif; ?>
    		<li><?php wp_loginout(); ?></li>
			<?php wp_meta(); ?>
    	</ul>

    	<h3><?php _e( 'Subscribe', 'spr-two' ); ?></h3>
    	<ul>
    		<li><a href="<?php bloginfo( 'rss2_url' ); ?>"><?php _e( 'Entries RSS', 'spr-two' ); ?></a></li>
    		<li><a href="<?php bloginfo( 'comments_rss2_url' ); ?>"><?php _e( 'Comments RSS', 'spr-two' ); ?></a></li>
    	</ul>

	<?php endif; ?>
</aside>
