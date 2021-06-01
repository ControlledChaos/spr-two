<?php
/**
 * MLS plugin compatibility
 *
 * This class may support more than one MLS plugin.
 *
 * @package    SPR_Two
 * @subpackage Classes
 * @category   Vendor
 * @since      1.0.0
 */

namespace SPR_Two\Classes\Vendor;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

class MLS_Plugin {

	/**
	 * The class object
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    string
	 */
	protected static $class_object;

	/**
	 * Instance of the class
	 *
	 * This method can be used to call an instance
	 * of the class from outside the class.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object Returns an instance of the class.
	 */
	public static function instance() {

		if ( is_null( self :: $class_object ) ) {
			self :: $class_object = new self();
		}

		// Return the instance.
		return self :: $class_object;
	}

	/**
	 * Constructor method
	 *
	 * @since  1.0.0
	 * @access public
	 * @return self
	 */
	public function __construct() {}

	/**
	 * FlexMLS IDX active
	 *
	 * @since  1.0.0
	 * @access public
	 * @return boolean Returns true if the FlexMLS IDX plugin is active.
	 */
	public function flexmls_idx() {

		if ( is_plugin_active( 'flexmls-idx/flexmls_connect.php' ) ) {
			return true;
		}
		return false;
	}
}

/**
 * Instance of the class
 *
 * @since  1.0.0
 * @access public
 * @return object MLS_Plugin Returns an instance of the class.
 */
function mls() {
	return MLS_Plugin :: instance();
}
