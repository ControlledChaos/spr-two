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

// Get ACF fields.
$_ = get_field( '' );
$location      = get_field( 'spr_location_search' );
$search_type   = get_field( 'spr_location_type' );
$area_specific = get_field( 'spr_location_area_specific' );
$property_type = get_field( 'spr_location_property_type' );
$list_top      = get_field( 'spr_location_map' );
$filter_by     = get_field( 'spr_location_filter' );
$sort_by       = get_field( 'spr_location_sort' );
$status        = get_field( 'spr_location_status' );
$per_page      = get_field( 'spr_location_per_page' );

/**
 * Search type
 *
 * Defines the location to be searched.
 */

// Define the area type if area is the search type.
if ( 'none' != $area_specific ) {

	$area_type = 'MLSAreaMinor';

	if ( 'n' == $area_specific ) {
		$specific = ' North';
	} elseif ( 's' == $area_specific ) {
		$specific = ' South';
	} elseif ( 'e' == $area_specific ) {
		$specific = ' East';
	} elseif ( 'w' == $area_specific ) {
		$specific = ' West';
	} elseif ( 'ne' == $area_specific ) {
		$specific = ' NE';
	} elseif ( 'nw' == $area_specific ) {
		$specific = ' NW';
	} elseif ( 'se' == $area_specific ) {
		$specific = ' SE';
	} elseif ( 'sw' == $area_specific ) {
		$specific = ' SW';
	} elseif ( 'rural' == $area_specific ) {
		$specific = ' Rural';
	} elseif ( 'n_rural' == $area_specific ) {
		$specific = ' North Rural';
	} elseif ( 's_rural' == $area_specific ) {
		$specific = ' South Rural';
	} elseif ( 'e_rural' == $area_specific ) {
		$specific = ' East Rural';
	} elseif ( 'w_rural' == $area_specific ) {
		$specific = ' West Rural';
	} elseif ( 'ne_rural' == $area_specific ) {
		$specific = ' NE Rural';
	} elseif ( 'nw_rural' == $area_specific ) {
		$specific = ' NW Rural';
	} elseif ( 'se_rural' == $area_specific ) {
		$specific = ' SE Rural';
	} elseif ( 'sw_rural' == $area_specific ) {
		$specific = ' SW Rural';
	}

} else {
	$area_type = 'MLSArea';
	$specific = '';
}

// Listings status.
if ( 'active_contract' == $status ) {
	$status = 'Active Under Contract';
} elseif ( 'pending' == $status ) {
	$status = 'Pending';
} elseif ( 'closed' == $status ) {
	$status = 'Closed';
} else {
	$status = 'Active';
}

// Define the search type.
if ( 'area' == $search_type ) {
	$search_type = $area_type;
} elseif ( 'zip' == $search_type ) {
	$search_type = 'PostalCode';
} elseif ( 'county' == $search_type ) {
	$search_type = 'CountyOrParish';
} else {
	$search_type = 'City';
}

/**
 * Property type searched
 *
 * Variables used to populate the MLS shortcode and
 * to display the search parameters to users.
 *
 * Do not translate strings for which the variables
 * end with `_code`. These are shortcode attributes
 * and need to remain as they are, in English.
 */

