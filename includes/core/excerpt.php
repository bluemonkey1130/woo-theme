<?php
	/*--------------------------------------------------
	    | Changes to the WordPress Excerpt
	--------------------------------------------------*/

		# Custom Excerpt Length
		function custom_excerpt_length( $length ) {
		    return 20;
		}
		add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );



		# Add class 'excerpt' to excerpt automatically
		function add_excerpt_class( $excerpt ){
		    $excerpt = str_replace( "<p", "<p class=\"excerpt\"", $excerpt );
		    return $excerpt;
		}
		add_filter( "the_excerpt", "add_excerpt_class" );



		# Add elipses to excerpt automatically
		function wpdocs_excerpt_more( $more ) {
		    return '...';
		}
		add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );