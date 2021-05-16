<?php
/**
 * Default 404 error page content
 *
 * @package    SPR_Two
 * @subpackage Templates
 * @category   Content
 * @since      1.0.0
 */

namespace SPR_Two;

?>
<div class="page-content">

	<h1 class="page-title"><?php esc_html_e( 'That page can\'t be found.', 'spr-two' ); ?></h1>

	<?php printf(
		'<p>%s <a href="%s">%s</a> %s <a href="%s">%s</a></p>',
		__( 'This site is set to display a static home page but the ID of that page was found. Try choosing a static front page in the', 'spr-two' ),
		esc_url( admin_url( 'options-reading.php' ) ),
		__( 'Reading Settings', 'spr-two' ),
		__( 'or', 'spr-two' ),
		esc_url( admin_url( 'edit.php?post_type=page' ) ),
		__( 'add a new page.', 'spr-two' )
	); ?>

</div>
