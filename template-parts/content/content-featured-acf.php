<?php
/**
 * Template part for displaying page content in page.php
 *
 * @package    SPR_Two
 * @subpackage Templates
 * @category   Content
 * @since      1.0.0
 */

namespace SPR_Two;

// Alias namespaces.
use SPR_Two\Classes\Front as Front;

$mls_number    = get_field( 'spr_featured_mls' );
$mls_shortcode = sprintf(
	'[idx_listing_details listing="%s"]',
	$mls_number
);

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">

	<header class="entry-header">
		<?php
		printf(
			'<h1 class="entry-title">%s %s</h1>',
			get_field( 'spr_featured_heading' ),
			"(MLS# $mls_number)"
		);
		?>
	</header>

	<div class="entry-content" itemprop="articleBody">
		<?php echo do_shortcode( $mls_shortcode ); ?>
	</div>
</article>

<?php echo Front\tags()->featured_navigation(); ?>
