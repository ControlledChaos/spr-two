<?php
/**
 * The default, main navigation
 *
 * @package    SPR_Two
 * @subpackage Templates
 * @category   Navigation
 * @since      1.0.0
 */

namespace SPR_Two;

// Alias namespaces.
use SPR_Two\Classes\Front as Front;

?>
<nav id="site-navigation" class="main-navigation" role="directory" itemscope itemtype="http://schema.org/SiteNavigationElement">

	<div>
		<button class="button menu-toggle" aria-controls="main-menu" aria-expanded="false">
			<?php esc_html_e( 'Menu', 'spr-two' ); ?>
		</button>
	</div>

	<?php
	wp_nav_menu( [
		'theme_location' => 'main',
		'menu_id'        => 'main-menu',
	] );
	?>
</nav>
