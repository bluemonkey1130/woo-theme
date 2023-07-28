<?php
function exclude_wholesale_products_from_shop($query) {
    if (is_admin() || !is_post_type_archive('product') || !is_main_query()) {
        return; // Do not modify the query on the admin side or for other queries.
    }

    $meta_query = array(
        'relation' => 'OR', // Use OR relation to include products without a value for the "wholesale_product" field
        array(
            'key' => 'wholesale_product', // Replace with the correct ACF field name
            'value' => '0', // 1 is the value for the 'true' checkbox state
            'compare' => '=', // Include products where the "wholesale_product" field is set to true
            'type' => 'BOOLEAN', // Set the type to BOOLEAN to correctly handle true/false values
        ),
        array(
            'key' => 'wholesale_product', // Replace with the correct ACF field name
            'compare' => 'NOT EXISTS', // Include products that don't have a value set for the "wholesale_product" field
        ),
    );

    $query->set('meta_query', $meta_query);
}

add_action('pre_get_posts', 'exclude_wholesale_products_from_shop');
