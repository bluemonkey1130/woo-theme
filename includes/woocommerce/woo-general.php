<?php

add_action('after_setup_theme', 'setup_woocommerce_support');

function setup_woocommerce_support()
{
    add_theme_support('woocommerce');
}

/**
Shorten the excerpt
 */
add_action( 'woocommerce_after_shop_loop_item_title', 'shorten_product_excerpt', 35 );
function shorten_product_excerpt()
{
    global $post;
    $limit = 30;
    $text = $post->post_excerpt;
    if (str_word_count($text, 0) > $limit) {
        $arr = str_word_count($text, 2);
        $pos = array_keys($arr);
        $text = substr($text, 0, $pos[$limit]) . '...';
        // $text = force_balance_tags($text); // may be you dont need this…
    }
    echo '<span class="excerpt"><p>' . $text . '</p></span>';
}

/**
 * Change number or products per row to 3
 */
add_filter('loop_shop_columns', 'loop_columns', 999);
if (!function_exists('loop_columns')) {
    function loop_columns() {
        return 4; // 3 products per row
    }
}
remove_action( 'woocommerce_shop_loop_item_title','woocommerce_template_loop_product_title', 10 );
add_action('woocommerce_shop_loop_item_title', 'abChangeProductsTitle', 10 );
function abChangeProductsTitle() {
    echo '<h4 class="woocommerce-loop-product__title">' . get_the_title() . '</h4>';
}

//add_action('woocommerce_single_product_summary', 'singleProducttitle', 10 );
//function singleProducttitle() {
//    echo '<h2 class="">' . get_the_title() . '</h2>';
//}

/**
 * Change number of products that are displayed per page (shop page)
 */
add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 12 );

function new_loop_shop_per_page( $cols ) {
    // $cols contains the current number of products per page based on the value stored on Options –> Reading
    // Return the number of products you wanna show per page.
    $cols = 9;
    return $cols;
}
