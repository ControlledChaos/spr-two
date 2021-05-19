<?php
/**
 * The front page header if ACF is active
 *
 * @package    SPR_Two
 * @subpackage Templates
 * @category   Headers
 * @since      1.0.0
 */

namespace SPR_Two;

// Alias namespaces.
use SPR_Two\Classes\Front as Front;

?>
<header id="masthead" class="site-header" role="banner" itemscope="itemscope" itemtype="http://schema.org/Organization">

	<div class="site-branding">

		<?php echo Front\tags()->site_logo(); ?>

		<div class="site-title-description">

			<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>

			<?php
			$site_description = get_bloginfo( 'description', 'display' );
			if ( $site_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $site_description; ?></p>
			<?php endif; ?>

		</div>
	</div>
</header>
