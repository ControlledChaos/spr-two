<?php
/**
 * The default head section of any page
 *
 * @package    SPR_Two
 * @subpackage Templates
 * @category   Headers
 * @since      1.0.0
 */

namespace SPR_Two;

?>
<head id="<?php echo esc_attr( get_bloginfo( 'url' ) ); ?>" data-template-set="<?php echo esc_attr( get_template() ); ?>">

	<meta charset="<?php esc_attr( bloginfo( 'charset' ) ); ?>">
	<!--[if IE ]>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<![endif]-->
	<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">

	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link href="<?php echo esc_attr( $canonical ); ?>" rel="canonical" />

	<?php if ( is_search() ) { echo esc_attr( '<meta name="robots" content="noindex,nofollow" />' ); } ?>

	<!-- Preload font files -->
	<link rel="preload" href="<?php echo esc_url( get_theme_file_uri( '/assets/fonts/crimson/crimson-pro-roman.woff' ) ); ?>" />
	<link rel="preload" href="<?php echo esc_url( get_theme_file_uri( '/assets/fonts/crimson/crimson-pro-italic.woff' ) ); ?>" />
	<link rel="preload" href="<?php echo esc_url( get_theme_file_uri( '/assets/fonts/EBGaramond-Regular.woff2' ) ); ?>" />
	<link rel="preload" href="<?php echo esc_url( get_theme_file_uri( '/assets/fonts/EBGaramond-Italic.woff2' ) ); ?>" />

	<?php
	// Hook into the head.
	do_action( 'SPR_Two\before_wp_head' );
	wp_head();
	do_action( 'SPR_Two\after_wp_head' );
	?>

</head>
