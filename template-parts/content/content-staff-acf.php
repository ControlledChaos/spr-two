<?php
/**
 * ACF content for post type: staff
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
	<?php
	if ( is_singular() ) {
		get_template_part( 'template-parts/content/partials/staff', 'single-acf' );
	} else {
		get_template_part( 'template-parts/content/partials/staff', 'archive-acf' );
	}
	?>
</article>
