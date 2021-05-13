<?php
/**
 * BS Theme functions
 *
 * A basic starter theme for WordPress and ClassicPress.
 *
 * @package    SPR_Two
 * @subpackage Functions
 * @since      1.0.0
 *
 * @link       https://github.com/ControlledChaos/spr-two
 * @license    http://www.gnu.org/licenses/gpl-3.0.html
 */

/**
 * License & Warranty
 *
 * BS Theme is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * BS Theme is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with BS Theme. If not, see {URI to Plugin License}.
 */

namespace SPR_Two;

// Alias namespaces.
use
SPR_Two\Classes as General,
SPR_Two\Classes\Activate as Activate,
SPR_Two\Classes\Core as Core,
SPR_Two\Classes\Front as Front,
SPR_Two\Classes\Widgets as Widgets,
SPR_Two\Classes\Media as Media,
SPR_Two\Classes\Admin as Admin,
SPR_Two\Classes\Customize as Customize,
SPR_Two\Classes\Vendor as Vendor;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get the PHP version class.
require_once get_parent_theme_file_path( '/includes/classes/core/class-php-version.php' );

/**
 * PHP version check
 *
 * Disables theme front end if the minimum PHP version is not met.
 * Prevents breaking sites running older PHP versions.
 *
 * @since  1.0.0
 * @return void
 */
if ( ! Core\php()->version() && ! is_admin() ) {

	// Get the conditional message.
	$die = Core\php()->frontend_message();

	// Print the die message.
	die( $die );
}

/**
 * Get plugins path
 *
 * Used to check for active plugins with the `is_plugin_active` function.
 * Namespace escaped in example ( \ ) as it sometimes causes an error.
 *
 * @link https://developer.wordpress.org/reference/functions/is_plugin_active/
 *
 * @example The following would check for the Advanced Custom Fields plugin:
 *          ```
 *          if ( \is_plugin_active( 'advanced-custom-fields/acf.php' ) ) {
 *          	// Execute code.
 *           }
 *          ```
 */
$get_plugin = ABSPATH . 'wp-admin/includes/plugin.php';
if ( file_exists( $get_plugin ) ) {
	include_once( $get_plugin );
}

// Get theme configuration file.
require get_parent_theme_file_path( '/includes/config.php' );

// Autoload class files.
require_once SPRT_PATH . 'includes/autoloader.php';

/**
 * Instantiate theme classes
 *
 * @since 1.0.0
 * @see   `includes/autoloader.php`
 */

// Activation classes.
$sprt_activate   = new Classes\Activate\Activate;
$sprt_deactivate = new Classes\Activate\Deactivate;

// Theme setup.
$sprt_core    = new Core\Setup;
$sprt_widgets = new Widgets\Register;
$sprt_media   = new Media\Images;

// Vendor (plugin) classes.
$sprt_acf = new Vendor\Theme_ACF;

// Frontend classes.
if ( ! is_admin() ) {
	$sprt_head   = new Front\Head;
	$sprt_tags   = new Front\Template_Tags;
	$sprt_assets = new Front\Assets;
	$sprt_layout = new Front\Layout;
}

// Backend classes.
if ( is_admin() ) {
	$sprt_admin_assets = new Admin\Assets;
	if ( sprt_has_blocks() ) {
		$sprt_blocks = new Admin\Block_Editor;
	}
}

// Customizer classes.
if ( is_customize_preview() ) {
	$sprt_customize = new Customize\Customizer;
}
