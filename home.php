<?php
function removeWhitespace($buffer)
{
    return preg_replace('~>\s*\n\s*<~', '><', $buffer);
}

ob_start('removeWhitespace');
get_header();
//phpinfo();
//$order_id = 878; // Replace with the ID of the order you want to retrieve the item ID for
//$order = wc_get_order( $order_id );
//$items = $order->get_items();
//
//if ( ! empty( $items ) ) {
//    $first_item = reset( $items );
//    $order_item_id = $first_item->get_id();
//    echo "Order Item ID: " . $order_item_id;
//} else {
//    echo "No items found in order";
//}


?>


<?php

$posts = new WP_Query(array(
    'post_type' => 'post',
    'showposts' => -1,
    'order_by' => 'menu_order',
));
$postLoop = $posts->posts;
if ($postLoop) { ?>
    <section id="blog" class="grid-row">
        <div class="grid wide grid-gap-500 has-two-columns left-wide gap-top-400">
            <?php foreach ($postLoop as $key => $post) {
                $excerpt = get_field("excerpt", $post->ID);
                $terms = get_the_terms($post->ID, 'category');

                if ($key === 0) {
                    ?>
                    <article id="featured" class="stack stack-large">
                        <figure>
                            <?php
                            $thumbnailID = get_post_thumbnail_id($post->ID);
                            if ($thumbnailID) {
                                echo wp_get_attachment_image($thumbnailID, 'mediumLarge', false, ["class" => "", "alt" => $post->post_title]);
                            }
                            ?>
                        </figure>
                        <div class="stack">
                            <?php if ($terms) { ?>
                                <?php foreach ($terms as $innerKey => $term) {
                                    if ($innerKey === 0) {
                                        $cat_id = $term->term_id;
                                        $terms = get_term_by('id', $cat_id, 'category');
                                        ?>
                                        <h5><?php echo $terms->name; ?></h5>
                                        <?php
                                    }
                                }
                                ?>

                                <?php
                            } ?>
                            <h2><?php echo $post->post_title; ?></h2>
                            <?php if ($post->post_excerpt) { ?>
                                <p><?php echo $post->post_excerpt; ?></p>
                            <?php }
                            ?>
                        </div>
                        <a class="abs" href="<?php the_permalink(); ?>"></a>

                    </article>
                    <?php
                }
            }
            ?>
            <div id="list">
                <h2>Recent Stories</h2>
                <div>
                    <?php foreach ($postLoop as $key => $post) {
//                        $excerpt = get_field("excerpt", $post->ID);
                        $terms = get_the_terms($post->ID, 'category');
                        if ($key != 0) {
                            ?>
                            <article>
                                <figure>
                                    <?php
                                    $thumbnailID = get_post_thumbnail_id($post->ID);
                                    if ($thumbnailID) {
                                        echo wp_get_attachment_image($thumbnailID, 'square500', false, ["class" => "", "alt" => $post->post_title]);
                                    }
                                    ?>
                                </figure>
                                <div class="stack">
                                    <?php if ($terms) { ?>
                                        <?php foreach ($terms as $innerKey => $term) {
                                            if ($innerKey === 0) {
                                                $cat_id = $term->term_id;
                                                $terms = get_term_by('id', $cat_id, 'category');
                                                ?>
                                                <h5><?php echo $terms->name; ?></h5>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <?php
                                    } ?>
                                    <h4><?php echo $post->post_title; ?></h4>

                                    <?php if ($post->post_excerpt) {
                                        $excerpt = wp_trim_words($post->post_excerpt, $num_words = 15, $more = '...');
                                        ?>

                                        <p><?php echo $excerpt; ?></p>
                                    <?php }
                                    ?>
                                </div>
                                <a class="abs" href="<?php the_permalink(); ?>"></a>

                            </article>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
    <?php
}
wp_reset_postdata();


get_footer();
ob_end_flush();