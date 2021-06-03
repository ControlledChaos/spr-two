<?php
/**
 * Front page featured listings for ACF
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
$featured_posts = get_sub_field( 'spr_front_featured_properties' );

if ( $featured_posts ) :

	echo '<ul class="front-featured-slides">';
	foreach ( $featured_posts as $featured_post ) :
		$featured_heading = get_field( 'spr_featured_heading', $featured_post->ID );
		$featured_mls     = get_field( 'spr_featured_mls', $featured_post->ID );
		$mls_array[]      = 'ListingId=' . $featured_mls . '&' . $featured_mls;

		echo '<li>';
		$featured = sprintf(
			'[idx_slideshow link="default" horizontal="1" vertical="1" source="location" location="ListingId=%s&%s" display="all" sort="recently_changed" additional_fields="beds,baths,sqft" destination="local" send_to="photo"]',
			$featured_mls,
			$featured_mls
		);
		echo do_shortcode( $featured );
		echo sprintf(
			'<h3>%s</h3>',
			$featured_heading
		);
		echo '</li>';
	endforeach;
	echo '</ul>';
endif;
