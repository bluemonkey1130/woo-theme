<!DOCTYPE html>
<html <?php language_attributes(); ?> class="<?php echo get_field('page_colour'); ?>">
<head>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-PWV668X');</script>
    <!-- End Google Tag Manager -->

    <meta name="google-site-verification" content="S-dcv02iW1teDTHbGer3mPYm_q2F7PirTx20f4H1PQA"/>
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <meta name="viewport" content="width=device-width"/>
    <?php wp_head(); ?>
    <?php get_template_part('inline-css/_space'); ?>
    <?php get_template_part('inline-css/_fonts'); ?>
    <?php get_template_part('inline-css/_colour'); ?>
    <?php get_template_part('inline-css/_button'); ?>
    <?php $headerSettings = get_field('header_settings', 'option'); ?>

<!--    <script src="--><?php //echo get_template_directory_uri(); ?><!--/assets/scripts.min.js"></script>-->


</head>
<?php
$post = get_queried_object();
?>
<body <?php body_class(); ?>>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PWV668X"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<?php get_template_part('template-parts/header/content-header'); ?>