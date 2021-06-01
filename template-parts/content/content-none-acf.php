<?php
/**
 * ACF template part for displaying a message that posts cannot be found
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
	$message = __( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'spr-two' );
} else {
	$message = __( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'spr-two' );
}

// Search form from the MLS plugin.
$mls_search = '[idx_search title="" link="1lkpig7k5t4z" buttontext="Find Now" detailed_search="on" destination="local" user_sorting="off" location_search="on" property_type_enabled="off" property_type="A,B,D" std_fields="beds,baths,square_footage,list_price" theme="hori_square_light" orientation="horizontal" title_font="" border_style="squared" widget_drop_shadow="on" background_color="#222222" title_text_color="#ffffff" field_text_color="#ffffff" detailed_search_text_color="#ffffff" submit_button_shine="shine" submit_button_background="#222222" submit_button_text_color="#ffffff" allow_sold_searching="off" default_view="list" listings_per_page="10" allow_pending_searching="off"]';

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
