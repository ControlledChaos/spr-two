<?php
/**
 * The template for displaying category archive pages
 *
 * @package    SPR_Two
 * @subpackage Templates
 * @category   Archives
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

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header>

			<?php while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content/content', get_post_type() . $sprt_acf->suffix() );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content/content', 'none' . $sprt_acf->suffix() );

		endif;
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
