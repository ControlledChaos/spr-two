<?php
/**
 * The template for displaying all pages
 *
 * @package    SPR_Two
 * @subpackage Templates
 * @category   Posts
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

		<?php while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content/content', 'page' . $sprt_acf->suffix() );

		endwhile; // End of the loop.
		?>

		</main>
	</div>
	<?php

	// Get the default sidebar file.
	get_sidebar();
	?>
</div><!-- #content -->
<?php

// Get the default footer file.
get_footer();
