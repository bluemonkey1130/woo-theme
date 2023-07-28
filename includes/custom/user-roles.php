<?php
function add_custom_user_roles() {
    // Basic Wholesale User
    add_role('wholesale_user', 'Wholesale User');

    // Florist Wholesaler
    add_role('florist_wholesaler', 'Florist Wholesaler', array(
        'read' => true,
        'edit_posts' => false,
        'delete_posts' => false,
        'buy_percentage_discount' => true, // Custom capability for the discount privilege
    ));
}
add_action('init', 'add_custom_user_roles');

function add_florist_wholesaler_fields($user) {
    ?>
    <h3><?php _e('Florist Wholesaler Information', 'text-domain'); ?></h3>
    <table class="form-table">
        <tr>
            <th><label for="business_name"><?php _e('Business Name', 'text-domain'); ?></label></th>
            <td>
                <input type="text" name="business_name" id="business_name" value="<?php echo esc_attr(get_the_author_meta('business_name', $user->ID)); ?>" class="regular-text" />
            </td>
        </tr>
        <!-- Add more fields as needed -->
    </table>
    <?php
}
add_action('show_user_profile', 'add_florist_wholesaler_fields');
add_action('edit_user_profile', 'add_florist_wholesaler_fields');

function save_florist_wholesaler_fields($user_id) {
    if (!current_user_can('edit_user', $user_id)) {
        return;
    }

    update_user_meta($user_id, 'business_name', sanitize_text_field($_POST['business_name']));
    // Add more fields as needed
}
add_action('personal_options_update', 'save_florist_wholesaler_fields');
add_action('edit_user_profile_update', 'save_florist_wholesaler_fields');