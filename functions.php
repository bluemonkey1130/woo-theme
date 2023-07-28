<?php
////add_filter('woocommerce_enqueue_styles', '__return_false');
////
////
/////*--------------------------------------------------
////    | Theme & WordPress core functions files
////--------------------------------------------------*/
require get_template_directory() . '/includes/core/wp-admin.php';
require get_template_directory() . '/includes/core/enqueue.php';
require get_template_directory() . '/includes/core/theme-setup.php';
require get_template_directory() . '/includes/core/theme-support.php';
require get_template_directory() . '/includes/core/excerpt.php';
require get_template_directory() . '/includes/core/nav-walker.php';
//////require get_template_directory() . '/includes/core/google-analytics.php';
/////
require get_template_directory() . '/includes/custom/custom.php';
require get_template_directory() . '/includes/custom/admin-styling.php';
require get_template_directory() . '/includes/custom/default-pages.php';
require get_template_directory() . '/includes/custom/parse-video.php';
require get_template_directory() . '/includes/custom/table-of-contents.php';
require get_template_directory() . '/includes/custom/user-roles.php';

require get_template_directory() . '/includes/woocommerce/woo-general.php';
require get_template_directory() . '/includes/woocommerce/woo-remove.php';
require get_template_directory() . '/includes/woocommerce/woo-shipping.php';
require get_template_directory() . '/includes/woocommerce/woo-styles.php';
require get_template_directory() . '/includes/woocommerce/woo-product-add-ons.php';
require get_template_directory() . '/includes/woocommerce/woo-single-product.php';
require get_template_directory() . '/includes/woocommerce/woo-checkout.php';
require get_template_directory() . '/includes/woocommerce/change-loop.php';


function iconic_button_class( $class ) {
    $class .= ' primary';
    return $class;
}

add_filter( 'jck_wssv_add_to_cart_button_class', 'iconic_button_class', 10 );


