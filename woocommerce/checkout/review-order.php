<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

defined('ABSPATH') || exit;
?>
<div class="shop_table woocommerce-checkout-review-order-table grid-row">
    <div id="cart-titles" class="grid xxx-wide has-two-columns">
        <div class="product-name">
            <h4><?php esc_html_e('Product', 'woocommerce'); ?></h4>
        </div>
        <div class="product-total">
            <h4><?php esc_html_e('Subtotal', 'woocommerce'); ?></h4>
        </div>
    </div>
    <div id="cart-items" class="grid xxx-wide has-one-column">

        <?php
        do_action('woocommerce_review_order_before_cart_contents');

        foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
            $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);

            if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key)) {
                ?>
                <div class="<?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>"
                     data-cart-item-key="<?php echo $cart_item_key; ?>">
                    <div class="product-name">
                        <h5><strong><?php echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key)) . '&nbsp;'; ?></strong></h5>
                        <?php echo apply_filters('woocommerce_checkout_cart_item_quantity', ' <strong class="product-quantity">' . sprintf('&times;&nbsp;%s', $cart_item['quantity']) . '</strong>', $cart_item, $cart_item_key); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

                        <div class="details"><?php echo wc_get_formatted_cart_item_data($cart_item); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
                    </div>
                    <div class="product-total">
                        <h5><?php echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></h5>
                    </div>
                </div>
                <?php
            }
        }

        do_action('woocommerce_review_order_after_cart_contents');
        ?>
    </div>

    <div id="cart-sub-totals" class="cart-subtotal">
        <div class="inner sub-total-inner">
            <h5><?php esc_html_e('Subtotal', 'woocommerce'); ?></h5>
            <h5><?php wc_cart_totals_subtotal_html(); ?></h5>
        </div>
        <div class="inner coupon">
            <?php foreach (WC()->cart->get_coupons() as $code => $coupon) : ?>
                <div class="cart-discount coupon-<?php echo esc_attr(sanitize_title($code)); ?>">
                    <div><?php wc_cart_totals_coupon_label($coupon); ?></div>
                    <div><?php wc_cart_totals_coupon_html($coupon); ?></div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="inner shipping-wrapper">
            <?php if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()) : ?>

                <?php do_action('woocommerce_review_order_before_shipping'); ?>

                <?php wc_cart_totals_shipping_html(); ?>

                <?php do_action('woocommerce_review_order_after_shipping'); ?>

            <?php endif; ?>
        </div>
        <div class="fees-wrapper">
            <?php foreach (WC()->cart->get_fees() as $fee) : ?>
                <div class="fee">
                    <h5><?php echo esc_html($fee->name); ?></h5>
                    <h5><?php wc_cart_totals_fee_html($fee); ?></h5>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="inner tax">
            <?php if (wc_tax_enabled() && !WC()->cart->display_prices_including_tax()) : ?>
                <?php if ('itemized' === get_option('woocommerce_tax_total_display')) : ?>
                    <?php foreach (WC()->cart->get_tax_totals() as $code => $tax) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited ?>
                        <div class="tax-rate tax-rate-<?php echo esc_attr(sanitize_title($code)); ?>">
                            <div><?php echo esc_html($tax->label); ?></div>
                            <div><?php echo wp_kses_post($tax->formatted_amount); ?></div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="tax-total">
                        <div><?php echo esc_html(WC()->countries->tax_or_vat()); ?></div>
                        <div><?php wc_cart_totals_taxes_total_html(); ?></div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
            <?php do_action('woocommerce_review_order_before_order_total'); ?>
        </div>
        <div class="inner order-total">
            <h4><strong><?php esc_html_e('Total', 'woocommerce'); ?></strong></h4>
            <h4><strong><?php wc_cart_totals_order_total_html(); ?></strong></h4>
        </div>
        <?php do_action('woocommerce_review_order_after_order_total'); ?>

    </div>
</div>