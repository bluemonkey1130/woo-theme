<?php
function removeWhitespace($buffer)
{
    return preg_replace('~>\s*\n\s*<~', '><', $buffer);
}

ob_start('removeWhitespace');
get_header();

if (have_posts()) { ?>

    <section id="search-results" class="grid-row gap-top-400 gap-bottom-400">
        <div class="grid wide grid-gap-400">
            <?php
            if (is_search()): ?>
                <h1 class="page-title"><?php _e('Search results for:', 'nd_dosth'); ?>
                    <b><?php echo get_search_query(); ?></b></h1>

            <?php endif; ?>
        </div>
        <div class="grid wide has-three-columns grid-gap-400">

            <?php while (have_posts()): ?>
                <?php the_post(); ?>
                <div class="search-result">
                    <div class="result-image fadeUp">
                        <?php $id = get_the_ID();
                        $thumbnail = get_the_post_thumbnail_url($id, 'portrait');
                        if ($thumbnail) {
                            ?><img src="<?php echo $thumbnail; ?>"><?php
                        } else {
                            echo wc_placeholder_img();
                        }
                        ?>
                        <a class="abs" href="<?php the_permalink(); ?>"></a>
                    </div>
                    <div class="result-text stack">
                        <div class="stack">
                            <h4><?php the_title(); ?></h4>
                            <?php the_excerpt(); ?>
                            <a class="abs" href="<?php the_permalink(); ?>"></a>
                        </div>
                        <?php $terms = get_the_terms($id, 'product_cat'); ?>
                        <?php if ($terms) { ?>
                            <div class="term-group">
                            <p>Categories</p>
                            <?php foreach ($terms as $term) {
                                $product_cat_id = $term->term_id;
                                $terms = get_term_by('id', $product_cat_id, 'product_cat');
                                ?>
                                <a href="<?php echo get_term_link($product_cat_id); ?>"><?php echo $terms->name . ', '; ?></a>
                                <?php
                            }
                            ?> </div><?php
                        }
                        ?>
                    </div>

                </div>
            <?php endwhile; ?>
            <?php the_posts_pagination(); ?>
        </div>
    </section>


<?php } else { ?>
    <section id="no-search-results" class="grid-row gap-top-400 gap-bottom-400">
        <div class="grid wide has-one-column grid-gap-200">
            <div><h2>No Search Results found for: <b><?php echo get_search_query(); ?></b></h2></div>
            <div class="search-box">
                <div class="search">
                    <?php echo get_search_form(); ?>
                </div>
            </div>
        </div>
    </section>


<?php } ?>
    <section id="no-search-results" class="grid-row gap-top-400 gap-bottom-400">
        <?php
        $searchText = get_field('search_text', 'option');
        if ($searchText) {
            ?>
            <div class="grid wide has-one-column grid-gap-200">
                <hr>
                <div>
                    <?php echo $searchText; ?>
                </div>
            </div>
        <?php } ?>
        <div class="grid wide has-three-columns grid-gap-200">
            <?php

            $relatedPages = get_field('related_pages', 'option');

            if ($relatedPages) { ?>

                <?php foreach ($relatedPages as $relatedPage) {
                    $permalink = get_permalink($relatedPage->ID);
                    $title = get_the_title($relatedPage->ID);
                    $imageId = get_post_thumbnail_id($relatedPage->ID);
                    $excerpt = get_field('excerpt', $relatedPage->ID); ?>

                    <div class="fadeUp block related_page">
                        <?php echo wp_get_attachment_image($imageId, 'medium', false, ["class" => "", "alt" => $title]); ?>
                        <div class="stack">
                            <h3><?php echo $title; ?></h3>
                            <?php
                            $excerpt = wp_trim_words($relatedPage->post_excerpt, $num_words = 15, $more = '...'); ?>

                            <p><?php echo $excerpt; ?></p>
                            <a class="abs" href="<?php echo $permalink; ?>"></a>
                        </div>
                    </div>

                <?php }
            } ?>
        </div>
    </section>
<?php

get_footer();
ob_end_flush();
