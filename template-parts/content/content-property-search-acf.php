<?php
/**
 * ACF template part for displaying MLS property searches
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
$form_code = get_field( 'spr_search_template_shortcode' );

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">

	<header class="entry-header">
		<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
	</header>

	<div class="entry-content" itemprop="articleBody">

		<?php the_content(); ?>

		<div class="mls-search-form mls-search-page">
			<?php echo do_shortcode( $form_code ); ?>
		</div>
	</div>
</article>
