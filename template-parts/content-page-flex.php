<?php
$flexFields = get_field('row', $post->ID);
$pageRowSpace = get_field('space_top', $post->ID);
$pageGridGap = get_field('grid_gap', $post->ID);


if ($flexFields > 0) {
    foreach ($flexFields as $key => $row) {
        $rowRowSpace = $row['space_top'];
        if ($rowRowSpace == 'default') {
            $rowSpace = $pageRowSpace;
        } else {
            $rowSpace = $rowRowSpace;
        }
        $rowGridGap = $row['grid_gap'];
        if ($rowGridGap == 'default') {
            $gridGap = $pageGridGap;
        } else {
            $gridGap = $rowGridGap;
        }
        $rowColour = $row['row_colour'] ?? '';
        $paddingTop = $row['padding_top'] ?? '';
        $paddingBottom = $row['padding_bottom'] ?? '';
        $rowWidth = $row['row_width'] ?? '';
        $rowLayout = $row['row_layout'] ?? '';
        $backgroundImage = $row['background_image'] ?? '';
        $anchorLabel = $row['admin_label'] ?? '';

        if ($row > 0) {

            switch ($row['acf_fc_layout']) {
                case 'grid_layout': ?>
                    <section id="<?php echo sanitize_title($anchorLabel); ?>"
                             <?php if ($backgroundImage){ ?>style="background: url(<?php echo $backgroundImage['url']; ?>) center center/cover no-repeat"<?php } ?>
                             class="grid-row <?php echo $rowSpace . ' ' . $rowColour . ' ' . $paddingTop . ' ' . $paddingBottom . ' ' . sanitize_title($row['acf_fc_layout']) ?>">
                        <div class="grid <?php echo $rowLayout . ' ' . $rowWidth . ' ' . $gridGap; ?>">
                            <?php foreach ($row['content'] as $innerKey => $block) {
                                switch ($block['acf_fc_layout']) {
                                    case 'text':
                                        ?>
                                        <div class="textBlock <?php echo $block['alignment'] . ' ' . $block['background_colour']; ?>
                                <?php if ($block['block_padding']) {
                                            echo $block['padding_top'] . ' ' . $block['padding_bottom'] . ' ' . $block['padding_left'] . ' ' . $block['padding_right'];
                                        } ?>">
                                            <div class="stack">
                                                <?php echo $block['text_content']; ?>
                                                <?php
                                                $buttonRepeater = $block['button_repeater'];
                                                $buttonOrientation = $block['button_orientation'];
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
                                        <?php break;
                                    case 'image' :
                                        ?>
                                        <figure class="imageBlock <?php ?>">
                                            <?php
                                            $image = $block['image_content'];
                                            $imageCrop = $block['image_crop'];
                                            echo wp_get_attachment_image($image['id'], $imageCrop, false, ["class" => "", "alt" => $image['alt']]);
                                            ?>
                                        </figure>
                                        <?php break;
                                    case 'video':
                                        $url = $block['video_content'];
                                        parse_str(parse_url($url, PHP_URL_QUERY), $my_array_of_vars);
                                        if ($url) {
                                            ?>
                                            <div class="popup-video"
                                                 href="https://www.youtube.com/watch?v=<?php echo $my_array_of_vars['v'] ?>">
                                                <img src="https://img.youtube.com/vi/<?php echo $my_array_of_vars['v']; ?>/0.jpg"
                                                     alt="video">
                                                <i class="fas fa-play-circle"></i>
                                            </div>

                                        <?php }
                                    case 'location': ?>
                                        <div class="map-wrapper" style="width: 100%; height: 500px;">
                                            <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
                                            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDNIVftYn5q6tPwVlNhQ5NCN1dEaqGfhyA&callback=initmultipleMaps&libraries=&v=beta&map_ids=745fe24ebe33e9f4"
                                                    defer></script>
                                            <?php
                                            $location = $block['location_content'];
                                            $iconColor = $block['icon_colour'];
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
                                        <?php break;
                                    case 'accordion': ?>
                                        <?php if ($block['accordion_repeater']) { ?>
                                            <div class="accordionBlock">
                                                <div class="accordion">
                                                    <?php foreach ($block['accordion_repeater'] as $accordion) {
                                                        $accordionTitle = $accordion['accordion_title'];
                                                        $accordionContent = $accordion['accordion_content'];
                                                        ?>
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
                                                        <?php
                                                    } ?>

                                                </div>
                                            </div>
                                            <?php
                                        }
                                        break;
                                    case 'embed': ?>
                                        <div>
                                            <?php
                                            $type = $block['embed_type'];
                                            $raw = $block['raw_embed'];
                                            $shortCode = $block['shortcode_embed'];
                                            if ($type == 'raw_embed') {
                                                echo $raw;
                                            } elseif ($type == 'shortcode_embed') {
                                                echo do_shortcode($shortCode);
                                            }
                                            ?>
                                        </div>
                                    <?php
                                    case 'feature_text': ?>
                                        <div class="featureBlock <?php echo $block['image_orientation'] . ' ' . $block['block_colour'] . ' ' . $block['padding'] ?>">
                                            <div class="stack">
                                                <?php echo $block['text'];
                                                $buttonRepeater = $block['button_repeater'];
                                                if ($buttonRepeater) {
                                                    ?>
                                                    <div class="button-wrap <?php echo $block['button_orientation']; ?>">
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
                                            <?php
                                            $image = $block['image'];
                                            if ($image) { ?>
                                                <figure class="<?php echo $block['image_style']; ?>"
                                                        style="max-width:<?php echo $block['max_width']; ?>px">
                                                    <?php echo wp_get_attachment_image($image['id'], $block['image_crop'], false, ["class" => "", "alt" => $image['alt']]); ?>
                                                </figure>
                                            <?php } ?>
                                        </div>
                                        <?php break;
                                    default;
                                }
                            } ?>
                        </div>
                    </section>
                    <?php break;
                case 'section_layout': ?>
                    <?php foreach ($row['content'] as $innerKey => $block) { ?>
                        <section id="<?php echo sanitize_title($anchorLabel); ?>"
                                 class="grid-row <?php echo $rowSpace . ' ' . $rowColour . ' ' . $paddingTop . ' ' . $paddingBottom . ' ' . sanitize_title($row['acf_fc_layout']) ?>">
                            <?php switch ($block['acf_fc_layout']) {
                                case 'products': ?>
                                    <div class="grid <?php echo $rowLayout . ' ' . $rowWidth . ' ' . $gridGap; ?>">
                                        <?php $selection = $block['selection_choice'];
                                        switch ($selection) {
                                            case 'all':
                                                $products = new WP_Query(array(
                                                    'post_type' => 'product',
                                                    'showposts' => -1,
                                                    'order_by' => 'menu_order',
                                                ));
                                                $productLoop = $products->posts;
                                                break;
                                            case 'categories':
                                                $catID = $block['product_categories'];
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
                                                break;
                                            case 'custom':
                                                $productLoop = $block['custom'];
                                                break;
                                            default;
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
                                                    <a href="<?php the_permalink(); ?>" class="button primary">Read
                                                        More</a>

                                                </div>
                                                <?php
                                            }
                                        }
                                        wp_reset_postdata();
                                        ?>
                                    </div>
                                    <?php break;
                                case 'masonry' : ?>
                                    <div class="grid masonry <?php echo $rowLayout . ' ' . $rowWidth . ' ' . $gridGap; ?>">
                                        <div class="grid-sizer"></div>
                                        <?php foreach ($block['content'] as $tile) {
                                            $contentType = $tile['content_type'];
                                            $tileSize = $tile['tile_size'];
                                            $tileColour = $tile['background_colour'];
                                            $tilePadding = $tile['padding'];
                                            switch (sanitize_title($tileSize)) {
                                                case 'two-x-two':
                                                case 'one-x-one':
                                                    $crop = 'square500';
                                                    break;
                                                case 'one-x-two':
                                                    $crop = 'square1000';
                                                    break;
                                                case 'two-x-one':
                                                    $crop = 'largeportrait';
                                                    break;
                                            }
                                            ?>
                                            <div class="grid-item <?php echo $tileSize.' '.$contentType.' '.$tilePadding.' '.$tileColour; ?>">
                                                <?php
                                                switch ($contentType) {
                                                    case'text': ?>
                                                        <div class="item__content">
                                                            <?php echo $tile['text']; ?>
                                                        </div>
                                                        <?php break;
                                                    case'image': ?>
                                                        <div class="item__content">
                                                            <?php echo wp_get_attachment_image($tile['image']['id'], $crop, false, ["class" => "", "alt" => $tile['image']['alt']]); ?>
                                                            <a class="gallery-item abs"
                                                               href="<?php echo $tile['image']['url'] ?>" alt="<?php echo $tile['image']['alt']?>"></a>

                                                        </div>

                                                        <?php break;
                                                    default;
                                                }
                                                ?>
                                            </div>
                                            <?php
                                            ?>

                                            <?php
                                        } ?>
                                    </div>
                                    <?php break;
                                default;
                            }
                            ?>
                        </section>
                        <?php
                    } ?>
                    <?php break;
                default;
            }
        }
    }
}