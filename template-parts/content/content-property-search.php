<?php
/**
 * Template part for displaying MLS property searches
 *
 * @package    SPR_Two
 * @subpackage Templates
 * @category   Content
 * @since      1.0.0
 */

namespace SPR_Two;

// Alias namespaces.
use SPR_Two\Classes\Front as Front;

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">

	<header class="entry-header">
		<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
	</header>

	<div class="entry-content" itemprop="articleBody">
		<p><?php

		if ( current_user_can( 'activate_plugins' ) ) {
			_e( 'Please install and/or activate the Advanced Custom Fields plugin.' );
		} else {
			$site = get_bloginfo( 'name' );
			_e( "The property search form is not available. Please report this error to {$site}." );
		}

		?></p>
	</div>
</article>
