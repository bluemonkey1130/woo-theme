<?php

/*--------------------------------------------------
    | Theme Supports
--------------------------------------------------*/
add_theme_support( 'block-templates' );

function rock_toffee_theme_support()
{
    // Check function exists.
    if( function_exists('acf_add_options_sub_page') ) {

        // Add parent.
        $parent = acf_add_options_page(array(
            'page_title'  => __('Theme General Settings'),
            'menu_title'  => __('Theme Settings'),
            'redirect'    => false,
        ));

        // Add sub page.
        acf_add_options_sub_page(array(
            'page_title'  => __('Colour Settings'),
            'menu_title'  => __('Colour'),
            'parent_slug' => $parent['menu_slug'],
        ));

        // Add sub page.
        acf_add_options_sub_page(array(
            'page_title'  => __('Header Settings'),
            'menu_title'  => __('Header'),
            'parent_slug' => $parent['menu_slug'],
        ));

        // Add sub page.
        acf_add_options_sub_page(array(
            'page_title'  => __('Footer Settings'),
            'menu_title'  => __('Footer'),
            'parent_slug' => $parent['menu_slug'],
        ));

        // Add sub page.
        acf_add_options_sub_page(array(
            'page_title'  => __('Font Settings'),
            'menu_title'  => __('Fonts'),
            'parent_slug' => $parent['menu_slug'],
        ));
        // Add sub page.
        acf_add_options_sub_page(array(
            'page_title'  => __('Global Product Info'),
            'menu_title'  => __('Global Product Info'),
            'parent_slug' => $parent['menu_slug'],
        ));
        // Add sub page.
        acf_add_options_sub_page(array(
            'page_title'  => __('Search Page'),
            'menu_title'  => __('Search Page'),
            'parent_slug' => $parent['menu_slug'],
        ));
    }


    # Add extra theme options such as post featured images & menu pages.
    add_theme_support('post-thumbnails');
    add_theme_support('menus');
    add_theme_support('title-tag');

    //Editor syles added to admin
    add_theme_support('editor-styles');

    //Stylesheet to use
    add_editor_style('assets/dist/app.css');

    //Use custom logo in customiser
    add_theme_support('custom-logo');

    //Activate wide align in guttenberg
    add_theme_support('align-wide');
    add_post_type_support('page', 'excerpt');

    # Register Menus
    register_nav_menus([
        'main-menu' => __('Main Menu'),
        'secondary-menu' => __('Secondary Menu'),
        'footer-menu-one' => __('Footer One Menu'),
    ]);

    # HTML5 on WP elements
    add_theme_support('html5', ['search-form', 'caption']);
    add_image_size('square200', 200, 200, true);
    add_image_size('square500', 500, 500, true);
    add_image_size('square1000', 1000, 1000, true);

    add_image_size('fourThree', 600, 400, true);

    add_image_size('smallPortrait', 100, 130, true);
    add_image_size('portrait', 450, 600, true);
    add_image_size('largePortrait', 900, 1200, true);

    add_image_size('letterBox', 1920, 800, true);
    add_image_size('smallLetterbox', 1920, 600, true);

    add_image_size('extraLarge', 1920, 1080, true);
    add_image_size('large', 1536, 864, true);
    add_image_size('mediumLarge', 768, 432, true);
    add_image_size('medium', 567, 324, true);
    add_image_size('small', 384, 216, true);


}

add_action('after_setup_theme', 'rock_toffee_theme_support');
function remove_extra_image_sizes() {
//    remove_image_size( 'medium' );
    remove_image_size( 'medium_large' );
//    remove_image_size( 'large' );
//    remove_image_size( 'woocommerce_thumbnail' );
//    remove_image_size( 'woocommerce_single' );
//    remove_image_size( 'woocommerce_gallery_thumbnail' );
//    remove_image_size( 'shop_catalog' );
    remove_image_size( 'shop_single' );
//    remove_image_size( 'shop_thumbnail' );
    remove_image_size( '1536x1536' );
    remove_image_size( '2048x2048' );
}

add_action('init', 'remove_extra_image_sizes');

# Speed Up ACF in /wp-admin - https://www.advancedcustomfields.com/resources/acf-settings/
add_filter('acf/settings/remove_wp_meta_box', '__return_true');

function the_excerpt_max_charlength($charlength)
{
    $excerpt = get_the_excerpt();
    $charlength++;

    if (mb_strlen($excerpt) > $charlength) {
        $subex = mb_substr($excerpt, 0, $charlength - 5);
        $exwords = explode(' ', $subex);
        $excut = -(mb_strlen($exwords[count($exwords) - 1]));
        if ($excut < 0) {
            echo mb_substr($subex, 0, $excut);
        } else {
            echo $subex;
        }
        echo '[...]';
    } else {
        echo $excerpt;
    }
}

add_action('after_setup_theme', 'the_excerpt_max_charlength');



//# Automatic Emptying of Trash after 5 Days
//define('EMPTY_TRASH_DAYS', 5);


# Allow SVG to be uploaded to the media uploader
function cc_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}

add_filter('upload_mimes', 'cc_mime_types');


# Remove WordPress Welcome Message
remove_action('welcome_panel', 'wp_welcome_panel');


# Remove the Default dashboard Widgets
function disable_default_dashboard_widgets()
{
    global $wp_meta_boxes;
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
}

add_action('wp_dashboard_setup', 'disable_default_dashboard_widgets', 999);


if (function_exists('register_sidebar')) {
    register_sidebar(array(
        'name' => 'Sidebar Widgets',
        'id' => 'sidebar-widgets',
        'description' => 'These are widgets for the sidebar.',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h2>',
        'after_title' => '</h2>'
    ));
    register_sidebar(array(
        'name' => 'Shop Widget',
        'id' => 'shop-widget',
        'description' => 'These are widgets for the sidebar.',
        'before_widget' => '<aside id="%1$s" class="widget shop %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h2>',
        'after_title' => '</h2>'
    ));
    register_sidebar(array(
        'name' => 'Mobile Shop Widget',
        'id' => 'mobile-shop-widget',
        'description' => 'These are widgets for the sidebar.',
        'before_widget' => '<aside id="%1$s" class="widget shop mobile %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h2>',
        'after_title' => '</h2>'
    ));
}

# Add dashboard widget
function theme_dashboard_widget_content()
{
    echo "<p>Welcome to your custom built website by Theme.";
}

function theme_dashboard_widget()
{
    global $wp_meta_boxes;

    wp_add_dashboard_widget('custom_help_widget', 'Do you need help?', 'rock_toffee_dashboard_widget_content');
}

add_action('wp_dashboard_setup', 'theme_dashboard_widget');


# Hide Login Errors to give less information to potential hackers
function no_wordpress_errors()
{
    return 'Something is wrong!';
}

add_filter('login_errors', 'no_wordpress_errors');


# Disabling built-in WordPress image optomiser as we use a plugin
function smashing_jpeg_quality()
{
    return 100;
}

add_filter('jpeg_quality', 'smashing_jpeg_quality');


/*-------------------------------------
  | Google API Key
-------------------------------------*/
// function my_acf_init() {

//     acf_update_setting('google_api_key', 'xxx');
// }

// add_action('acf/init', 'my_acf_init');


