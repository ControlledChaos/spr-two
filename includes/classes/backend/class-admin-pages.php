<?php
/**
 * Admin pages
 *
 * @package    SPR_Two
 * @subpackage Classes
 * @category   Admin
 * @since      1.0.0
 */

namespace SPR_Two\Classes\Admin;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Admin_Pages {

	/**
	 * Constructor magic method
	 *
	 * @since  1.0.0
	 * @access public
	 * @return self
	 */
	public function __construct() {

		// Theme options page.
		add_action( 'admin_menu', [ $this, 'theme_options' ] );

		// Theme info page.
		add_action( 'admin_menu', [ $this, 'theme_info' ] );
	}

	/**
	 * Theme options page
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function theme_options() {

		// Add a submenu page under Themes.
		$this->help_theme_options = add_submenu_page(
			'themes.php',
			__( 'Display Options', 'spr-two' ),
			__( 'Display Options', 'spr-two' ),
			'manage_options',
			'frontend-display-options',
			[ $this, 'theme_options_output' ],
			-1
		);

		// Add sample help tab.
		add_action( 'load-' . $this->help_theme_options, [ $this, 'help_theme_options' ] );
	}

	/**
     * Get output of the theme options page
     *
     * @since  1.0.0
	 * @access public
	 * @return void
     */
    public function theme_options_output() {
        require get_parent_theme_file_path( '/template-parts/admin/theme-options-page.php' );
	}

	/**
     * Add tabs to the about page contextual help section
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
     */
    public function help_theme_options() {

		// Add to the about page.
		$screen = get_current_screen();
		if ( $screen->id != $this->help_theme_options ) {
			return;
		}

		// More information tab.
		$screen->add_help_tab( [
			'id'       => 'help_theme_options_info',
			'title'    => __( 'More Information', 'spr-two' ),
			'content'  => null,
			'callback' => [ $this, 'help_theme_options_info' ]
		] );

        // Add a help sidebar.
		$screen->set_help_sidebar(
			$this->help_theme_options_sidebar()
		);
	}

	/**
     * Get convert plugin help tab content
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
     */
	public function help_theme_options_info() {
		include_once get_theme_file_path( 'template-parts/partials/help-theme-options-info.php' );
    }

    /**
     * The about page contextual tab sidebar content
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Returns the HTML of the sidebar content.
     */
    public function help_theme_options_sidebar() {

        $html  = sprintf( '<h4>%1s</h4>', __( 'Author Credits', 'spr-two' ) );
        $html .= sprintf(
            '<p>%1s %2s.</p>',
            __( 'This theme was created by', 'spr-two' ),
            'Your Name'
        );
        $html .= sprintf(
            '<p>%1s <br /><a href="%2s" target="_blank">%3s</a> <br />%4s</p>',
            __( 'Visit', 'spr-two' ),
            'https://example.com/',
            'Example Site',
            __( 'for more details.', 'spr-two' )
        );
        $html .= sprintf(
            '<p>%1s</p>',
            __( 'Change this sidebar to give yourself credit for the hard work you did customizing this theme.', 'spr-two' )
         );

		return $html;
	}

	/**
	 * Theme info page
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function theme_info() {

		// Add a submenu page under Themes.
		add_submenu_page(
			'themes.php',
			__( 'Theme Info', 'spr-two' ),
			__( 'Theme Info', 'spr-two' ),
			'manage_options',
			'spr-two-info',
			[ $this, 'theme_info_output' ]
		);
	}

	/**
     * Get output of the theme info page
     *
     * @since  1.0.0
	 * @access public
	 * @return void
     */
    public function theme_info_output() {

		$output = get_theme_file_path( '/template-parts/admin/theme-info-page.php' );
        if ( file_exists( $output ) ) {
			include $output;
		} else { ?>
			<div class="wrap theme-info-page">
				<h1><?php _e( 'Template Error', 'spr-two' ); ?></h1>
				<p class="description"><?php _e( 'The template file for this page was not located.' ); ?></p>
			</div>
		<?php }
	}
}
