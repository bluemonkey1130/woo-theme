<?php

/**
 * @snippet       Open Ship to Different Address @ Checkout Page
 * @how-to        Get CustomizeWoo.com FREE
 * @author        Rodolfo Melogli
 * @testedwith    WooCommerce 3.9
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */
add_filter( 'woocommerce_ship_to_different_address_checked', '__return_true' );
