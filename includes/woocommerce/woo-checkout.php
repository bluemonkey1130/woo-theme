<?php
function lab_add_passport_field($checkout)
{
    $current_user = wp_get_current_user();
    $saved_passport_number = $current_user->lab_passport_no;
    woocommerce_form_field(
        'lab_passport_no',
        array(
            'type' => 'text',
            'class' => array('form-row-wide'),
            'label' => 'Passport Number',
            'placeholder' => 'B02894567',
            'required' => true,
            'default' => $saved_passport_number
        ),
        $checkout->get_value('lab_passport_no')

    );
}

add_action('woocommerce_checkout_process', 'lab_validate_passport_field');

function lab_validate_passport_field()
{
    if (!$_POST['lab_passport_no']) {
        wc_add_notice('Billing Passport Number is a required field. ', 'error');
    }
}

add_action('woocommerce_checkout_update_order_meta', 'lab_save_passport_field');
function lab_save_passport_field($order_id)
{
}

if ($_POST['lab_passport_no']) {
    update_post_meta($order_id, '_lab_passport_no', esc_attr($_POST['lab_passport_no']));
}
