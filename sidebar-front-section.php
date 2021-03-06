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
<aside id="front-section-sidebar" class="widget-area">
	<?php dynamic_sidebar( 'front-section' ); ?>
</aside>
