<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	/*--------------------------------------------------
	    | Initial Set Up of Theme
	--------------------------------------------------*/

		# Check if the current theme is 'theme' by checking
		# for our setup script, then run the setup functions if needed.

		function execute_site_actions( $blog_id, $user_id, $domain, $path, $site_id, $meta ) {
		    // switch_to_blog($blog_id);

		    // Find and delete the WP default 'Sample Page'
		    $defaultPage = get_page_by_title( 'Sample Page' );
		    wp_delete_post( $defaultPage->ID, $bypass_trash = true );

		    // Find and delete the WP default 'Hello world!' post
		    $defaultPost = get_posts( array( 'title' => 'Hello World!' ) );
		    wp_delete_post( $defaultPost[0]->ID, $bypass_trash = true );

		    // restore_current_blog();
		}



		function after_theme_activation () {
			# Activate a few plugins that are needed from outset on project
			function plugin_activation( $plugin ) {
			    if( ! function_exists('activate_plugin') ) {
			        require_once ABSPATH . 'wp-admin/includes/plugin.php';
			    }

			    if( ! is_plugin_active( $plugin ) ) {
			        activate_plugin( $plugin );
			    }
			}
			plugin_activation('advanced-custom-fields-pro/acf.php');
			plugin_activation('classic-editor/classic-editor.php');
			plugin_activation('wp-nested-pages/nestedpages.php');
			plugin_activation('contact-form-7/wp-contact-form-7.php');
		}
		add_action('after_switch_theme', 'after_theme_activation');


	/*----------------------------------------------
		| Theme adjustments based on environment
	----------------------------------------------*/

		if (
			$_SERVER["SERVER_ADDR"] == '192.168.33.10' ||
			$_SERVER['SERVER_NAME'] == 'hawthornelifestyle.local') {

			# Disable 'Search Engine Visibility'
			function set_public_status(){
				if (get_option( 'blog_public' ) == 1 ){
					update_option('blog_public', 0);
				}
			}
			add_action( 'init', 'set_public_status' );

			# Disable caching and security on local
			function disable_plugins(){
				# Required to check
				include_once(ABSPATH .'wp-admin/includes/plugin.php');

				if (is_plugin_active('wp-fastest-cache/wpFastestCache.php')) {
					deactivate_plugins('wp-fastest-cache/wpFastestCache.php');
				}
			}
			add_action( 'init', 'disable_plugins' );

		} else {

			// Enable 'Search Engine Visibility'
			function set_public_status(){
				if (get_option( 'blog_public' ) == 0 ){
					update_option('blog_public', 1);
				}
			}
			add_action( 'init', 'set_public_status' );

			// Remove query strings from static resources
			function remove_cssjs_ver($src) {
				if( strpos($src, '?ver=') )
					$src = remove_query_arg('ver', $src);
				return $src;
			}
			add_filter( 'style_loader_src', 'remove_cssjs_ver', 10, 2 );
			add_filter( 'script_loader_src', 'remove_cssjs_ver', 10, 2 );

		}

	/*-----------------------------------------------------------------------------
		| Performance & Security
	-----------------------------------------------------------------------------*/

		# Remove unnecessary features from WordPress, such as emojis and header extras.
		function remove_bloat() {

			remove_action( 'admin_print_styles', 'print_emoji_styles' );
			remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
			remove_action( 'wp_print_styles', 'print_emoji_styles' );

			remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
			remove_action( 'wp_head', 'wlwmanifest_link' );
			remove_action( 'wp_head', 'wp_resource_hints', 2 );
			remove_action( 'wp_head', 'rsd_link' );
			remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
			remove_action( 'template_redirect', 'wp_shortlink_header', 11, 0 );
			remove_action( 'wp_head', 'feed_links_extra', 3 );
			remove_action( 'wp_head', 'feed_links', 2 );
			remove_action( 'wp_head', 'rel_canonical' );
			remove_action( 'wp_head', 'rsd_link' );
			remove_action( 'wp_head', 'wp_generator' );
			remove_action( 'wp_head', 'index_rel_link' );
			remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
			remove_action( 'wp_head', 'rest_output_link_wp_head' );
	        remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
			remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
			remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );
			remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );
			remove_action('opml_head','the_generator');

			remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
			remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
			remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

		}
		add_action( 'init', 'remove_bloat' );



	/*-----------------------------------------------------------------------------
		| Security Measures
	-----------------------------------------------------------------------------*/

		# Remove access to the custom CSS feature in the customise menu.
		add_action( 'customize_register', 'prefix_remove_css_section', 15 );
		function prefix_remove_css_section( $wp_customize ) {
			$wp_customize->remove_section( 'custom_css' );
		}

		# Remove the default version number from Stylesheets & JavaScript.
		add_filter( 'style_loader_src', 'remove_ver_css_js', 9999 );
		add_filter( 'script_loader_src', 'remove_ver_css_js', 9999 );

		function remove_ver_css_js( $src ) {
			if ( strpos( $src, 'ver=' ) )
				$src = remove_query_arg( 'ver', $src );
			return $src;
		}


