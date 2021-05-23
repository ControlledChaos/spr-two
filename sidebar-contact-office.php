<?php
/**
 * The sidebar Contact & Office information
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
<aside id="contact-office-sidebar" class="widget-area">
	<?php dynamic_sidebar( 'contact-office' ); ?>
</aside>
