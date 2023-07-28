<?php
function removeWhitespace($buffer)
{
    return preg_replace('~>\s*\n\s*<~', '><', $buffer);
}

ob_start('removeWhitespace');
get_header();

?>
    <main>
        <section id="single-blog" class="grid-row">
            <div class="grid has-two-columns x-wide right-full grid-gap-000">
                <div id="single-hero-image">
                    <?php
                    $thumbnailID = get_post_thumbnail_id($post->ID);
                    if ($thumbnailID) {
                        echo wp_get_attachment_image($thumbnailID, 'square500', false, ["class" => "", "alt" => $post->post_title]);
                    }
                    ?>
                </div>
                <div id="single-hero-text">
                    <div class="stack centerLeft">
                        <?php $terms = get_the_terms($post->ID, 'category');
                        $cat_id = $terms[0]->term_id;
                        $catName = get_term_by('id', $cat_id, 'category');
                        ?>
                        <h5><?php echo $catName->name; ?></h5>
                        <h1><?php echo $post->post_title; ?></h1>
                    </div>
                </div>
            </div>
        </section>

        <?php
        $table_of_contents = generate_table_of_contents($post->ID); // Replace 123 with the ID of the page you want to generate the table of contents for
        if ( ! empty( $table_of_contents ) ) {
            echo $table_of_contents;
        }
        get_template_part('template-parts/content-page-flex');

        $posts = new WP_Query(array(
            'post_type' => 'post',
            'posts_per_page' => 10,
            'orderby' => 'date',
            'order' => 'DESC',
            'no_found_rows' => 'true',
            '_shuffle_and_pick' => 3 // <-- custom argument
        ));

        $postLoop = $posts->posts;

        $postLoop = $posts->posts;
        if ($postLoop) { ?>
            <section class="grid-row">
                <div class="grid has-one-column xx-wide grid-gap-300 gap-top-300">
                    <hr>
                    <h2>Read other articles from Ginger & Petals</h2>
                </div>
                <div class="grid xx-wide has-three-columns grid-gap-300">

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

get_footer();
ob_end_flush();