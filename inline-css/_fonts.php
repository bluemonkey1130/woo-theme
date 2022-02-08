<?php
$fontImport = get_field('font_import', 'option');
$headingFont = get_field('heading_font', 'option');
$bodyFont = get_field('body_font', 'option');
$font = get_field('font_size', 'option');
$maxLineLength = get_field('max_line_length', 'option');
$customSizes = get_field('custom_sizes', 'option');
$fontSizes = get_field('font_sizes', 'option');

//dbug($headingFont);
?>
<style name="fonts">

    <?php echo $fontImport; ?>
    :root {
        --heading-font: <?php echo $headingFont['font_name']  ?>,<?php echo $headingFont['font_style']  ?>;
        --heading-weight: <?php echo $headingFont['font_weight'] ? $headingFont['font_weight'] : '700' ?>;
        --body-font: <?php echo $bodyFont['font_name'] ?>,<?php echo $bodyFont['font_style'] ?>;
        --body-weight: <?php echo $bodyFont['font_weight'] ? $bodyFont['font_weight'] : '700' ?>;
        --font-ratio: <?php echo $font ? $font : '1.3'; ?>;
        --max-character-length: <?php echo $maxLineLength ?>ch;

    }

    h1, h2, h3, h4, h5, h6 {
        line-height: <?php echo $headingFont['line_height'] ?  $headingFont['line_height'] : 1.2 ?>;
        margin-bottom: var(<?php echo $headingFont['spacing'] ?  $headingFont['spacing'] : '--s2' ?>);
    }

    p, ul, ol, blockquote, li {
        line-height: <?php echo $bodyFont['line_height'] ? $bodyFont['line_height'] : 1.2 ?>;
        margin-bottom: var(<?php echo $bodyFont['spacing'] ? $bodyFont['spacing'] : '--s1' ?>);
    }

    <?php if($customSizes == true){ ?>
    h1, .h1 {
        font-size: clamp(var(--f<?php echo $fontSizes['h1']['min_size'] ?>), <?php echo $fontSizes['h1']['preferred_size'] ?>, var(--f<?php echo $fontSizes['h1']['max_size'] ?>));
        font-family: var(--<?php echo $fontSizes['h1']['font_family'] ?>);
        line-height: <?php echo $fontSizes['h1']['line_height'] ?>;
    }

    <?php
    } ?>

</style>