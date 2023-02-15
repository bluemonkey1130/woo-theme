<?php
add_filter('woocommerce_checkout_fields', 'custom_override_checkout_fields');

// Our hooked in function – $fields is passed via the filter!
function custom_override_checkout_fields($fields)
{
    $fields['shipping']['shipping_phone'] = array(
        'label' => __('Recipient contact number', 'woocommerce'),
        'placeholder' => _x('Phone', 'placeholder', 'woocommerce'),
        'required' => true,
        'class' => array('form-row-wide'),
        'clear' => true
    );

    return $fields;
}

//add_action( 'woocommerce_admin_order_data_after_shipping_address', 'my_custom_checkout_field_display_admin_order_meta', 10, 1 );
//
//function my_custom_checkout_field_display_admin_order_meta($order){
//    echo '<p><strong>'.__('Recipient contact number').':</strong> ' . get_post_meta( $order->get_id(), '_shipping_phone', true ) . '</p>';
//}


//Change the 'Billing details' checkout label to 'Contact Information'
function wc_billing_field_strings( $translated_text, $text, $domain ) {
    switch ( $translated_text ) {
        case 'Billing details' :
            $translated_text = __( 'Customer billing information', 'woocommerce' );
            break;
    }
    return $translated_text;
}
add_filter( 'gettext', 'wc_billing_field_strings', 20, 3 );

function checkout_form_shipping() {
    echo '<h2>Recipient information</h2>';
}
add_action( 'woocommerce_before_checkout_shipping_form', 'checkout_form_shipping'  );