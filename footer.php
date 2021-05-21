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
	<button onclick="topFunction()" id="back-to-top" title="Go to top"><svg role="presentation" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M4.465 366.475l7.07 7.071c4.686 4.686 12.284 4.686 16.971 0L224 178.053l195.494 195.493c4.686 4.686 12.284 4.686 16.971 0l7.07-7.071c4.686-4.686 4.686-12.284 0-16.97l-211.05-211.051c-4.686-4.686-12.284-4.686-16.971 0L4.465 349.505c-4.687 4.686-4.687 12.284 0 16.97z"/></svg><span class="screen-reader-text"><?php _e( 'Top', 'spr-two' ); ?></span></button>

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
<?php if ( is_front_page() ) : ?>
<script>
jQuery(document).ready(function($) {
	var offset = -180;
	$('a[href*="#"]')
	// Remove links that don't actually link to anything
	.not('[href="#"]')
	.not('[href="#0"]')
	.click(function(event) {
		// On-page links
		if (
			location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
			&&
			location.hostname == this.hostname
			) {
			// Figure out element to scroll to
			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
			// Does a scroll target exist?
			if (target.length) {
				// Only prevent default if animation is actually gonna happen
				event.preventDefault();
				$('html, body').animate({
				scrollTop: target.offset().top + offset
				}, 500, function() {
					// Callback after animation
					// Must change focus!
					var $target = $(target);
					$target.focus();
					if ($target.is(":focus")) { // Checking if the target was focused
						return false;
					} else {
						$target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
						$target.focus(); // Set focus again
					};
				});
			}
		}
	});
});
</script>
<?php endif; ?>
<script>
jQuery(document).ready( function($) {
	$(window).scroll( function() {
		if ( $(this).scrollTop() > 640 ) {
			$( '#back-to-top' ).fadeIn( 350 );
		} else {
			$( '#back-to-top' ).fadeOut( 350 );
		}
	});

	$( '#back-to-top' ).click( function() {
		$( 'html, body' ).animate( { scrollTop : 0 }, 500 );
	});
});
</script>

<script>
// Add class to header wrapper on scroll.
jQuery(document).ready( function($) {
	$(window).scroll( function(){

		header_height = $( '.site-header-wrap' ).outerHeight();

		if ( $(this).scrollTop() > header_height ) {
			$( '.site-header-wrap' ).addClass( 'stuck' );
		} else {
			$( '.site-header-wrap' ).removeClass( 'stuck' );
		}
	});
});
</script>

<script>
jQuery(document).ready( function($) {
	$( '#secondary' ).stick_in_parent({
		offset_top   : 70,
		recalc_every : 1
	});
});
</script>

<style>
#secondary.stuck {
	position: fixed;
	top: 120px;
}
#back-to-top {
	display: none;
	position: fixed;
	right: 2rem;
	bottom: 2rem;
	transition: none;
}
</style>

</body>
</html>