// Residential properties.
if ( 'res_sale' == $property_type ) {

	// Primary property type.
	$type_code = 'A';
	$type_name = __( 'residential properties', 'spr-two' );

	// Secondary property type.
	$sub_type_code  = get_field( 'spr_location_res_sale_type' );

	if ( 'single' == $sub_type_code ) {
		$sub_type_code = 'Single Family Residence';
		$sub_type_name = __( 'Single family homes', 'spr-two' );

	} elseif ( 'man_on_land' == $sub_type_code ) {
		$sub_type_code = 'Manufactured On Land';
		$sub_type_name = __( 'manufactured homes on land', 'spr-two' );

	} elseif ( 'condo' == $sub_type_code ) {
		$sub_type_code = 'Condominium';
		$sub_type_name = __( 'condominiums', 'spr-two' );

	} elseif ( 'townhouse' == $sub_type_code ) {
		$sub_type_code = 'Townhouse';
		$sub_type_name = __( 'townhouses', 'spr-two' );

	} else {
		$sub_type_code = null;
		$sub_type_name = null;
	}

// Residential income properties.
} elseif ( 'res_income' == $property_type ) {

	// Primary property type.
	$type_code = 'B';
	$type_name = __( 'residential income properties', 'spr-two' );

	// Secondary property type.
	$sub_type_code  = get_field( 'spr_location_res_sale_income_type' );

	if ( 'duplex' == $sub_type_code ) {
		$sub_type_code = 'Duplex';
		$sub_type_name = __( 'duplexes', 'spr-two' );

	} elseif ( 'triplex' == $sub_type_code ) {
		$sub_type_code = 'Triplex';
		$sub_type_name = __( 'triplexes', 'spr-two' );

	} elseif ( 'quadplex' == $sub_type_code ) {
		$sub_type_code = 'Quadruplex';
		$sub_type_name = __( 'quadruplexes', 'spr-two' );

	} elseif ( 'fiveplex' == $sub_type_code ) {
		$sub_type_code = '5+ Units';
		$sub_type_name = __( '5+ unit buildings', 'spr-two' );

	} else {
		$sub_type_code = null;
		$sub_type_name = null;
	}

} elseif ( 'res_lease' == $property_type ) {

	// Primary property type.
	$type_code = 'H';
	$type_name = __( 'residential leases', 'spr-two' );

	// Secondary property type.
	$sub_type_code  = get_field( 'spr_location_res_lease_type' );

	if ( 'single' == $sub_type_code ) {
		$sub_type_code = 'Single Family Residence';
		$sub_type_name = __( 'Single family homes', 'spr-two' );

	} elseif ( 'man_on_land' == $sub_type_code ) {
		$sub_type_code = 'Manufactured On Land';
		$sub_type_name = __( 'manufactured homes on land', 'spr-two' );

	} elseif ( 'condo' == $sub_type_code ) {
		$sub_type_code = 'Condominium';
		$sub_type_name = __( 'condominiums', 'spr-two' );

	} elseif ( 'townhouse' == $sub_type_code ) {
		$sub_type_code = 'Townhouse';
		$sub_type_name = __( 'townhouses', 'spr-two' );

	} elseif ( 'apartment' == $sub_type_code ) {
		$sub_type_code = 'Apartment';
		$sub_type_name = __( 'apartment buildings', 'spr-two' );

	} else {
		$sub_type_code = null;
		$sub_type_name = null;
	}

} elseif ( 'man_in_park' == $property_type ) {

	// Primary property type.
	$type_code = 'C';
	$type_name = __( 'manufactured in park', 'spr-two' );

	// Secondary property type.
	$sub_type_code  = get_field( 'spr_location_manufactured_type' );

	if ( 'single' == $sub_type_code ) {
		$sub_type_code = 'Single Wide';
		$sub_type_name = __( 'single wide homes', 'spr-two' );

	} elseif ( 'double' == $sub_type_code ) {
		$sub_type_code = 'Double Wide';
		$sub_type_name = __( 'double wide homes', 'spr-two' );

	} elseif ( 'triple' == $sub_type_code ) {
		$sub_type_code = 'Triple Wide';
		$sub_type_name = __( 'triple wide homes', 'spr-two' );

	} elseif ( 'quad' == $sub_type_code ) {
		$sub_type_code = 'Quad Wide';
		$sub_type_name = __( 'quad wide homes', 'spr-two' );

	} elseif ( 'expando' == $sub_type_code ) {
		$sub_type_code = 'Expando';
		$sub_type_name = __( 'expando homes', 'spr-two' );

	} else {
		$sub_type_code = null;
		$sub_type_name = null;
	}

} elseif ( 'farm' == $property_type ) {

	// Primary property type.
	$type_code = 'E';
	$type_name = __( 'farm', 'spr-two' );

	// Secondary property type.
	$sub_type_code  = '';

} elseif ( 'land' == $property_type ) {

	// Primary property type.
	$type_code = 'D';
	$type_name = __( 'land', 'spr-two' );

	// Secondary property type.
	$sub_type_code  = get_field( 'spr_location_land_type' );

	if ( 'residential' == $sub_type_code ) {
		$sub_type_code = 'Residential';
		$sub_type_name = __( 'residential land', 'spr-two' );

	} elseif ( 'commercial' == $sub_type_code ) {
		$sub_type_code = 'Commercial';
		$sub_type_name = __( 'commercial land', 'spr-two' );

	} elseif ( 'agricultural' == $sub_type_code ) {
		$sub_type_code = 'Agricultural';
		$sub_type_name = __( 'agricultural land', 'spr-two' );

	} elseif ( 'industrial' == $sub_type_code ) {
		$sub_type_code = 'Industrial';
		$sub_type_name = __( 'industrial land', 'spr-two' );

	} else {
		$sub_type_code = null;
		$sub_type_name = null;
	}

} elseif ( 'com_sale' == $property_type ) {

	// Primary property type.
	$type_code = 'F';
	$type_name = __( 'commercial properties', 'spr-two' );

	// Secondary property type.
	$sub_type_code  = get_field( 'spr_location_commercial_type' );

	if ( 'general' == $sub_type_code ) {
		$sub_type_code = 'General';
		$sub_type_name = __( 'general commercial properties', 'spr-two' );

	} elseif ( 'office' == $sub_type_code ) {
		$sub_type_code = 'Office';
		$sub_type_name = __( 'office properties', 'spr-two' );

	} elseif ( 'lodging' == $sub_type_code ) {
		$sub_type_code = 'Hotel/Motel';
		$sub_type_name = __( 'hotel & motel properties', 'spr-two' );

	} elseif ( 'entertainment' == $sub_type_code ) {
		$sub_type_code = 'Sports/Entertainment';
		$sub_type_name = __( 'sports & entertainment properties', 'spr-two' );

	} elseif ( 'industrial' == $sub_type_code ) {
		$sub_type_code = 'Industrial';
		$sub_type_name = __( 'industrial properties', 'spr-two' );

	} elseif ( 'senior' == $sub_type_code ) {
		$sub_type_code = 'Senior Housing';
		$sub_type_name = __( 'senior housing properties', 'spr-two' );

	} elseif ( 'mobile' == $sub_type_code ) {
		$sub_type_code = 'Mobile Home';
		$sub_type_name = __( 'mobile properties', 'spr-two' );

	} elseif ( 'specialty' == $sub_type_code ) {
		$sub_type_code = 'Specialty';
		$sub_type_name = __( 'specialty properties', 'spr-two' );

	} else {
		$sub_type_code = null;
		$sub_type_name = null;
	}

} elseif ( 'com_lease' == $property_type ) {

	// Primary property type.
	$type_code = 'I';
	$type_name = __( 'commercial leases', 'spr-two' );

	// Secondary property type.
	$sub_type_code  = get_field( 'spr_location_commercial_type' );

	if ( 'general' == $sub_type_code ) {
		$sub_type_code = 'General';
		$sub_type_name = __( 'general commercial properties', 'spr-two' );

	} elseif ( 'office' == $sub_type_code ) {
		$sub_type_code = 'Office';
		$sub_type_name = __( 'office properties', 'spr-two' );

	} elseif ( 'lodging' == $sub_type_code ) {
		$sub_type_code = 'Hotel/Motel';
		$sub_type_name = __( 'hotel & motel properties', 'spr-two' );

	} elseif ( 'entertainment' == $sub_type_code ) {
		$sub_type_code = 'Sports/Entertainment';
		$sub_type_name = __( 'sports & entertainment properties', 'spr-two' );

	} elseif ( 'industrial' == $sub_type_code ) {
		$sub_type_code = 'Industrial';
		$sub_type_name = __( 'industrial properties', 'spr-two' );

	} elseif ( 'senior' == $sub_type_code ) {
		$sub_type_code = 'Senior Housing';
		$sub_type_name = __( 'senior housing properties', 'spr-two' );

	} elseif ( 'mobile' == $sub_type_code ) {
		$sub_type_code = 'Mobile Home';
		$sub_type_name = __( 'mobile properties', 'spr-two' );

	} elseif ( 'specialty' == $sub_type_code ) {
		$sub_type_code = 'Specialty';
		$sub_type_name = __( 'specialty properties', 'spr-two' );

	} else {
		$sub_type_code = null;
		$sub_type_name = null;
	}

} elseif ( 'bus_opp' == $property_type ) {

	// Primary property type.
	$type_code = 'G';
	$type_name = __( 'business opportunities', 'spr-two' );

	// Secondary property type.
	$sub_type_code  = get_field( 'spr_location_opportunity_type' );

	if ( 'office' == $sub_type_code ) {
		$sub_type_code = 'Office';
		$sub_type_name = __( 'office opportunities', 'spr-two' );

	} elseif ( 'lodging' == $sub_type_code ) {
		$sub_type_code = 'Hotel/Motel';
		$sub_type_name = __( 'hotel & motel opportunities', 'spr-two' );

	} elseif ( 'entertainment' == $sub_type_code ) {
		$sub_type_code = 'Sports/Entertainment';
		$sub_type_name = __( 'sports & entertainment opportunities', 'spr-two' );

	} elseif ( 'commercial' == $sub_type_code ) {
			$sub_type_code = 'Commercial';
			$sub_type_name = __( 'commercial opportunities', 'spr-two' );

	} elseif ( 'industrial' == $sub_type_code ) {
		$sub_type_code = 'Industrial';
		$sub_type_name = __( 'industrial opportunities', 'spr-two' );

	} elseif ( 'senior' == $sub_type_code ) {
		$sub_type_code = 'Senior Housing';
		$sub_type_name = __( 'senior housing opportunities', 'spr-two' );

	} elseif ( 'mobile' == $sub_type_code ) {
		$sub_type_code = 'Mobile Home';
		$sub_type_name = __( 'mobile opportunities', 'spr-two' );

	} elseif ( 'specialty' == $sub_type_code ) {
		$sub_type_code = 'Specialty';
		$sub_type_name = __( 'specialty opportunities', 'spr-two' );

	} else {
		$sub_type_code = null;
		$sub_type_name = null;
	}

} else {

	// Primary property type.
	$type_code = null;
	$type_name = __( 'all property types', 'spr-two' );

	// Secondary property type.
	$sub_type_code = null;
	$sub_type_name = null;
}

// Search parameters.
$search_params = [
	$type_name,
	$sub_type_name
];
$search_params = implode( ', ', $search_params );

// Assemble the MLS shortcode.
$mls_code = sprintf(
	'[idx_listing_summary title="" source="location" location="%s=%s&%s" property_type="%s" property_sub_type="%s" display="all" sort="%s" listings_per_page="%s" status="%s" default_view="%s"]',
	$search_type,
	$location . $specific,
	$location . $specific,
	$type_code,
	$sub_type_code,
	$sort_by,
	$per_page,
	$status,
	$list_top
);

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php
		printf(
			'<p>%s %s</p>',
			__( 'Search Parameters:', 'spr-two' ),
			ucwords( $search_params )
		);
		?>
	</header>

	<div class="entry-content" itemprop="articleBody">
		<?php
		if (
			is_plugin_active( 'flexmls-idx/flexmls_connect.php' ) ||
			is_plugin_active( 'mls-idx/mls-idx.php' )
		) {
			echo do_shortcode( $mls_code );
		}
		?>
	</div>
</article>
