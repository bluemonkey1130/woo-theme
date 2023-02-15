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
<!--<table class="shop_table woocommerce-checkout-review-order-table">-->
<!--	<thead>-->
<!--		<tr>-->
<!--			<th class="product-name">--><?php //esc_html_e( 'Product', 'woocommerce' ); ?><!--</th>-->
<!--			<th class="product-total">--><?php //esc_html_e( 'Subtotal', 'woocommerce' ); ?><!--</th>-->
<!--		</tr>-->
<!--	</thead>-->
<!--	<tbody>-->
<!--		--><?php
//		do_action( 'woocommerce_review_order_before_cart_contents' );
//
//		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
//			$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
//
//			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
//				?>
<!--				<tr class="--><?php //echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?><!--" data-cart-item-key="--><?php //echo $cart_item_key; ?><!--">-->
<!--					<td class="product-name" >-->
<!--						--><?php //echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) ) . '&nbsp;'; ?>
<!--						--><?php //echo apply_filters( 'woocommerce_checkout_cart_item_quantity', ' <strong class="product-quantity">' . sprintf( '&times;&nbsp;%s', $cart_item['quantity'] ) . '</strong>', $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
<!--						--><?php //echo wc_get_formatted_cart_item_data( $cart_item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
<!--					</td>-->
<!--					<td class="product-total">-->
<!--						--><?php //echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
<!--					</td>-->
<!--				</tr>-->
<!--				--><?php
//			}
//		}
//
//		do_action( 'woocommerce_review_order_after_cart_contents' );
//		?>
<!--	</tbody>-->
<!--	<tfoot>-->
<!---->
<!--		<tr class="cart-subtotal">-->
<!--			<th>--><?php //esc_html_e( 'Subtotal', 'woocommerce' ); ?><!--</th>-->
<!--			<td>--><?php //wc_cart_totals_subtotal_html(); ?><!--</td>-->
<!--		</tr>-->
<!---->
<!--		--><?php //foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
<!--			<tr class="cart-discount coupon---><?php //echo esc_attr( sanitize_title( $code ) ); ?><!--">-->
<!--				<th>--><?php //wc_cart_totals_coupon_label( $coupon ); ?><!--</th>-->
<!--				<td>--><?php //wc_cart_totals_coupon_html( $coupon ); ?><!--</td>-->
<!--			</tr>-->
<!--		--><?php //endforeach; ?>
<!---->
<!--		--><?php //if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
<!---->
<!--			--><?php //do_action( 'woocommerce_review_order_before_shipping' ); ?>
<!---->
<!--			--><?php //wc_cart_totals_shipping_html(); ?>
<!---->
<!--			--><?php //do_action( 'woocommerce_review_order_after_shipping' ); ?>
<!---->
<!--		--><?php //endif; ?>
<!---->
<!--		--><?php //foreach ( WC()->cart->get_fees() as $fee ) : ?>
<!--			<tr class="fee">-->
<!--				<th>--><?php //echo esc_html( $fee->name ); ?><!--</th>-->
<!--				<td>--><?php //wc_cart_totals_fee_html( $fee ); ?><!--</td>-->
<!--			</tr>-->
<!--		--><?php //endforeach; ?>
<!---->
<!--		--><?php //if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) : ?>
<!--			--><?php //if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
<!--				--><?php //foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited ?>
<!--					<tr class="tax-rate tax-rate---><?php //echo esc_attr( sanitize_title( $code ) ); ?><!--">-->
<!--						<th>--><?php //echo esc_html( $tax->label ); ?><!--</th>-->
<!--						<td>--><?php //echo wp_kses_post( $tax->formatted_amount ); ?><!--</td>-->
<!--					</tr>-->
<!--				--><?php //endforeach; ?>
<!--			--><?php //else : ?>
<!--				<tr class="tax-total">-->
<!--					<th>--><?php //echo esc_html( WC()->countries->tax_or_vat() ); ?><!--</th>-->
<!--					<td>--><?php //wc_cart_totals_taxes_total_html(); ?><!--</td>-->
<!--				</tr>-->
<!--			--><?php //endif; ?>
<!--		--><?php //endif; ?>
<!---->
<!--		--><?php //do_action( 'woocommerce_review_order_before_order_total' ); ?>
<!---->
<!--		<tr class="order-total">-->
<!--			<th>--><?php //esc_html_e( 'Total', 'woocommerce' ); ?><!--</th>-->
<!--			<td>--><?php //wc_cart_totals_order_total_html(); ?><!--</td>-->
<!--		</tr>-->
<!---->
<!--		--><?php //do_action( 'woocommerce_review_order_after_order_total' ); ?>
<!---->
<!--	</tfoot>-->
<!--</table>-->
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
                        <h5><?php echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key)) . '&nbsp;'; ?></h5>

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

    <div id="cart-sub-totals" class="grid xxx-wide has-two-columns cart-subtotal">
        <div><?php esc_html_e('Subtotal', 'woocommerce'); ?></div>
        <div><?php wc_cart_totals_subtotal_html(); ?></div>
    </div>
    <div id="cart-coupons" class="grid xxx-wide has-two-columns cart-subtotal">

        <?php foreach (WC()->cart->get_coupons() as $code => $coupon) : ?>
            <div class="cart-discount coupon-<?php echo esc_attr(sanitize_title($code)); ?>">
                <div><?php wc_cart_totals_coupon_label($coupon); ?></div>
                <div><?php wc_cart_totals_coupon_html($coupon); ?></div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="grid xxx-wide has-two-columns">
        <?php if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()) : ?>

            <?php do_action('woocommerce_review_order_before_shipping'); ?>

            <?php wc_cart_totals_shipping_html(); ?>

            <?php do_action('woocommerce_review_order_after_shipping'); ?>

        <?php endif; ?>
    </div>
    <div class="grid xxx-wide has-two-columns">
        <?php foreach (WC()->cart->get_fees() as $fee) : ?>
            <div class="fee">
                <div><?php echo esc_html($fee->name); ?></div>
                <div><?php wc_cart_totals_fee_html($fee); ?></div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="grid xxx-wide has-two-columns">
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
    </div>
    <?php do_action('woocommerce_review_order_before_order_total'); ?>
    <div class="grid xxx-wide has-two-columns">
        <div class="order-total">
            <div><?php esc_html_e('Total', 'woocommerce'); ?></div>
            <div><?php wc_cart_totals_order_total_html(); ?></div>
        </div>

        <?php do_action('woocommerce_review_order_after_order_total'); ?>

    </div>
</div>