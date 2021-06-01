<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @package    SPR_Two
 * @subpackage Templates
 * @category   Content
 * @since      1.0.0
 */

namespace SPR_Two;

// Alias namespaces.
use SPR_Two\Classes\Front  as Front,
	SPR_Two\Classes\Vendor as Vendor;

// Not found message.
if ( is_search() ) {
	$message = __( 'Sorry, but nothing matched your search terms.', 'spr-two' );
} else {
	$message = __( 'It seems we can&rsquo;t find what you&rsquo;re looking for.', 'spr-two' );
}

// Search form from the MLS plugin.
$mls_search = '[]';

?>
<div class="no-results not-found">

	<header class="page-header">
		<h1 class="entry-title"><?php esc_html_e( 'Nothing Found', 'spr-two' ); ?></h1>
	</header>

	<div class="page-content" itemprop="articleBody">

		<p><?php echo $message; ?></p>

		<?php

		if ( Vendor\mls()->flexmls_idx() ) :

		?>
		<div class="mls-search-form mls-search-page">

			<h2><?php _e( 'Property Search', 'spr-two' ); ?></h2>
			<p><?php _e( 'Would you like to search available properties?', 'spr-two' ); ?></p>

			<?php echo do_shortcode( $mls_search ); ?>
		</div>
		<?php

		else :
			get_search_form();
		endif;

		?>
	</div>
</div>
