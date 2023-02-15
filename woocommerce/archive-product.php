<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined('ABSPATH') || exit;

get_header('shop');
?>
    <main class="woocommerce">
        <?php
        get_template_part('template-parts/content', 'hero');
        get_template_part( 'template-parts/content-page-flex' );

        ?>
        <section id="breadcrumbs" class="grid-row">
            <div class="grid wide grid-gap-400 gap-top-400">
                <?php
                /**
                 * Hook: woocommerce_before_main_content.
                 *
                 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
                 * @hooked woocommerce_breadcrumb - 20
                 * @hooked WC_Structured_Data::generate_website_data() - 30
                 */
                do_action('woocommerce_before_main_content');
                ?>
            </div>
        </section>
        <?php
        if (woocommerce_product_loop()) {
            ?>
            <section class="grid-row shop">
                <div id="filters">
                    <?php
                    /**
                     * Hook: woocommerce_before_shop_loop.
                     *
                     * @hooked woocommerce_output_all_notices - 10
                     * @hooked woocommerce_result_count - 20
                     * @hooked woocommerce_catalog_ordering - 30
                     */
                    do_action('woocommerce_before_shop_loop');
                    ?>
                </div>
                <div id="products-filters">
                    <div id="mobileFilterOpen">
                        <h4>Filters <span></span></h4>
                    </div>
                    <div id="widgetInner">
                        <?php
                        if (is_active_sidebar('shop-widget')) :
                            dynamic_sidebar('shop-widget');
                        endif; ?>
                    </div>

                </div>
                <div id="products-list">
                    <?php
                    woocommerce_product_loop_start();

                    if (wc_get_loop_prop('total')) {
                        while (have_posts()) {
                            the_post();

                            /**
                             * Hook: woocommerce_shop_loop.
                             */
                            do_action('woocommerce_shop_loop');

                            wc_get_template_part('content', 'product');
                        }
                    }

                    woocommerce_product_loop_end();
                    ?>
                </div>
            </section>
            <?php
            ?>
            <section id="pagination" class="grid-row">
                <div class="grid wide grid-gap-400 gap-top-400">
                    <?php

                    /**
                     * Hook: woocommerce_after_shop_loop.
                     *
                     * @hooked woocommerce_pagination - 10
                     */
                    do_action('woocommerce_after_shop_loop');
                    ?>
                </div>
            </section>
            <?php
        } else {
            /**
             * Hook: woocommerce_no_products_found.
             *
             * @hooked wc_no_products_found - 10
             */
            do_action('woocommerce_no_products_found');
        }
        ?>
        <section class="grid-row">
            <div class="grid wide grid-gap-400 gap-top-400">
                <?php
                /**
                 * Hook: woocommerce_after_main_content.
                 *
                 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
                 */
                do_action('woocommerce_after_main_content');
                ?>
            </div>
        </section>
        <?php
        ?>
    </main>
<?php

get_footer('shop');
