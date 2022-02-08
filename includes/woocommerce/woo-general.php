<?php

//add_action('after_setup_theme', 'setup_woocommerce_support');

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
        return 3; // 3 products per row
    }
}