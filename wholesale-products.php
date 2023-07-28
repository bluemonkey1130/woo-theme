<?php
/**
 * Template Name: Wholesale Products Page
 */

// Include the necessary WooCommerce functions and template files
defined('ABSPATH') || exit;
get_header('shop');
?>

<main class="woocommerce">
    <?php
    // Copy the content from the existing archive-product.php template
    get_template_part('template-parts/content', 'hero');
    get_template_part('template-parts/content-page-flex');
    ?>

    <!-- Add the rest of the content from the existing archive-product.php template -->
    <section id="breadcrumbs" class="grid-row">
        <div class="grid wide grid-gap-400 gap-top-400">
            <?php do_action('woocommerce_before_main_content'); ?>
        </div>
    </section>
    <?php
    if (woocommerce_product_loop()) {
        ?>
        <section class="grid-row shop">
            <div id="filters">
                <?php do_action('woocommerce_before_shop_loop'); ?>
            </div>
            <div id="products-filters">
                <div id="mobileFilterOpen">
                    <h4>Filters <span></span></h4>
                </div>
                <div id="widgetInner">
                    <?php
                    if (is_active_sidebar('shop-widget')) :
                        dynamic_sidebar('shop-widget');
                    endif;
                    ?>
                </div>
            </div>
            <div id="products-list">
                <?php
                //                woocommerce_product_loop_start();
                //
                //                if (wc_get_loop_prop('total')) {
                //                    while (have_posts()) {
                //                        the_post();
                //
                //                        /**
                //                         * Hook: woocommerce_shop_loop.
                //                         */
                //                        do_action('woocommerce_shop_loop');
                //
                //                        wc_get_template_part('content', 'product');
                //                    }
                //                }
                //
                //                woocommerce_product_loop_end();
                if (is_user_logged_in() && (current_user_can('wholesale_user') || current_user_can('florist_wholesaler') || current_user_can('administrator'))) : ?>

                    <?php
                    // Custom query to retrieve wholesale products
                    $args = array(
                        'post_type' => 'product', // Replace 'product' with your WooCommerce product post type
                        'posts_per_page' => -1, // Show all wholesale products
                        'meta_query' => array(
                            array(
                                'key' => 'wholesale_product', // Replace with the correct ACF field name
                                'value' => '1', // 1 is the value for the 'true' checkbox state
                                'compare' => '=', // Include products where the "wholesale_product" field is set to true
                                'type' => 'BOOLEAN', // Set the type to BOOLEAN to correctly handle true/false values
                            ),
                        ),
                    );

                    $wholesale_products_query = new WP_Query($args);

                    if ($wholesale_products_query->have_posts()) :
                        while ($wholesale_products_query->have_posts()) :
                            $wholesale_products_query->the_post();
                            the_title('<h2>', '</h2>');
                            the_content();
                        endwhile;
                        wp_reset_postdata();
                    else :
                        echo '<p>No wholesale products found.</p>';
                    endif;
                    ?>

                <?php else : ?>
                    <!-- Display Registration Form -->
                    <h1>Create a Wholesale Account</h1>
                    <?php wp_login_form(array('redirect' => get_permalink())); ?>
                    <p>If you don't have an account, you can register for a Wholesale Account.</p>
                    <a href="<?php echo esc_url(wp_registration_url()); ?>">Register</a>
                <?php endif; ?>
            </div>
        </section>
        <section id="pagination" class="grid-row">
            <div class="grid wide grid-gap-400 gap-top-400">
                <?php do_action('woocommerce_after_shop_loop'); ?>
            </div>
        </section>
        <?php
    } else {
        do_action('woocommerce_no_products_found');
    }
    ?>
    <section class="grid-row">
        <div class="grid wide grid-gap-400 gap-top-400">
            <?php do_action('woocommerce_after_main_content'); ?>
        </div>
    </section>
</main>

<?php
get_footer('shop');
?>
