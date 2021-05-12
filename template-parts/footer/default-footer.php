<?php
/**
 * The default header of any page
 *
 * @package    SPR_Two
 * @subpackage Templates
 * @category   Headers
 * @since      1.0.0
 */

namespace SPR_Two;

// Alias namespaces.
use SPR_Two\Classes\Front as Front;

// Copyright HTML.
$copyright = sprintf(
	'<p class="copyright-text" itemscope="itemscope" itemtype="http://schema.org/CreativeWork">&copy; <span class="screen-reader-text">%1s</span><span itemprop="copyrightYear">%2s</span> <span itemprop="copyrightHolder">%3s.</span> %4s.</p>',
	esc_html__( 'Copyright ', 'spr-two' ),
	get_the_time( 'Y' ),
	esc_attr( get_bloginfo( 'name' ) ),
	esc_html__( 'All rights reserved', 'spr-two' )
);

?>
<footer id="colophon" class="site-footer">
	<div class="footer-content global-wrapper footer-wrapper">
			<?php echo apply_filters( 'sprt_footer_copyright', $copyright ); ?>
	</div>
</footer>