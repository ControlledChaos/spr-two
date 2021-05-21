<?php
/**
 * The sidebar for the front page listings section
 *
 * @package    SPR_Two
 * @subpackage Templates
 * @category   Asides
 * @since      1.0.0
 */

namespace SPR_Two;

// Alias namespaces.
use SPR_Two\Classes\Front as Front;

?>
<div class="sticky-wrapper"><!-- Needed for Sticky-kit JS to work. -->
	<aside id="secondary" class="widget-area">
		<?php dynamic_sidebar( 'sidebar-front-section' ); ?>
	</aside>
</div>
