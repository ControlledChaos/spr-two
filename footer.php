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

</body>
</html>
