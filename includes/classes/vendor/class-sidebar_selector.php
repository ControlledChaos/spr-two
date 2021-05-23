<?php
/**
 * Sidebar selector field
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
class Sidebar_Selector extends \acf_field {

	/**
	 * Constructor method
	 *
	 * @since  1.0.0
	 * @access public
	 * @return self
	 */
	public function __construct() {

		$this->name     = 'sidebar_selector';
		$this->label    = __( 'Sidebar Selector', 'spr-two' );
		$this->category = __( "Choice",'spr-two' );
		$this->defaults = [
			'allow_null'    => '1',
			'default_value' => ''
		];

    	parent :: __construct();

	}

	/**
	 * Field options
	 *
	 * Creates the options for the field, they are shown when the user
	 * creates a field in the back-end. Currently there are two fields.
	 *
	 * Allowing null determines if the user is allowed to select no sidebars.
	 *
	 * The default value can set the dropdown to a pre-set value when loaded.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param array $field The details of this field.
	 * @return void
	 */
	public function render_field_settings( $field ) {

		acf_render_field_setting( $field, [
			'label'   => __( 'Allow Null?', 'spr-two' ),
			'type'    => 'radio',
			'name'    => 'allow_null',
			'layout'  =>  'horizontal',
			'choices' =>  [
				'1' => __( 'Yes', 'spr-two' ),
				'0' => __( 'No', 'spr-two' ),
			]
		]);

		acf_render_field_setting( $field, [
			'label' => __( 'Default Value','spr-two' ),
			'type'  => 'text',
			'name'  => 'default_value',
		]);
	}

	/**
	 * Field display
	 *
	 * This function takes care of displaying our field to the users, taking
	 * the field options into account.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param array $field The details of this field.
	 * @author Daniel Pataki
	 * @since 3.0.0
	 *
	 */
	public function render_field( $field ) {

		global $wp_registered_sidebars;

		?>
		<div>
			<select name='<?php echo $field['name'] ?>'>
				<?php if ( $field['allow_null'] ) : ?>
					<option value=''><?php _e( 'Select a Sidebar', 'spr-two' ); ?></option>
				<?php endif ?>
				<?php
					foreach( $wp_registered_sidebars as $sidebar ) :
					$selected = ( ( $field['value'] == $sidebar['id'] ) || ( empty( $field['value'] ) && $sidebar['id'] == $field['default_value'] ) ) ? 'selected="selected"' : '';
				?>
					<option <?php echo $selected; ?> value='<?php echo $sidebar['id']; ?>'><?php echo $sidebar['name']; ?></option>
				<?php endforeach; ?>

			</select>
		</div>
		<?php
	}
}

new Sidebar_Selector();
