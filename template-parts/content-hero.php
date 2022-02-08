<?php
$heroSlides = get_field('hero_slides');
$heroSettings = get_field('hero_settings');


if (have_rows('hero_slides')):
    ?>
    <section id="hero" class="grid-row ">
        <?php $numrows = count($heroSlides); ?>
        <?php if ($numrows > 1){ ?>
        <div class="grid align-full slider">
            <?php } ?>
            <?php while (have_rows('hero_slides')) : the_row();
                $text = get_sub_field('slide_text');

                ?>
                <?php if ($numrows > 1) { ?>
                    <div class="grid-row">
                <?php } ?>
                <div class="grid hero-content <?php
                echo $heroSettings['content_width'] . ' ' .
                    $heroSettings['hero_height'] . ' ' .
                    $heroSettings['layout'] . ' ' .
                    $heroSettings['grid_gap'] . ' ' .
                    $heroSettings['padding_top'] . ' ' .
                    $heroSettings['padding_bottom']; ?>">
                    <div class="<?php echo $heroSettings['text_colour']; ?>">
                        <?php echo $text; ?>
                    </div>
                </div>
                <div class="grid hero-media <?php
                echo $heroSettings['hero_width'] . ' ' .
                    $heroSettings['hero_height'] . ' ' .
                    $heroSettings['overlay'] . ' ' .
                    $heroSettings['overlay_type'] . ' ' .
                    $heroSettings['opacity'] . ' ' .
                    $heroSettings['blend_mode']; ?>">
                    <?php
                    if (get_row_layout() == 'video'):
                        $video = get_sub_field('video', FALSE);
                        $v = parse_video_uri($video);
                        $vid = $v['id'];
                        ?>
                        <div id="hero-player" class="plyr__video-embed video">
                            <iframe
                                    src="https://youtube.com/embed/<?php echo $vid; ?>?origin=<?php echo home_url(); ?>/&amp;iv_load_policy=3&amp;modestbranding=1&amp;playsinline=1&amp;showinfo=0&amp;rel=0&amp;enablejsapi=1"
                                    allowtransparency
                                    allow="autoplay"
                                    title=""
                                    width="100%"
                                    height="800px"
                            ></iframe>
                        </div>
                    <?php

                    elseif (get_row_layout() == 'image'):
                        $image = get_sub_field('image'); ?>
                        <img class="hero-banner"
                             src="<?php echo wp_get_attachment_image_url($image['id'], 'extraLarge') ?>"
                             srcset="<?php echo wp_get_attachment_image_srcset($image['id'], 'extraLarge') ?> 1920w,
                                <?php echo wp_get_attachment_image_srcset($image['id'], 'large') ?> 1536w,
                                <?php echo wp_get_attachment_image_srcset($image['id'], 'mediumLarge') ?> 768w,
                                <?php echo wp_get_attachment_image_srcset($image['id'], 'medium') ?> 576w,
                                <?php echo wp_get_attachment_image_srcset($image['id'], 'small') ?> 384w,"
                             sizes="100vw"
                             alt="<?php echo $image['alt']; ?>"
                        />
                    <?php
                        // Do something...

                    endif;
                    ?>
                </div>
                <?php if ($numrows > 1) { ?>
                    </div>
                <?php } ?>
            <?php
                // End loop.
            endwhile; ?>
            <?php if ($numrows > 1){ ?>
        </div>
    <?php } ?>
    </section>
<?php
// No value.
else :
    // Do something...
endif;

//if ($heroSlides) {
//    ?>
    <!--    <section id="hero" class="grid-row ">-->
    <!--        --><?php
//        $numrows = count($heroSlides);
//        if ($numrows > 1){ ?>
    <!--        <div class="grid align-full slider"> --><?php //} ?>
    <!--            --><?php
//
//            foreach ($heroSlides as $contentKey => $heroBlock) {
//
//                ?>
    <!--                --><?php //if ($numrows > 1) { ?><!-- <div> --><?php //} ?>
    <!--                <div class="grid hero-content --><?php
    //                echo $heroSettings['content_width'] . ' ' .
    //                    $heroSettings['hero_height'] . ' ' .
    //                    $heroSettings['layout'] . ' ' .
    //                    $heroSettings['grid_gap'] . ' ' .
    //                    $heroSettings['padding_top'] . ' ' .
    //                    $heroSettings['padding_bottom']; ?><!--">-->
    <!---->
    <!--                    <div class="--><?php //echo $heroSettings['text_colour']; ?><!--">-->
    <!--                        --><?php //echo $heroBlock['slide_text']; ?>
    <!--                    </div>-->
    <!---->
    <!--                </div>-->
    <!--                <div class="grid hero-media-->
    <!--                --><?php
    //                echo $heroSettings['hero_width'] . ' ' .
    //                    $heroSettings['hero_height'] . ' ' .
    //                    $heroSettings['overlay'] . ' ' .
    //                    $heroSettings['overlay_type'] . ' ' .
    //                    $heroSettings['opacity'] . ' ' .
    //                    $heroSettings['blend_mode']; ?><!--">-->
    <!--                    --><?php
//                    switch ($heroBlock['acf_fc_layout']) {
//
//                        case 'video' :
//                            ?><!----><?php
//                            $youtube_video_url = get_sub_field('video', false, false);
////                            $video = get_sub_field('video', false, false);
//                            var_dump($youtube_video_url);
//                            ?>
    <!--                            <div class="video">-->
    <!--                                <iframe id="iframe"-->
    <!--                                        src=""-->
    <!--                                        allowtransparency-->
    <!--                                        allow="autoplay"-->
    <!--                                        title="{{ providerName }}"-->
    <!--                                        width="100%"-->
    <!--                                        height="800px"-->
    <!--                                ></iframe>-->
    <!--                            </div>-->
    <!--                            --><?php
//                            break;
//
//                        case 'image' :
//                            if ($heroBlock['image']) {
//                                ?>
    <!--                                <img class="hero-banner"-->
    <!--                                     src="--><?php //echo wp_get_attachment_image_url($heroBlock['image']['id'], 'extraLarge') ?><!--"-->
    <!--                                     srcset="--><?php //echo wp_get_attachment_image_srcset($heroBlock['image']['id'], 'extraLarge') ?><!-- 1920w,-->
    <!--                                            --><?php //echo wp_get_attachment_image_srcset($heroBlock['image']['id'], 'large') ?><!-- 1536w,-->
    <!--                                            --><?php //echo wp_get_attachment_image_srcset($heroBlock['image']['id'], 'mediumLarge') ?><!-- 768w,-->
    <!--                                            --><?php //echo wp_get_attachment_image_srcset($heroBlock['image']['id'], 'medium') ?><!-- 576w,-->
    <!--                                            --><?php //echo wp_get_attachment_image_srcset($heroBlock['image']['id'], 'small') ?><!-- 384w,-->
    <!--                                            "-->
    <!--                                     sizes="100vw"-->
    <!--                                     alt="--><?php //echo $heroBlock['image']['alt']; ?><!--"-->
    <!--                                />-->
    <!--                                --><?php
//                                break;
//                            }
//                    }
//                    ?>
    <!--                </div>-->
    <!--                --><?php //if ($numrows > 1) { ?><!-- </div> --><?php //} ?>
    <!--                --><?php
//
//
//            }
//
//
//            if ($numrows > 1){ ?><!-- </div> --><?php //} ?>
    <!--    </section>-->
    <!--    --><?php
//}