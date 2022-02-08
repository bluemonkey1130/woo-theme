<?php
    /*--------------------------------------------------
        | Custom Login Page
    --------------------------------------------------*/

        # Enqueue custom stylesheet
        function theme_login_enqueue() {
            wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/assets/dist/app.min.css' );
        }
        add_action( 'login_enqueue_scripts', 'theme_login_enqueue' );

        # Login Logo URL destination
        function my_login_logo_url() {
            return home_url();
        }
        add_filter( 'login_headerurl', 'my_login_logo_url' );

        # Change the hover text on the logo
        function my_login_logo_url_title() {
            return get_bloginfo('name');
        }
        add_filter( 'login_headertitle', 'my_login_logo_url_title' );



    /*--------------------------------------------------
        | Changes to Admin Area
    --------------------------------------------------*/

        # theme Branding to WP Admin footer
        function rename_admin_footer() {
            echo get_bloginfo('name') . ' dashboard | Built by <a href="https://sixthstory.co.uk" target="_blank">Sixth Story</a></p>';
        }
        add_filter( 'admin_footer_text', 'rename_admin_footer' );


        # Remove 'Wordpress News and Events' widget
        function disable_wordpress_news_widget() {
            remove_meta_box('dashboard_primary', 'dashboard', 'core');
        }
        add_action('admin_menu', 'disable_wordpress_news_widget');


        # Remove 'Appearance - Editor' from admin menu
        function remove_editor_menu() {
            remove_action('admin_menu', '_add_themes_utility_last', 101);
        }
        add_action('_admin_menu', 'remove_editor_menu', 1);


        # Limit stored post revisions to 3
        if (!defined('WP_POST_REVISIONS')) define('WP_POST_REVISIONS', 3);
        if (!defined('WP_POST_REVISIONS')) define('WP_POST_REVISIONS', false);



    /*--------------------------------------------------
        | Removing Comment Functionality
    --------------------------------------------------*/

        # Disable and remove commenting functionality
        function my_remove_admin_menus() {
            remove_menu_page( 'edit-comments.php' );
        }
        add_action( 'admin_menu', 'my_remove_admin_menus' );

        function remove_comment_support() {
            remove_post_type_support( 'post', 'comments' );
            remove_post_type_support( 'page', 'comments' );
            add_action('init', 'remove_comment_support', 100);
            update_option( 'default_comment_status', 'closed' );
        }

        function mytheme_admin_bar_render() {
            global $wp_admin_bar;
            $wp_admin_bar->remove_menu('comments');
        }
        add_action( 'wp_before_admin_bar_render', 'mytheme_admin_bar_render' );
