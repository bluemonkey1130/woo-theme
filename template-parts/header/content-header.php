<?php
/**
 * Displays the site header.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

$headerSettings = get_field('header_settings', 'option');
$headerBuilder = get_field('header_builder', 'option');

?>

<header class="header <?php echo $headerSettings['position'] ?>">
    <script type="text/javascript">
        var mobileBreakpoint = '<?php echo $headerSettings['mobile_navigation'] ? $headerSettings['mobile_navigation'] : 767 ?>';
        var headerPosition = '<?php echo $headerSettings['position'] ? $headerSettings['position'] : 'align-wide' ?> ';
    </script>
    <div class="grid-row <?php echo $headerSettings['background_colour']; ?>">
        <div class="grid <?php echo $headerSettings['width']; ?> <?php echo $headerSettings['gap']; ?>">
            <?php
            if ($headerBuilder > 0) {
                foreach ($headerBuilder as $key => $block) {
                    switch ($block['acf_fc_layout']) {
                        case 'navigation_block': ?>
                            <nav id="nav-main" class="nav-main
                                <?php echo $block['hover_style'] ?>
                                <?php echo $block['nav_orientation'] ?>
                                <?php echo $block['nav_gap'] ?>"
                                 role="navigation">
                                <?php
                                wp_nav_menu(array(
                                    'container' => false,
                                    'theme_location' => 'main-menu',
                                    'walker' => new Theme_Walker()
                                ));
                                ?>
                            </nav>
                            <?php break;
                        case 'logo_block': ?>
                            <?php if ($block['logo']) { ?>
                                <a href="<?php echo home_url(); ?>" class="logo centreCentre"
                                   style="">
                                    <figure>
                                        <?php echo wp_get_attachment_image($block['logo']['id'], 'thumbnail', false, ["class" => "", "alt" => $block['logo']['alt']]); ?>
                                    </figure>
                                </a>
                            <?php } else { ?>
                                <h2 class="logo" role="banner">
                                    <a class="hdr-logo-link" href="<?php echo home_url(); ?>" rel="home"><?php echo get_bloginfo('name'); ?></a>
                                </h2>
                            <?php } ?>
                            <?php break;
                        case 'cta_block': ?>
                            <a class="button <?php echo $block['button_style'] ? $block['button_style'] : '' ?> <?php $block['button_colour'] ? $block['button_colour'] : '' ?>"
                               style="flex: 1 1 <?php echo $block['width'] ?>%;"
                               href="<?php echo $block['button']['url'] ?>"
                               target="<?php echo $block['button']['target'] ?>"><?php echo $block['button']['title']; ?></a>
                            <?php break;
                        default;
                    }
                }
            }
            ?>


        </div>
    </div>
</header><!-- #masthead -->