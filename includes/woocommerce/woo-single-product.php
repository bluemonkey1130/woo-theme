<?php
function wc_insert_additional_information() {
    $disclaimerText = get_field('disclaimer_text', 'option');
    echo '<p>'.$disclaimerText.'</p>';

}
add_action( 'woocommerce_product_additional_information', 'wc_insert_additional_information' );