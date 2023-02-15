<?php
/**
 * Displays the site header.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */
$ribbon = get_field('ribbon', 'option');
$headerSettings = get_field('header_settings', 'option');
$headerBuilder = get_field('header_builder', 'option');

if ($ribbon) { ?>
    <div class="header-ribbon">
        <?php foreach ($ribbon as $key => $block) {
            switch ($block['type']){
                case 'text':
                    ?> <p><?php echo $block['ribbon_text']; ?></p> <?php
                    break;
                case 'tel':
                    ?> <a class="tel" href="tel:<?php echo $block['ribbon_text']; ?>"><span></span><?php echo $block['ribbon_text']; ?></a> <?php
                    break;
            }
        } ?>
    </div>
    <style>
        @media screen and (min-width: 767px) {
            #header{
                top:35px;
            }
        }

    </style>
<?php } ?>
<header id="header" class="header <?php echo $headerSettings['position'] ?>">
    <script type="text/javascript">
        var mobileBreakpoint = '<?php echo $headerSettings['mobile_navigation'] ? $headerSettings['mobile_navigation'] : 767 ?>';
        var headerPosition = '<?php echo $headerSettings['position'] ? $headerSettings['position'] : 'align-wide' ?> ';
    </script>
    <style>
        @media screen and (min-width: <?php echo $headerSettings['mobile_navigation']  ?>px) {
            header .grid-row .grid nav {
                display: inherit !important;
            }

        }

        @media screen and (max-width: <?php echo $headerSettings['mobile_navigation'] ; ?>px) {
            header.active section {
                padding-bottom: var(--s2);
            }

            header .grid-row .grid {
                display: grid;
                grid-template-rows: repeat(auto-fit, minmax(5px, auto));
                grid-template-columns: repeat(3, minmax(5px, auto));
                align-content: start;
                gap: 0;
            }

            header .grid-row .grid nav {
                display: none;
                flex-direction: column;
                grid-row: auto;
                grid-column: 1 / span 3;
                height: 100%;
                gap: 0;
            }
            header .grid-row .grid .search {
                display: none;
            }
            header .grid-row .grid .header-cart {
                display: none;
            }

            header .grid-row .grid .logo {
                grid-row: 1;
            }

            header .grid-row .grid button {
                grid-row: 1;
            }

            header .grid-row .grid nav:nth-last-child(1) {

            }

            header .grid-row .grid nav .nav-link {
                justify-content: space-between;
                font-size: var(--f1);
                grid-template-rows: auto auto;
                grid-template-columns: auto auto;
                display: grid;
                border-bottom: 1px solid var(--light-main);
            }


            header#header .grid-row nav div.nav-link > a {
                grid-row: 1;
                grid-column: 1 / span 1;
                justify-content: flex-start;
                justify-self: flex-start;
                padding: var(--s1) 0;
            }

            header .grid-row nav div.nav-link button {
                grid-row: 1;
                grid-column: 2 / span 2;
                justify-content: flex-end;
                justify-self: flex-end;
            }


            header .grid-row nav div.nav-link:hover ul.sub-nav {
                position: relative;
            }

            #menu-icon {
                grid-column: 3;
            }

            #menu-icon, #contact-icon {
                display: inline-flex !important;
            }

            header .button {
                display: none !important;
            }

            header .logo {
                max-width: 300px;
                align-self: center;
                justify-self: center;
                display: flex;
                padding: 0!important;
            }
            #mobile-menu .search{
                margin: 0 auto;
            }
            .header-cart i{
                display: flex;
                align-items: center;
                margin-right: 5px;
            }
            .header-cart{
                position: absolute;
                top: 35px;
                left: calc(var(--s2) + 10px);
                width: 50px;
                font-size: var(--f4);
                display: inline-flex;
                justify-content: center;
                text-decoration: none;
            }
        }
        @media screen and (max-width: 480px) {
            header .grid-row .logo{
                max-width: 110px!important;
            }
            header .grid-row .grid {
                grid-column-start: 2;
                grid-column-end: 26;
            }
        }
    </style>
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
                                <a href="<?php echo home_url(); ?>" class="logo centreCentre
                                <?php echo $block['padding']['padding_top'] . ' ' . $block['padding']['padding_bottom'] . ' ' . ' ' . $block['padding']['padding_left'] . ' ' . ' ' . $block['padding']['padding_right'] . ' ' ?>"
                                   style="flex: 1 1 <?php echo $block['width'] ?>%; max-width: <?php echo $block['max_width'] ?>px; min-width: <?php echo $block['min_width'] ?>px">
                                    <figure>
                                        <?php echo wp_get_attachment_image($block['logo']['id'], 'thumbnail', false, ["class" => "", "alt" => $block['logo']['alt']]); ?>
                                    </figure>
                                </a>
                            <?php } else { ?>
                                <h2 class="logo" role="banner">
                                    <a class="hdr-logo-link" href="<?php echo home_url(); ?>"
                                       rel="home"><?php echo get_bloginfo('name'); ?></a>
                                </h2>
                            <?php } ?>
                            <?php break;
                        case 'cta_block': ?>

                            <a class="button <?php echo $block['button_style'] . ' ' . $block['button_colour'] ?>"
                               style="flex: 1 1 <?php echo $block['width'] ?>%;"
                               href="<?php echo $block['button']['url'] ?>"
                               target="<?php echo $block['button']['target'] ?>"><?php echo $block['button']['title']; ?></a>
                            <?php break;
                        case 'cart': ?>
                            <?php global $woocommerce; ?>
                            <a class="header-cart"
                               href="<?php echo wc_get_cart_url(); ?>"
                               title="<?php _e('Cart View', 'woothemes'); ?>">
                                <i class="fas fa-shopping-cart"></i>
                                <?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'woothemes'),
                                    $woocommerce->cart->cart_contents_count); ?>
                            </a>
                            <?php break;
                        case 'search': ?>
                            <div class="search">
                                <?php echo get_search_form(); ?>
                                <i class="fas fa-search"></i>
                            </div>
                            <?php break;
                        default;
                    }
                }
            }
            ?>

            <button id="menu-icon">
                <span></span>
            </button>

        </div>
    </div>
</header><!-- #masthead -->


<div id="mobile-menu">
    <div id="close">
        <span></span>
    </div>
    <div class="search">
        <?php echo get_search_form(); ?>
        <i class="fas fa-search"></i>
    </div>
    <?php global $woocommerce; ?>
    <a class="header-cart"
       href="<?php echo wc_get_cart_url(); ?>"
       title="<?php _e('Cart View', 'woothemes'); ?>">
        <i class="fas fa-shopping-cart"></i>
        <?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'woothemes'),
            $woocommerce->cart->cart_contents_count); ?>
    </a>
    <nav id="nav-main" class="mobile-nav"
         role="navigation">
        <div class="menu-item">
            <a href="<?php echo home_url() ?>">Home</a>
        </div>
        <?php
        wp_nav_menu(array(
            'container' => false,
            'theme_location' => 'main-menu',
            'walker' => new Theme_Walker()
        ));
        ?>
    </nav>

</div>
