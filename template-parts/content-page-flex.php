<?php
$flexFields = get_field('row', $post->ID);
$pageRowSpace = get_field('space_top', $post->ID);
$pageGridGap = get_field('grid_gap', $post->ID);

if (have_rows('row')) {

    while (have_rows('row')) : the_row();
        $rowRowSpace = get_sub_field('space_top');
        if ($rowRowSpace == 'default') {
            $rowSpace = $pageRowSpace;
        } else {
            $rowSpace = $rowRowSpace;
        }
        $rowGridGap = get_sub_field('grid_gap');
        if ($rowGridGap == 'default') {
            $gridGap = $pageGridGap;
        } else {
            $gridGap = $rowGridGap;
        }

        $rowColour = get_sub_field('row_colour');
        $paddingTop = get_sub_field('padding_top');
        $paddingBottom = get_sub_field('padding_bottom');
        $rowWidth = get_sub_field('row_width');
        $rowLayout = get_sub_field('row_layout');
        $layout = get_row_layout();

        if ($layout == 'grid_layout') {

            if (have_rows('content')) { ?>
                <section
                        class="grid-row <?php echo $rowSpace . ' ' . $rowColour . ' ' . $paddingTop . ' ' . $paddingBottom . ' ' . sanitize_title($layout) ?>">
                    <div class="grid <?php echo $rowLayout . ' ' . $rowWidth . ' ' . $gridGap; ?>">
                        <?php while (have_rows('content')) : the_row(); ?>
                            <?php $label = get_sub_field('acf_fc_layout'); ?>
                            <?php if (get_row_layout() == 'text') { ?>
                                <?php
                                $text = get_sub_field('text_content');
                                $alignment = get_sub_field('alignment');
                                $backgroundColour = get_sub_field('background_colour');
                                $blockPadding = get_sub_field('block_padding');
                                $paddingTop = get_sub_field('padding_top');
                                $paddingBottom = get_sub_field('padding_bottom');
                                $paddingLeft = get_sub_field('padding_left');
                                $paddingRight = get_sub_field('padding_right');
                                ?>
                                <div class="textBlock <?php echo $alignment . ' ' . $backgroundColour; ?>
                                    <?php if ($blockPadding) {
                                    echo $paddingTop . ' ' . $paddingBottom . ' ' . $paddingLeft . ' ' . $paddingRight;
                                } ?>">
                                    <div class="stack">
                                        <?php echo $text; ?>
                                        <?php
                                        $buttonRepeater = get_sub_field('button_repeater');
                                        $buttonOrientation = get_sub_field('button_orientation');
                                        if ($buttonRepeater) {
                                            ?>
                                            <div class="button-wrap <?php echo $buttonOrientation; ?>">
                                                <?php
                                                foreach ($buttonRepeater as $buttonBlock) {
                                                    $button = $buttonBlock['button']; ?>
                                                    <a href="<?php echo $button['url'] ?>"
                                                       class="button <?php echo $buttonBlock['button_style'] . ' ' . $buttonBlock['button_colour'] ?>"
                                                       target="<?php echo $button['target'] ?>">
                                                        <?php echo $button['title'] ?></a>
                                                    <?php

                                                }
                                                ?>
                                            </div>
                                            <?php
                                        }
                                        ?>

                                    </div>
                                </div>

                            <?php } elseif (get_row_layout() == 'image') { ?>
                                <figure class="imageBlock <?php ?>">
                                    <?php
                                    $image = get_sub_field('image_content');
                                    $imageCrop = get_sub_field('image_crop');
                                    echo wp_get_attachment_image($image['id'], $imageCrop, false, ["class" => "", "alt" => $image['alt']]);
                                    ?>
                                </figure>

                            <?php } elseif (get_row_layout() == 'video') { ?>
                                <?php
                                $video = get_sub_field('video_content', FALSE);
                                if ($video) {
                                    $v = parse_video_uri($video);
                                    $vid = $v['id'];
                                }
                                ?>
                                <div class="popup-video" href="https://www.youtube.com/watch?v=<?php echo $vid ?>">
                                    <img src="https://img.youtube.com/vi/<?php echo $vid; ?>/0.jpg" alt="video">
                                    <i class="fas fa-play-circle"></i>
                                </div>

                            <?php } elseif (get_row_layout() == 'location') { ?>
                                <div class="map-wrapper" style="width: 100%; height: 500px;">
                                    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
                                    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDNIVftYn5q6tPwVlNhQ5NCN1dEaqGfhyA&callback=initmultipleMaps&libraries=&v=beta&map_ids=745fe24ebe33e9f4"
                                            defer></script>
                                    <?php
                                    $location = get_sub_field('location_content');
                                    $iconColor = get_sub_field('icon_colour');
                                    ?>
                                    <div class="map">
                                        <?php echo
                                            $location['lat'] . ',' .
                                            $location['lng'] . ',' .
                                            $location['zoom'] . ',' .
                                            'AIzaSyDNIVftYn5q6tPwVlNhQ5NCN1dEaqGfhyA' . ', ' .
                                            $iconColor . ',' .
                                            $location['address'] . ',';
                                        ?>
                                    </div>
                                </div>

                            <?php } elseif (get_row_layout() == 'accordion') { ?>
                                <?php if (have_rows('accordion_repeater')) { ?>
                                    <div class="accordionBlock">
                                        <div class="accordion">
                                            <?php while (have_rows('accordion_repeater')) : the_row(); ?>

                                                <?php $accordionTitle = get_sub_field('accordion_title'); ?>
                                                <?php $accordionContent = get_sub_field('accordion_content'); ?>
                                                <div class="stack accordion-block">
                                                    <div class="trigger stack">
                                                        <?php echo $accordionTitle; ?>
                                                        <i class="fas fa-plus icon-default"></i>
                                                        <i class="fa fa-minus icon-active"></i>
                                                    </div>
                                                    <div class="draw stack stack-small">
                                                        <?php echo $accordionContent; ?>
                                                    </div>
                                                </div>
                                            <?php endwhile; ?>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } elseif (get_row_layout() == 'embed') { ?>
                                <div>
                                    <?php
                                    $type = get_sub_field('embed_type');
                                    $raw = get_sub_field('raw_embed');
                                    $shortCode = get_sub_field('shortcode_embed');
                                    if ($type == 'raw_embed') {
                                        echo $raw;
                                    } elseif ($type == 'shortcode_embed') {
                                        echo do_shortcode($shortCode);
                                    }
                                    ?>
                                </div>
                            <?php }
                        endwhile; ?>
                    </div>
                </section>
            <?php }

        } elseif ($layout == 'section_layout') {

            if (have_rows('content')) { ?>
                <section
                        class="grid-row <?php echo $rowSpace . ' ' . $rowColour . ' ' . $paddingTop . ' ' . $paddingBottom . ' ' . sanitize_title($layout) ?>">
                    <?php while (have_rows('content')) : the_row(); ?>
                        <?php $label = get_sub_field('acf_fc_layout'); ?>

                        <?php if (get_row_layout() == 'products') { ?>

                            <div class="grid <?php echo $rowLayout . ' ' . $rowWidth . ' ' . $gridGap . ' ' . $label; ?>">
                                <?php $selection = get_sub_field('selection_choice');

                                if ($selection == 'all') {
                                    $products = new WP_Query(array(
                                        'post_type' => 'product',
                                        'showposts' => -1,
                                        'order_by' => 'menu_order',
                                    ));
                                    $productLoop = $products->posts;

                                } elseif ($selection == 'categories') {
                                    $catID = get_sub_field('product_categories');
                                    $products = new WP_Query(array(
                                        'post_type' => 'product',
                                        'showposts' => -1,
                                        'order_by' => 'menu_order',
                                        'tax_query' => array_merge(array(
                                            'relation' => 'AND',
                                            array(
                                                'taxonomy' => 'product_cat',
                                                'terms' => $catID[0],
                                                'field' => 'term_taxonomy_id'
                                            )
                                        ))
                                    ));
                                    $productLoop = $products->posts;

                                } elseif ($selection == 'custom') {
                                    $productLoop = get_sub_field('custom');
                                }
                                if ($productLoop) {
                                    foreach ($productLoop as $key => $post) { ?>
                                        <div class="stack card">
                                            <figure>
                                                <?php
                                                $thumbnailID = get_post_thumbnail_id($post->ID);
                                                if ($thumbnailID) {
                                                    echo wp_get_attachment_image($thumbnailID, 'shop_thumbnail', false, ["class" => "", "alt" => $post->post_title]);
                                                } else {
                                                    echo wc_placeholder_img();
                                                }
                                                ?>
                                                <a class="abs" href="<?php the_permalink(); ?>"></a>
                                            </figure>

                                            <h4><?php echo $post->post_title; ?></h4>
                                            <?php $_product = wc_get_product($post->ID); ?>
                                            <p class="color-base-green"><?php echo wc_price($_product->get_price()) . ' /Per Day'; ?></p>
                                            <?php if ($post->post_excerpt) { ?>
                                                <?php shorten_product_excerpt() ?>
                                            <?php } ?>

                                            <a href="<?php the_permalink(); ?>" class="button primary">Read More</a>

                                        </div>
                                        <?php

                                    }
                                }

                                wp_reset_postdata();
                                ?>
                            </div>
                            <?php
                        }

                    endwhile; ?>

                </section>
            <?php }
        }

    endwhile;

}