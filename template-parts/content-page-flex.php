<?php
$flexFields = get_field('row', $post->ID);
$rowSpace = get_field('space_top', $post->ID);
$gridGap = get_field('grid_gap', $post->ID);

if (have_rows('row')):

    while (have_rows('row')) : the_row();

        if (get_row_layout() == 'grid_layout'): ?>
            <?php
            if ($rowSpace == 'default') {
                $rowSpace = get_sub_field('space_top');
            }
            if ($gridGap == 'default') {
                $gridGap = get_sub_field('grid_gap');
            }
            $rowColour = get_sub_field('row_colour');
            $paddingTop = get_sub_field('padding_top');
            $paddingBottom = get_sub_field('padding_bottom');
            $rowLayout = get_sub_field('row_layout');
            $rowWidth = get_sub_field('row_width');
            ?>
            <?php if (have_rows('content')): ?>
                <section
                        class="grid-row <?php echo $rowSpace . ' ' . $rowColour . ' ' . $paddingTop . ' ' . $paddingBottom ?>">
                    <div class="grid <?php echo $rowLayout . ' ' . $rowWidth . ' ' . $gridGap ?>">
                        <?php while (have_rows('content')) : the_row(); ?>
                            <?php $label = get_sub_field('acf_fc_layout'); ?>
                            <?php if (get_row_layout() == 'text'): ?>
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

                            <?php elseif (get_row_layout() == 'image'): ?>
                                <figure class="imageBlock <?php ?>">
                                    <?php
                                    $image = get_sub_field('image_content');
                                    $imageCrop = get_sub_field('image_crop');
                                    echo wp_get_attachment_image($image['id'], $imageCrop, false, ["class" => "", "alt" => $image['alt']]);
                                    ?>
                                </figure>
                            <?php elseif (get_row_layout() == 'video'): ?>
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
                            <?php elseif (get_row_layout() == 'location'): ?>
                                <div class="map-wrapper" style="width: 100%; height: 500px;">
                                    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
                                    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDNIVftYn5q6tPwVlNhQ5NCN1dEaqGfhyA&callback=initmultipleMaps&libraries=&v=beta&map_ids=745fe24ebe33e9f4"
                                            defer></script>
                                    <?php $location = get_sub_field('location_content'); ?>
                                    <div class="map">
                                        <?php echo
                                            $location['lat'] . ',' .
                                            $location['lng'] . ',' .
                                            $location['zoom']; ?>
                                    </div>
                                </div>
                            <?php elseif (get_row_layout() == 'accordion'): ?>
                                <?php if (have_rows('accordion_repeater')): ?>
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
                                <?php else :

                                endif;
                                ?>




                            <?php endif;

                        endwhile; ?>
                    </div>
                </section>
            <?php else :

            endif;

        elseif (get_row_layout() == 'download'):

        endif;

    endwhile;

else :

endif;