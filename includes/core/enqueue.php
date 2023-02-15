<?php
/*--------------------------------------------------
    | Enqueue Stylesheet and JavaScript
--------------------------------------------------*/

function theme_enqueue()
{
    $time = time();
    wp_register_script(
        'bundle',
        get_template_directory_uri() . '/assets/scripts.min.js',
        array( 'jquery' ),
        $time,
        false);

    # Deregister the defaults and implement our stylesheets.
     wp_deregister_script( 'wp-embed' );

    # CSS
    wp_enqueue_style('main', get_template_directory_uri() . '/assets/index.css', '', $time, false);

    # JS
    wp_enqueue_script('bundle');

}

add_action('wp_enqueue_scripts', 'theme_enqueue');

//function enqueue_style_after_wc(){
//    wp_enqueue_style( 'woo-style', get_template_directory_uri() . '/assets/woo.css', array(), '2.0' );
//}
//add_action( 'wp_enqueue_scripts', 'enqueue_style_after_wc', 20 );

//function admin_custom_script()
//{
//
//    wp_enqueue_script('bundle');
//}

//add_action('admin_enqueue_scripts', 'admin_custom_script');


