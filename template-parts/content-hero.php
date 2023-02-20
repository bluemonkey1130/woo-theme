<?php
if (is_shop()) {
    $page_id = wc_get_page_id('shop');
} else {
    $page_id = $post->ID;
}
$heroSlides = get_field('hero_slides', $page_id);
$heroSettings = get_field('hero_settings', $page_id);
//var_dump($heroSlides);
if ($heroSlides) {
    ?>

    <section id="hero" class="grid-row">
        <?php $numrows = count($heroSlides); ?>
        <?php if ($numrows > 1){ ?>
        <div class="grid <?php echo $heroSettings['hero_width']; ?> slider ">
            <?php } ?>
            <?php foreach ($heroSlides

                           as $slide) {

                $text = $slide['slide_text'];
                $slideOptions = $slide['slide_options'];
                ?>
                <?php if ($numrows > 1) { ?>
                    <div class="grid-row">
                <?php } ?>
                <div class="grid hero-content fadeIn <?php
                echo $heroSettings['content_width'] . ' ' .
                    $heroSettings['hero_height'] . ' ' .
                    $heroSettings['layout'] . ' ' .
                    $heroSettings['grid_gap'] . ' ' .
                    $heroSettings['padding_top'] . ' ' .
                    $slideOptions . ' ' .
                    $heroSettings['padding_bottom']; ?>">
                    <div class=" <?php echo $heroSettings['text_colour']; ?>">
                        <?php echo $text; ?>
                    </div>
                </div>
                <div class="grid hero-media <?php
                echo $heroSettings['hero_width'] . ' ' .
                    $heroSettings['hero_height'] . ' ' .
                    $heroSettings['overlay'] . ' ' .
                    $heroSettings['overlay_type'] . ' ' .
                    $heroSettings['opacity'] . ' ' .
                    $slideOptions . ' ' .
                    $heroSettings['blend_mode']; ?>">
                    <?php
                    switch ($slide['acf_fc_layout']) {
                        case 'video':
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
                            break;
                        case 'image':
                            $image = $slide['image'];
                            $imageCrop = $slide['image_crop'];
                            if ($imageCrop == 'original') {
                                ?>
                                <img id="original" class="hero-banner"
                                     src="<?php echo wp_get_attachment_image_url($image['id'], 'full') ?>"
                                     alt="<?php echo $image['alt']; ?>"
                                />
                                <?php
                            } elseif ($imageCrop != 'default') { ?>
                                <img id="not-default" class="hero-banner"
                                     src="<?php echo wp_get_attachment_image_url($image['id'], $imageCrop) ?>"
                                     alt="<?php echo $image['alt']; ?>"
                                />
                            <?php } else { ?>
<!--                                <img id="else" class="hero-banner"-->
<!--                                     src="--><?php //echo wp_get_attachment_image_url($image['id'], 'extraLarge') ?><!--"-->
<!--                                     srcset="--><?php //echo wp_get_attachment_image_url($image['id'], 'extraLarge') ?><!-- 1920w,-->
<!--                                    --><?php //echo wp_get_attachment_image_url($image['id'], 'mediumLarge') ?><!-- 1536w,-->
<!--                                    --><?php //echo wp_get_attachment_image_url($image['id'], 'mediumLarge') ?><!-- 768w,-->
<!--                                    --><?php //echo wp_get_attachment_image_url($image['id'], 'medium') ?><!-- 576w,-->
<!--                                    --><?php //echo wp_get_attachment_image_url($image['id'], 'small') ?><!-- 384w,"-->
<!--                                     sizes="100vw"-->
<!--                                     alt="--><?php //echo $image['alt']; ?><!--"-->
<!--                                />-->
                                <img id="else" class="hero-banner"
                                     src="<?php echo wp_get_attachment_image_url($image['id'], 'extraLarge') ?>"
                                     srcset="<?php echo wp_get_attachment_image_url($image['id'], 'extraLarge') ?> 1920w,
                                    <?php echo wp_get_attachment_image_url($image['id'], 'mediumLarge') ?> 1536w,
                                    <?php echo wp_get_attachment_image_url($image['id'], 'mediumLarge') ?> 768w,
                                    <?php echo wp_get_attachment_image_url($image['id'], 'medium') ?> 576w,
                                    <?php echo wp_get_attachment_image_url($image['id'], 'small') ?> 384w,"
                                     sizes="100vw"
                                     alt="<?php echo $image['alt']; ?>"
                                />
                                <?php
                            }
                            break;
                    }
                    ?>
                </div>
                <?php if ($numrows > 1) { ?>
                    </div>
                <?php } ?>
                <?php
            }

            ?>
            <?php if ($numrows > 1){ ?>
        </div>
    <?php } ?>
    </section>
<?php }
