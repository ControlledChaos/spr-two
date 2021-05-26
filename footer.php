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
	<button onclick="topFunction()" id="back-to-top" title="Go to top"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M6.1 422.3l209.4-209.4c4.7-4.7 12.3-4.7 17 0l209.4 209.4c4.7 4.7 4.7 12.3 0 17l-19.8 19.8c-4.7 4.7-12.3 4.7-17 0L224 278.4 42.9 459.1c-4.7 4.7-12.3 4.7-17 0L6.1 439.3c-4.7-4.7-4.7-12.3 0-17zm0-143l19.8 19.8c4.7 4.7 12.3 4.7 17 0L224 118.4l181.1 180.7c4.7 4.7 12.3 4.7 17 0l19.8-19.8c4.7-4.7 4.7-12.3 0-17L232.5 52.9c-4.7-4.7-12.3-4.7-17 0L6.1 262.3c-4.7 4.7-4.7 12.3 0 17z"/></svg><span class="screen-reader-text"><?php _e( 'Top', 'spr-two' ); ?></span></button>

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
<script>
// Fade out the loading screen.
( function($) {
	$(window).load( function() {
		$( 'html' ).addClass( 'site-loaded' );
		$( '.front-page-hero-loader' ).fadeOut( 500 );
	});
})(jQuery);
</script>
<?php endif; // If `front_page()`. ?>
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

// Sticky sidebars (Sticky-kit JS).
jQuery(document).ready( function($) {

	$( '#secondary, #front-section-sidebar, #contact-office-sidebar' ).stick_in_parent({
		offset_top   : 70,
		recalc_every : 1
	});

	$(window).resize( function() {

		var windowSize = jQuery(window).width();

		if ( windowSize.width() <= 768 ) {
			$( '#secondary, #front-section-sidebar, #contact-office-sidebar' ).trigger( 'sticky_kit:detach' ).css( 'position', 'relative' );
		}

		if ( windowSize.width() > 768 ) {
			$( '#secondary, #front-section-sidebar, #contact-office-sidebar' ).stick_in_parent({
				offset_top   : 70,
				recalc_every : 1
			});
		}
	});
});
</script>

</body>
</html>
