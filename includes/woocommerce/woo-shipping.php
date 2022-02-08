<?php
add_filter( 'woocommerce_shipping_package_name', 'custom_shipping_package_name' );
function custom_shipping_package_name( $name ) {
    return 'Delivery';
}

function fix_woocommerce_strings( $translated, $text) {
// STRING 1
    $translated = str_ireplace( 'Shipping', 'Delivery charge', $translated );

    return $translated;
}
add_filter( 'gettext', 'fix_woocommerce_strings', 999, 3 );



// Part 1
// Display Radio Buttons

add_action( 'woocommerce_review_order_after_shipping', 'bbloomer_checkout_radio_choice' );

function bbloomer_checkout_radio_choice() {

    $chosen = WC()->session->get( 'radio_chosen' );
    $chosen = empty( $chosen ) ? WC()->checkout->get_value( 'radio_choice' ) : $chosen;
    $chosen = empty( $chosen ) ? '0' : $chosen;
    // Loop through shipping packages from WC_Session (They can be multiple in some cases)
    foreach ( WC()->cart->get_shipping_packages() as $package_id => $package ) {
        // Check if a shipping for the current package exist
        if ( WC()->session->__isset( 'shipping_for_package_'.$package_id ) ) {
            // Loop through shipping rates for the current package
            foreach ( WC()->session->get( 'shipping_for_package_'.$package_id )['rates'] as $shipping_rate_id => $shipping_rate ) {
                $method_id   = $shipping_rate->get_method_id(); // The shipping method slug
                $cost        = $shipping_rate->get_cost(); // The cost without tax
                if($method_id == 'wcsdm'){
                    $flatCost= $cost;
                }
            }
        }
    }

    $args = array(
        'type' => 'radio',
        'class' => array( 'form-row-wide', 'update_totals_on_change' ),
        'options' => array(
            '0' => 'You Return: 9am following day (free)',
            '10' => 'We Collect: 9am following day ($'. $flatCost.')',
        ),
        'default' => $chosen
    );

    echo '<tr id="checkout-radio">';
    echo '<th>Returning the games</th>';
    echo '<td>';
    woocommerce_form_field( 'radio_choice', $args, $chosen );
    echo '</td>';
    echo '</tr>';

}

// Part 2
// Add Fee and Calculate Total

add_action( 'woocommerce_cart_calculate_fees', 'bbloomer_checkout_radio_choice_fee', 20, 1 );

function bbloomer_checkout_radio_choice_fee( $cart ) {

    if ( is_admin() && ! defined( 'DOING_AJAX' ) ) return;

    // Loop through shipping packages from WC_Session (They can be multiple in some cases)
    foreach ( WC()->cart->get_shipping_packages() as $package_id => $package ) {
        // Check if a shipping for the current package exist
        if ( WC()->session->__isset( 'shipping_for_package_'.$package_id ) ) {
            // Loop through shipping rates for the current package
            foreach ( WC()->session->get( 'shipping_for_package_'.$package_id )['rates'] as $shipping_rate_id => $shipping_rate ) {
                $method_id   = $shipping_rate->get_method_id(); // The shipping method slug
                $cost        = $shipping_rate->get_cost(); // The cost without tax
                if($method_id == 'wcsdm'){
                    $flatCost= $cost;
                }
            }
        }
    }

    $radio = WC()->session->get( 'radio_chosen' );

    if ( $radio ) {
        $cart->add_fee( 'Collection Fee', $flatCost );
    }
}

// Part 3
// Add Radio Choice to Session

add_action( 'woocommerce_checkout_update_order_review', 'bbloomer_checkout_radio_choice_set_session' );

function bbloomer_checkout_radio_choice_set_session( $posted_data ) {
    parse_str( $posted_data, $output );
    if ( isset( $output['radio_choice'] ) ){
        WC()->session->set( 'radio_chosen', $output['radio_choice'] );
    }
}
