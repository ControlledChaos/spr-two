<?php
/**
 * Theme options page output
 *
 * @package    SPR_Two
 * @subpackage Templates
 * @category   Admin
 * @since      1.0.0
 */

namespace SPR_Two\Includes\Options;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Page title.
$title = sprintf(
	'<h1 class="wp-heading-inline">%1s %2s</h1>',
	get_bloginfo( 'name' ),
	__( 'Display Options', 'spr-two' )
);

// Page description.
$description = sprintf(
	'<p class="description">%1s</p>',
	__( 'This is a starter/example page. Use it or remove it.', 'spr-two' )
);

// Begin page output.
?>

<div class="wrap spr-two-options-page">
	<?php echo $title; ?>
	<?php echo $description; ?>
	<hr />
</div><!-- End .wrap -->
