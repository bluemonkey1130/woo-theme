<?php
if (is_shop()) {
    $page_id = wc_get_page_id('shop');
} else {
    $page_id = $post->ID;
}
$flexFields = get_field('row', $page_id);
$pageRowSpace = get_field('space_top', $page_id);
$pageGridGap = get_field('grid_gap', $page_id);
$mapOnce = 0;


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
        $ignoreBreakpoints = $row['ignore_breakpoints'] ?? '';

        //SLIDER SETTINGS
        $sliderSettings = $row['slider_settings'] ?? '';
        $slider = $sliderSettings['use_slider'] ?? '';
        $slidesToShow = $sliderSettings['slides_to_show'] ?? '';
        $autoPlay = $sliderSettings['autoplay'] ?? '';
        $fade = $sliderSettings['fade'] ?? '';
        $autoPlaySpeed = $sliderSettings['auto_play_speed'] ?? '';
        $arrowsField = $sliderSettings['arrows'] ?? '';
        $arrows = $arrowsField ? 'true' : 'false';
        $breakpoint = $sliderSettings['screen_size'] ?? '';

        if ($slider == 1) { ?>
            <script>
                let sliderBreakpoint = <?php echo $breakpoint?>;
            </script>
            <?php if ($fade === false) {
                $slickString = "data-slick='{\"slidesToShow\": " . $slidesToShow . ", \"autoplay\": " . $autoPlay . ", \"autoplaySpeed\": " . $autoPlaySpeed . ", \"arrows\":  " . $arrows . "}'";
            } elseif ($fade === true) {
                $slickString = "data-slick='{\"slidesToShow\": 1, \"autoplay\": " . $autoPlay . ", \"fade\": true , \"infinite\": true, \"autoplaySpeed\": " . $autoPlaySpeed . ", \"arrows\": " . $arrows . "}'";
            } ?>
            <?php
            $slickClass = 'flexSlider';
            $slickNext = '<button type="button" id="next next-' . $key . '"><span>&raquo;</span></button>';
            $slickPrev = '<button type="button" id="prev prev-' . $key . '"><span>&laquo;</span></button>';

        } else {
            $slickString = '';
            $slickClass = '';
            $slickNext = '';
            $slickPrev = '';
        }

        if ($row > 0) {

            switch ($row['acf_fc_layout']) {
                case 'grid_layout': ?>
                    <section id="<?php echo sanitize_title($anchorLabel); ?>"
                             <?php if ($backgroundImage){ ?>style="background: url(<?php echo $backgroundImage['url']; ?>) center center/cover no-repeat"<?php } ?>
                             class="grid-row <?php echo $rowSpace . ' ' . $rowColour . ' ' . $paddingTop . ' ' . $paddingBottom . ' ' . sanitize_title($row['acf_fc_layout']); ?><?php if ($slider == 1) { ?> sliderWrapper<?php } ?>">

                        <div class="grid <?php echo $rowLayout . ' ' . $rowWidth . ' ' . $gridGap; ?>
                            <?php foreach ($ignoreBreakpoints as $breakpoint) {
                            echo $breakpoint . ' ';
                        } ?>
                            ">

                            <?php if ($slider == 1) { ?>
                            <div class="<?php echo $slickClass . ' ' . $rowLayout; ?>

                            " <?php echo $slickString; ?>>
                                <?php } ?>

                                <?php foreach ($row['content'] as $innerKey => $block) {
                                    switch ($block['acf_fc_layout']) {
                                    case 'text':
                                        ?>
                                        <div class="textBlock <?php echo $block['alignment'] . ' ' . $block['background_colour']; ?>
                                    <?php if ($block['block_padding']) {
                                            echo $block['padding_top'] . ' ' . $block['padding_bottom'] . ' ' . $block['padding_left'] . ' ' . $block['padding_right'];
                                        } ?>">
                                            <div class="stack parentOrphanPrevent">
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
                                    $image = $block['image_content'];
                                    $imageCrop = $block['image_crop'];
                                    $useAsBackgroundImage = $block['use_as_background_image'];
                                    $backgroundGroupSettings = $block['background_settings'];
                                    $height = $backgroundGroupSettings['height'];
                                    $style = $backgroundGroupSettings['style'];
                                    if ($useAsBackgroundImage === true){ ?>
                                        <div class="background-image <?php echo $style; ?>"
                                             style="
                                                     background: url(<?php echo wp_get_attachment_image_url($image['id'], $imageCrop); ?>) center center/cover no-repeat;
                                                     height:<?php echo $height ?>px;">
                                        </div>
                                    <?php }else { ?>
                                        <figure class="imageBlock">
                                            <?php echo wp_get_attachment_image($image['id'], $imageCrop, false, ["class" => "", "alt" => $image['alt']]); ?>
                                        </figure>
                                    <?php }
                                    break;
                                    case 'related_page': ?>
                                    <?php
                                    $featured_posts = $block['page'];
                                    if ($featured_posts): ?>

                                    <?php foreach ($featured_posts

                                    as $featured_post):
                                    $permalink = get_permalink($featured_post->ID);
                                    $title = get_the_title($featured_post->ID);
                                    $imageId = get_post_thumbnail_id($featured_post->ID);
                                    ?>

                                        <div class="fadeUp block <?php echo $block['acf_fc_layout']; ?> ">
                                            <a class="abs" aria-label="View <?php echo $title; ?> Page"
                                               href="<?php echo $permalink; ?>"></a>

                                            <?php echo wp_get_attachment_image($imageId, 'medium', false, ["class" => "", "alt" => $title]); ?>
                                            <div class="stack">
                                                <h3><?php echo $title; ?></h3>
                                                <?php if ($featured_post->post_excerpt) {
                                                    $excerpt = wp_trim_words($featured_post->post_excerpt, $num_words = 20, $more = '...');
                                                    ?>
                                                    <p><?php echo $excerpt; ?></p>
                                                <?php } ?>
                                            </div>
                                        </div>

                                    <?php endforeach; ?>

                                    <?php endif; ?>
                                    <?php break;
                                    case 'video':
                                    $url = $block['video_content'];
                                    parse_str(parse_url($url, PHP_URL_QUERY), $my_array_of_vars);
                                    if ($url) {
                                    ?>
                                        <div class="popup-video">
                                            <img src="https://img.youtube.com/vi/<?php echo $my_array_of_vars['v']; ?>/0.jpg">
                                            <i class="fas fa-play-circle"></i>
                                            <a class="js-modal-btn abs"
                                               data-video-id="<?php echo $my_array_of_vars['v'] ?>"></a>

                                        </div>


                                    <?php }
                                    break;
                                    case 'location':

                                    if ($mapOnce === 0) { ?>
                                        <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
                                        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJBxNfl_FJ3noTrBZO3KCgSk2hhk5Sy0Y&callback=initMaps&libraries=&v=beta&map_ids=9a262de91ec9e38e"
                                                defer></script>
                                    <?php
                                    $mapOnce = 1;
                                    }
                                    ?>
                                        <div class="map-wrapper" style="width: 100%; height: 500px;">
                                            <?php if ($block['maps']) {
                                                if (count($block['maps']) === 1) { ?>
                                                    <?php foreach ($block['maps'] as $mapKey => $map) {
                                                        $location = $map['map'];
                                                        $iconColor = $map['icon_colour']; ?>
                                                        <div class="map">
                                                            <?php echo $location['lat'] . ',' .
                                                                $location['lng'] . ',' .
                                                                $location['zoom'] . ',' .
                                                                '9a262de91ec9e38e' . ', ' .
                                                                $iconColor . ',' .
                                                                $location['address'] . ','; ?>
                                                        </div>
                                                    <?php }
                                                } elseif (count($block['maps']) > 1) {
                                                    ?>
                                                    <div id="map"
                                                         style="width: 100%; height: 500px; grid-column: 1 / -1">
                                                        <div class="map-info">
                                                            <?php
                                                            echo $block['maps'][0]['map']['zoom'] . ',' .
                                                                '9a262de91ec9e38e' . ', ';
                                                            ?>
                                                        </div>
                                                        <?php foreach ($block['maps'] as $map) {
                                                            $location = $map['map'];
                                                            $iconColor = $map['icon_colour']; ?>
                                                            <div class="location">
                                                                <?php echo $location['lat'] . ',' .
                                                                    $location['lng'] . ',' .
                                                                    $iconColor . ',' .
                                                                    $location['address'] . ','; ?>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                <?php } ?>

                                            <?php } ?>
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
                                            if ($block['text_area']) { ?>
                                                <div class="stack gap-bottom-300">
                                                    <?php echo $block['text_area']; ?>
                                                </div>
                                            <?php }
                                            ?>
                                            <?php
                                            $type = $block['embed_type'];
                                            $raw = $block['raw_embed'];
                                            $shortCode = $block['shortcode_embed'];
                                            if ($type === false) {
                                                echo $raw;
                                            } elseif ($type === true) {
                                                echo do_shortcode($shortCode);
                                            }
                                            ?>
                                        </div>
                                    <?php
                                    break;
                                    case 'feature_text': ?>
                                        <div class="fadeIn featureBlock <?php echo $block['image_orientation'] . ' ' . $block['block_colour'] . ' ' . $block['padding'] ?>">
                                            <div class="stack parentOrphanPrevent">
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
                                    case 'slides': ?>
                                        <div class="slidesBlock">
                                            <?php
                                            foreach ($block['slides'] as $slides) {
                                                echo wp_get_attachment_image($slides['slide_image']['id'], $block['image_crop'], false, ["class" => "", "alt" => $slides['slide_image']['alt']]);
                                            }
                                            ?>
                                        </div>
                                    <?php break;
                                    case 'spacer':
                                    $height = $block['height'];
                                    $backgroundColour = $block['background_colour'];
                                    $colourOptions = $block['colour_options'];
                                    $brandColour = $colourOptions['brand_colours'];
                                    $customColour = $colourOptions['custom'];
                                    ?>
                                        <div class="<?php echo $block['acf_fc_layout']; ?>
                                        <?php if ($backgroundColour === true) {
                                            echo $colourOptions['brand_colours'];
                                        } ?>"
                                             style="
                                                     height:<?php echo $height; ?>px;
                                             <?php if ($backgroundColour === true) { ?>
                                                     background-color: <?php  echo $colourOptions['custom'];
                                             } ?>">
                                        </div>
                                        <?php
                                        break;
                                        default;
                                    }
                                } ?>

                                <?php if ($slider == 1) { ?>
                            </div>
                        <?php } ?>
                        </div>

                    </section>
                    <?php break;
                case 'section_layout': ?>
                    <?php foreach ($row['content'] as $innerKey => $block) { ?>
                        <section id="<?php echo sanitize_title($anchorLabel); ?>"
                                 class="grid-row <?php echo $rowSpace . ' ' . $rowColour . ' ' . $paddingTop . ' ' . $paddingBottom . ' ' . sanitize_title($row['acf_fc_layout']) ?>">
                            <?php switch ($block['acf_fc_layout']) {
                                case 'products': ?>
                                    <div class="grid <?php echo $rowLayout . ' ' . $rowWidth . ' ' . $gridGap; ?>
                                        <?php foreach ($ignoreBreakpoints as $breakpoint) {
                                        echo $breakpoint . ' ';
                                    } ?>
                                        ">
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
                                                <div class="fadeUp stack card flex-products">
                                                    <figure>
                                                        <?php
                                                        $thumbnailID = get_post_thumbnail_id($post->ID);
                                                        if ($thumbnailID) {
                                                            ?>
                                                            <img src="<?php echo wp_get_attachment_image_url($thumbnailID, 'portrait') ?>"
                                                                 srcset="<?php echo wp_get_attachment_image_url($thumbnailID, 'portrait') ?> 1920w,
                                                                <?php echo wp_get_attachment_image_url($thumbnailID, 'portrait') ?> 1536w,
                                                                <?php echo wp_get_attachment_image_url($thumbnailID, 'smallPortrait') ?> 768w,
                                                                <?php echo wp_get_attachment_image_url($thumbnailID, 'smallPortrait') ?> 576w,
                                                                <?php echo wp_get_attachment_image_url($thumbnailID, 'smallPortrait') ?> 384w,"
                                                                 sizes="100vw"
                                                                 alt="<?php echo $post->post_title; ?>"
                                                            />
                                                            <?php
                                                        } else {
                                                            echo wc_placeholder_img();
                                                        }
                                                        ?>
                                                    </figure>
                                                    <h4><?php echo $post->post_title; ?></h4>
                                                    <?php $_product = wc_get_product($post->ID); ?>
                                                    <p class="color-base-grey"><?php echo wc_price($_product->get_price()); ?></p>
                                                    <a aria-label="View <?php echo $post->post_title; ?> Product Page"
                                                       href="<?php the_permalink(); ?>" class="abs"></a>

                                                </div>
                                                <?php
                                            }
                                        }
                                        wp_reset_postdata();
                                        ?>
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