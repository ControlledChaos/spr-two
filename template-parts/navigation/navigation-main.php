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
	<button class="menu-toggle" aria-controls="main-menu" aria-expanded="false">
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="theme-icon menu-icon"><path d="M16 132h416c8.837 0 16-7.163 16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z"/></svg>
		<?php esc_html_e( 'Menu', 'spr-two' ); ?>
	</button>
	<?php
	wp_nav_menu( [
		'theme_location' => 'main',
		'menu_id'        => 'main-menu',
	] );
	?>
</nav>
