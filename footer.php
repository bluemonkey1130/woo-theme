<?php
$footerBuilder = get_field('footer_row', 'option');

?>
<footer>
    <?php
    if ($footerBuilder > 0) {
        foreach ($footerBuilder as $key => $block) {
            if ($block) {
                $settings = $block['row_settings'];
                $styling = $block['row_styling'];
                ?>
                <div class="grid-row <?php echo $settings['space_top'] . ' ' . $styling['row_colour'] . ' ' . $styling['padding_top'] . ' ' . $styling['padding_bottom']; ?>">
                    <div class="grid <?php echo $settings['width'] . ' ' . $settings['row_layout'] . ' ' . $settings['grid_gap']; ?>">
                        <?php
                        if ($block['blocks']){
                            foreach ($block['blocks'] as $key => $inner_block) {
                                switch ($inner_block['acf_fc_layout']) {
                                    case 'navigation': ?>
                                        <nav class="stack">
                                            <?php
                                            foreach ($inner_block['navigation'] as $nav_block) {
                                                ?>
                                                <a href="<?php echo $nav_block['link']['url'] ?>"><?php echo $nav_block['link_text'] ? $nav_block['link_text'] : $nav_block['link']['title'] ?></a>
                                                <?php
                                            }
                                            ?>
                                        </nav>
                                        <?php break;
                                    case 'affiliate' :
                                        $image = $inner_block['logo'];
                                        $imageCrop = $inner_block['image_crop'];
                                        $link = $inner_block['link'];
                                        ?>
                                        <figure>
                                            <?php if ($link) { ?>
                                                <a class="abs" href="<?php echo $link['url'] ?>"></a>
                                            <?php } ?>
                                            <?php echo wp_get_attachment_image($image['id'], $imageCrop, false, ["class" => "", "alt" => $image['alt']]); ?>
                                        </figure>
                                        <?php break;
                                    case 'text':
                                        $text = $inner_block['text'];
                                        ?>
                                        <div class="stack">
                                            <?php echo $text; ?>
                                        </div>
                                        <?php break;
                                    case 'spacer':
                                        $colSpan = $inner_block['col_span'];
                                        ?>
                                        <div class="spacer <?php echo $colSpan; ?>">
                                        </div>
                                        <?php break;
                                    default;
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
                <?php
            }

        }
    }
    wp_footer()
    ?>
</footer>

