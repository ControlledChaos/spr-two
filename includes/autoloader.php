<?php
/**
 * Class autoloader
 *
 * @package    SPR_Two
 * @subpackage Includes
 * @category   Core
 * @since      1.0.0
 */

namespace SPR_Two;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class files
 *
 * Defines the class directories and file prefixes.
 *
 * @since 1.0.0
 * @var   array Defines an array of class file paths.
 */
define( 'SPRT_CLASS', [
	'core'      => SPRT_PATH . 'includes/classes/core/class-',
	'settings'  => SPRT_PATH . 'includes/classes/settings/class-',
	'tools'     => SPRT_PATH . 'includes/classes/tools/class-',
	'media'     => SPRT_PATH . 'includes/classes/media/class-',
	'users'     => SPRT_PATH . 'includes/classes/users/class-',
	'widgets'   => SPRT_PATH . 'includes/classes/widgets/class-',
	'vendor'    => SPRT_PATH . 'includes/classes/vendor/class-',
	'admin'     => SPRT_PATH . 'includes/classes/backend/class-',
	'front'     => SPRT_PATH . 'includes/classes/frontend/class-',
	'customize' => SPRT_PATH . 'includes/classes/customizer/class-',
	'general'   => SPRT_PATH . 'includes/classes/class-',
] );

/**
 * Classes namespace
 *
 * @since 1.0.0
 * @var   string Defines the namespace of class files.
 */
define( 'SPRT_CLASS_NS', __NAMESPACE__ . '\Classes' );

/**
 * Array of classes to register
 *
 * When you add new classes to your version of this theme you may
 * add them to the following array rather than requiring the file
 * elsewhere. Be sure to include the precise namespace.
 *
 * SAMPLES: Uncomment sample classes to load them.
 *
 * @since 1.0.0
 * @var   array Defines an array of class files to register.
 */
define( 'SPRT_CLASSES', [

	// Core classes.
	SPRT_CLASS_NS . '\Core\Assets' => SPRT_CLASS['core'] . 'assets.php',
	SPRT_CLASS_NS . '\Core\Setup'  => SPRT_CLASS['core'] . 'setup.php',

	// Widgets classes.
	SPRT_CLASS_NS . '\Widgets\Register'   => SPRT_CLASS['widgets'] . 'register.php',
	SPRT_CLASS_NS . '\Widgets\Theme_Mode' => SPRT_CLASS['widgets'] . 'theme-mode.php',

	// Media classes.
	SPRT_CLASS_NS . '\Media\Images' => SPRT_CLASS['media'] . 'images.php',

	// Frontend classes.
	SPRT_CLASS_NS . '\Front\Head'          => SPRT_CLASS['front'] . 'head.php',
	SPRT_CLASS_NS . '\Front\Template_Tags' => SPRT_CLASS['front'] . 'template-tags.php',
	SPRT_CLASS_NS . '\Front\Assets'        => SPRT_CLASS['front'] . 'assets.php',
	SPRT_CLASS_NS . '\Front\Layout'        => SPRT_CLASS['front'] . 'layout.php',

	// Backend classes.
	SPRT_CLASS_NS . '\Admin\Admin_Pages'  => SPRT_CLASS['admin'] . 'admin-pages.php',
	SPRT_CLASS_NS . '\Admin\Assets'       => SPRT_CLASS['admin'] . 'assets.php',
	SPRT_CLASS_NS . '\Admin\Block_Editor' => SPRT_CLASS['admin'] . 'block-editor.php',

	// Customizer classes.
	SPRT_CLASS_NS . '\Customize\Customizer' => SPRT_CLASS['customize'] . 'customizer.php',

	// Vendor classes.
	SPRT_CLASS_NS . '\Vendor\Plugin'    => SPRT_CLASS['vendor'] . 'plugin.php',
	SPRT_CLASS_NS . '\Vendor\Theme_ACF' => SPRT_CLASS['vendor'] . 'theme-acf.php',

	// General/miscellaneous classes.
	SPRT_CLASS_NS . '\Activate\Activate'   => SPRT_CLASS['general'] . 'activate.php',
	SPRT_CLASS_NS . '\Activate\Deactivate' => SPRT_CLASS['general'] . 'deactivate.php',

] );

/**
 * Autoload class files
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
spl_autoload_register(
	function ( string $class ) {
		if ( isset( SPRT_CLASSES[ $class ] ) ) {
			require SPRT_CLASSES[ $class ];
		}
	}
);
