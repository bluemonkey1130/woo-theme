<!DOCTYPE html>
<html <?php language_attributes(); ?> class="<?php echo get_field('page_colour'); ?>">
<head>
    <?php
    $googleTagManagerOne = get_field('google_tag_manager_one', 'option');
    if ($googleTagManagerOne) {
        echo $googleTagManagerOne;
    }
    ?>
    <meta name="google-site-verification" content="S-dcv02iW1teDTHbGer3mPYm_q2F7PirTx20f4H1PQA"/>
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <meta name="viewport" content="width=device-width"/>
    <?php wp_head(); ?>
    <?php get_template_part('inline-css/_space'); ?>
    <?php get_template_part('inline-css/_fonts'); ?>
    <?php get_template_part('inline-css/_colour'); ?>
    <?php get_template_part('inline-css/_button'); ?>
    <script src="https://cdn.plyr.io/3.6.12/plyr.js"></script>
    <link rel="stylesheet" href="https://cdn.plyr.io/3.6.12/plyr.css" />

</head>
<?php
$post = get_queried_object();
?>
<body <?php body_class(); ?>>
<?php get_template_part('template-parts/header/content-header'); ?>