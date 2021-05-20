<?php
/**
 * The template for displaying the footer
 *
 * @package    SPR_Two
 * @subpackage Templates
 * @category   Footers
 * @since      1.0.0
 */

namespace SPR_Two;

// Alias namespaces.
use SPR_Two\Classes\Front as Front;

?>
	<?php Front\tags()->before_footer(); ?>
	<?php Front\tags()->footer(); ?>
	<?php Front\tags()->after_footer(); ?>

</div><!-- #page -->

<?php Front\tags()->after_page(); ?>
<?php wp_footer(); ?>

<?php

// Add the sticky menu script.
if ( is_front_page() ) :
echo sprintf(
	'<script>%s</script>',
	'jQuery(document).ready(function(){
		jQuery( ".front-featured-properties ul" ).slick({
			autoplay : true,
			autoplaySpeed : 7500,
			speed : 750,
			fade : true,
			easing : "easeInOut"
		});
	  });'
); endif; ?>
<script>
document.addEventListener( 'wpcf7mailsent', function( event ) {
    location = 'http://sequoiapacificrealty.com/application-deposit/';
}, false );
</script>

</body>
</html>
