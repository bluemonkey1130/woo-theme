<?php
// Function to add default pages
function monkey13_create_default_pages()
{
    global $wpdb;

    $default_pages = array(

        array(
            'post_name' => 'home',
            'post_title' => 'Home'
        ),
        array(
            'post_name' => 'about',
            'post_title' => 'About'
        ),
        array(
            'post_name' => 'contactus',
            'post_title' => 'Contact Us'
        ),
        array(
            'post_name' => 'privacypolicy',
            'post_title' => 'Privacy Policy'
        ),
        array(
            'post_name' => 'blog',
            'post_title' => 'Blog'
        ),
    );

    foreach ($default_pages as $page) {
        if (!get_page_by_title($page['post_title'])) {
            $page['comment_status'] = 'closed';
            $page['ping_status'] = 'closed';
            $page['post_author'] = 1;
            $page['post_status'] = 'publish';
            $page['post_type'] = 'page';

            $post_id = wp_insert_post($page);

            $new_page = array(
                'page_name' => $page['post_name'],
                'page_id' => $post_id
            );

            $table_name = $wpdb->prefix . 'default_pages';

            $wpdb->insert($table_name, $new_page);
        }
    }
}
add_action('admin_init', 'monkey13_create_default_pages');