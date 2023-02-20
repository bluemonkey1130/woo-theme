<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;
?>
<section class="grid-row">
    <div class="grid wide has-one-column grid-gap-400">
        <?php
        /**
         * Hook: woocommerce_before_single_product.
         *
         * @hooked woocommerce_output_all_notices - 10
         */
        do_action('woocommerce_before_single_product');
        ?>
    </div>
</section>
<?php
if (post_password_required()) {
    echo get_the_password_form(); // WPCS: XSS ok.
    return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class('', $product); ?>>

    <?php
    /**
     * Hook: woocommerce_before_single_product_summary.
     *
     * @hooked woocommerce_show_product_sale_flash - 10
     * @hooked woocommerce_show_product_images - 20
     */
    do_action('woocommerce_before_single_product_summary'); ?>
    <section id="product-inner" class="grid-row gap-top-300">
        <div class="grid wide has-two-columns grid-gap-400">
            <?php
            $imageID = get_post_thumbnail_id($product->get_id());
            $imageSrc = wp_get_attachment_image_src($imageID, 'portrait');
            $image_alt = get_post_meta( $imageID, '_wp_attachment_image_alt', true);
            $gallery_ids = $product->get_gallery_image_ids();
            if (count($gallery_ids)) { ?>
                <div id="productGallery" class="product-images">
                    <div class="productSliderNav slider-nav">
                        <?php echo  wp_get_attachment_image($imageID, 'smallPortrait');?>
                        <?php foreach ($gallery_ids as $gallery_id) {
                            echo wp_get_attachment_image($gallery_id, 'smallPortrait');
                        } ?>
                    </div>
                    <div class="slider-wrap">
                        <div class="productSliderMain inner-slider">
                            <img src="<?php echo $imageSrc[0]; ?>" alt="<?php echo $image_alt; ?>"/>
                            <?php foreach ($gallery_ids as $gallery_id) {
                                echo wp_get_attachment_image($gallery_id, 'largePortrait', false);
                            } ?>
                        </div>
                    </div>
                </div>
            <?php } elseif ($imageID) { ?>
                <div id="singleImage" class="single-image">
                    <img src="<?php echo $imageSrc[0]; ?>"/>
                </div>
            <?php } else { ?>
                <div id="singleImage" class="single-image">
                    <?php echo wc_placeholder_img();?>
                </div>
                <?php
            } ?>
            <div class="product-details">
                <?php
                /**
                 * Hook: woocommerce_single_product_summary.
                 *
                 * @hooked woocommerce_template_single_title - 5
                 * @hooked woocommerce_template_single_rating - 10
                 * @hooked woocommerce_template_single_price - 10
                 * @hooked woocommerce_template_single_excerpt - 20
                 * @hooked woocommerce_template_single_add_to_cart - 30
                 * @hooked woocommerce_template_single_meta - 40
                 * @hooked woocommerce_template_single_sharing - 50
                 * @hooked WC_Structured_Data::generate_product_data() - 60
                 */
                do_action('woocommerce_single_product_summary');
                ?>
            </div>
        </div>
    </section>
    <section id="related-products" class="grid-row">
        <div class="grid wide has-one-column gap-top-300">
            <?php
            /**
             * Hook: woocommerce_after_single_product_summary.
             *
             * @hooked woocommerce_output_product_data_tabs - 10
             * @hooked woocommerce_upsell_display - 15
             * @hooked woocommerce_output_related_products - 20
             */
            do_action('woocommerce_after_single_product_summary');
            ?>
        </div>
    </section>
</div>

<section class="grid-row">
    <div class="grid wide has-one-column grid-gap-400">
        <?php do_action('woocommerce_after_single_product'); ?>
    </div>
</section>