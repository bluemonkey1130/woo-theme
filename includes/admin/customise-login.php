<?php
	# Load the custom stylesheet for altering the login page.
	function my_custom_login() { echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/assets/styles/css/lib/custom-login.css" />'; }
	add_action('login_head', 'my_custom_login');

	# Prevent the default details leak in the error message. Replace with a default.
	function disable_login_message() { return 'Sorry, your username or password is incorrect. Please try again.'; }
	add_filter('login_errors', 'disable_login_message');

	# Remove the URL link to WordPress.org & Change the title
	function my_login_logo_url() { return get_bloginfo( 'url' );}
	add_filter( 'login_headerurl', 'my_login_logo_url' );

	function my_login_logo_url_title() { return 'Gough Bailey Wright'; }
	add_filter( 'login_headertitle', 'my_login_logo_url_title' );

	# Disable the login shake for incorrect details.
	function my_login_head() { remove_action('login_head', 'wp_shake_js', 12); }
	add_action('login_head', 'my_login_head');

?>