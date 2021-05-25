<?php
/**
 * Visitor toolbar
 *
 * Used for phone number & email.
 * Good for login/logout if
 * necessary in the future.
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
<div id="info-bar">
	<div class="inner">
		<div class="info-bar-one">
			<p><a href="<?php echo esc_url( 'tel:15595612200' ); ?>"><?php echo __( 'Call: ' ) . '1-559-561-2200'; ?></a></p>
		</div>

		<div class="info-bar-two">
			<ul>
				<li><a href="#"><?php _e( 'List Item', 'spr-two' ); ?></a></li>
				<li><a href="#"><?php _e( 'List Item', 'spr-two' ); ?></a></li>
				<li><a href="#"><?php _e( 'List Item', 'spr-two' ); ?></a></li>
			</ul>
		</div>
	</div>
</div>
