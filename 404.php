<?php
function removeWhitespace($buffer)
{
    return preg_replace('~>\s*\n\s*<~', '><', $buffer);
}

ob_start('removeWhitespace');
get_header();
?>
    <main id="page-not-found">
        <section class="grid-row">
            <div class="grid wide has-one-column grid-gap-300 gap-top-500 gap-bottom-500">
                <div class="center">
                    <h1>Oops! we can't find that page</h1>
                    <h3>
                        Page not found!
                    </h3>
                </div>

            </div>
        </section>
        <section class="grid-row">
            <div class="grid x-wide has-one-column grid-gap-300">
                <hr>
                <h2>Explore our site</h2>
            </div>
            <div class="grid x-wide has-three-columns grid-gap-300 gap-top-200">
                <?php

                $relatedPages = get_field('related_pages', 'option');

                if ($relatedPages) { ?>

                    <?php foreach ($relatedPages as $relatedPage) {
                        $permalink = get_permalink($relatedPage->ID);
                        $title = get_the_title($relatedPage->ID);
                        $imageId = get_post_thumbnail_id($relatedPage->ID); ?>

                        <div class="fadeUp block related_page">
                            <?php echo wp_get_attachment_image($imageId, 'medium', false, ["class" => "", "alt" => $title]); ?>
                            <div class="stack">
                                <h3><?php echo $title; ?></h3>
                                <?php
                                $excerpt = wp_trim_words($relatedPage->post_excerpt, $num_words = 15, $more = '...');?>
                                <p><?php echo $excerpt; ?></p>
                                <a class="abs" href="<?php echo $permalink; ?>"></a>
                            </div>
                        </div>

                    <?php }
                } ?>
            </div>
        </section>

        <?php
        $posts = new WP_Query(array(
            'post_type' => 'post',
            'posts_per_page' => 3,
            'orderby' => 'date',
            'order' => 'DESC',
            'no_found_rows' => 'true',
        ));

        $postLoop = $posts->posts;

        $postLoop = $posts->posts;
        if ($postLoop) { ?>
            <section class="grid-row">
                <div class="grid x-wide has-one-column grid-gap-300 gap-top-300">
                    <hr>
                    <h2>Read the latest stories</h2>
                </div>
                <div class="grid x-wide has-three-columns grid-gap-300">

                    <?php foreach ($postLoop as $key => $post) { ?>
                        <div class="stack">
                            <?php
                            $thumbnailID = get_post_thumbnail_id($post->ID);
                            if ($thumbnailID) {
                                echo wp_get_attachment_image($thumbnailID, 'medium', false, ["class" => "", "alt" => $post->post_title]);
                            }
                            ?>
                            <h4><?php echo $post->post_title; ?></h4>
                            <?php

                            if ($post->post_excerpt) {
                                $excerpt = wp_trim_words($post->post_excerpt, $num_words = 10, $more = '...');
                                ?>
                                <p><?php echo $excerpt ?></p>
                            <?php }

                            ?>
                            <a class="abs" href="<?php the_permalink(); ?>"></a>

                        </div>
                    <?php } ?>
                </div>
            </section>

        <?php }
        ?>
    </main>
<?php
wp_reset_postdata();


get_footer();
ob_end_flush();