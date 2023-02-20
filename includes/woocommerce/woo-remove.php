<?php
//remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
//remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
//remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );

remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);

/**
 * Disable WooCommerce block styles (front-end).
 */
function oolongtoolong_disable_woocommerce_block_styles()
{
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('wc-blocks-style'); // Remove WooCommerce block CSS
}

add_action('wp_enqueue_scripts', 'oolongtoolong_disable_woocommerce_block_styles');


function disable_classic_theme_styles()
{
    wp_deregister_style('classic-theme-styles');
    wp_dequeue_style('classic-theme-styles');
}

add_filter('wp_enqueue_scripts', 'disable_classic_theme_styles', 100);

add_filter('woocommerce_checkout_fields', 'remove_additional_fields_checkout');
function remove_additional_fields_checkout($fields)
{
    unset($fields['additional']);
    return $fields;
}

// remove Order Notes from checkout field in Woocommerce
add_filter( 'woocommerce_checkout_fields' , 'alter_woocommerce_checkout_fields' );
function alter_woocommerce_checkout_fields( $fields ) {
    unset($fields['order']['order_comments']);
    return $fields;
}