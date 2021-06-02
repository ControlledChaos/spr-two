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

if ( is_singular() ) {

	$title = sprintf(
		'<h1 class="entry-title">%s %s</h1>',
		get_field( 'spr_featured_heading' ),
		"(MLS# $mls_number)"
	);

	$mls_shortcode = sprintf(
		'[idx_listing_details listing="%s"]',
		$mls_number
	);

} else {

	$title = sprintf(
		'<h2 class="entry-title"><a href="%s">%s</a></h2>',
		get_permalink(),
		get_field( 'spr_featured_heading' )
	);

	$mls_shortcode = sprintf(
		'[idx_listing_summary source="location" location="ListingId=%s" default_view="list"]',
		$mls_number . '&' . $mls_number
	);
}

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">

	<header class="entry-header">
		<?php echo $title; ?>
	</header>

	<div class="entry-content" itemprop="articleBody">
		<?php echo do_shortcode( $mls_shortcode ); ?>
	</div>
</article>

<?php if ( is_singular() ) {
	echo Front\tags()->post_navigation();
} ?>
