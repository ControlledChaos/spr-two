<?php
/**
 * Template part for displaying page content and featured image
 *
 * @package    SPR_Two
 * @subpackage Templates
 * @category   Content
 * @since      1.0.0
 */

namespace SPR_Two;

// Alias namespaces.
use SPR_Two\Classes\Front as Front;

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">

	<header class="entry-header">
		<?php
		if ( is_front_page() ) {

			// Front page uses h1 in the page header so h2 here.
			the_title( '<h2 class="entry-title">', '</h2>' );
		} else {
			the_title( '<h1 class="entry-title">', '</h1>' );
		} ?>
	</header>

	<?php if ( is_singular() && ! is_front_page() ) {
		Front\tags()->post_thumbnail();
	} ?>

	<div class="entry-content" itemprop="articleBody">
		<?php
		the_content();

		wp_link_pages( [
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'spr-two' ),
			'after'  => '</div>',
		] );
		?>
	</div>
</article>
