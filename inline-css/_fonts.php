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
        font-size: clamp(var(--f<?php echo $fontSizes['h1']['min'] ?>), <?php echo $fontSizes['h1']['preferred_size'] ?>, var(--f<?php echo $fontSizes['h1']['max'] ?>));
        font-family: var(--<?php echo $fontSizes['h1']['font_family'] ?>);
        line-height: <?php echo $fontSizes['h1']['line_height'] ?>;
    }

    h2, .h2 {
        font-size: clamp(var(--f<?php echo $fontSizes['h2']['min'] ?>), <?php echo $fontSizes['h2']['preferred_size'] ?>, var(--f<?php echo $fontSizes['h2']['max'] ?>));
        font-family: var(--<?php echo $fontSizes['h2']['font_family'] ?>);
        line-height: <?php echo $fontSizes['h2']['line_height'] ?>;
    }
    h3, .h3 {
        font-size: clamp(var(--f<?php echo $fontSizes['h3']['min'] ?>), <?php echo $fontSizes['h3']['preferred_size'] ?>, var(--f<?php echo $fontSizes['h3']['max'] ?>));
        font-family: var(--<?php echo $fontSizes['h3']['font_family'] ?>);
        line-height: <?php echo $fontSizes['h3']['line_height'] ?>;
    }
    h4, .h4 {
        font-size: clamp(var(--f<?php echo $fontSizes['h4']['min'] ?>), <?php echo $fontSizes['h4']['preferred_size'] ?>, var(--f<?php echo $fontSizes['h4']['max'] ?>));
        font-family: var(--<?php echo $fontSizes['h4']['font_family'] ?>);
        line-height: <?php echo $fontSizes['h4']['line_height'] ?>;
    }
    h5, .h6 {
        font-size: clamp(var(--f<?php echo $fontSizes['h']['min'] ?>), <?php echo $fontSizes['h5']['preferred_size'] ?>, var(--f<?php echo $fontSizes['h5']['max'] ?>));
        font-family: var(--<?php echo $fontSizes['h5']['font_family'] ?>);
        line-height: <?php echo $fontSizes['h5']['line_height'] ?>;
    }
    h6, .h6 {
        font-size: clamp(var(--f<?php echo $fontSizes['h6']['min'] ?>), <?php echo $fontSizes['h6']['preferred_size'] ?>, var(--f<?php echo $fontSizes['h6']['max'] ?>));
        font-family: var(--<?php echo $fontSizes['h6']['font_family'] ?>);
        line-height: <?php echo $fontSizes['h6']['line_height'] ?>;
    }
    p, .p {
        font-size: clamp(var(--f<?php echo $fontSizes['p']['min'] ?>), <?php echo $fontSizes['p']['preferred_size'] ?>, var(--f<?php echo $fontSizes['p']['max'] ?>));
        font-family: var(--<?php echo $fontSizes['p']['font_family'] ?>);
        line-height: <?php echo $fontSizes['p']['line_height'] ?>;
    }
    blockquote, .blockquote {
        font-size: clamp(var(--f<?php echo $fontSizes['blockquote']['min'] ?>), <?php echo $fontSizes['blockquote']['preferred_size'] ?>, var(--f<?php echo $fontSizes['blockquote']['max'] ?>));
        font-family: var(--<?php echo $fontSizes['blockquote']['font_family'] ?>);
        line-height: <?php echo $fontSizes['blockquote']['line_height'] ?>;
    }
    label, .label {
        font-size: clamp(var(--f<?php echo $fontSizes['label']['min'] ?>), <?php echo $fontSizes['label']['preferred_size'] ?>, var(--f<?php echo $fontSizes['label']['max'] ?>));
        font-family: var(--<?php echo $fontSizes['label']['font_family'] ?>);
        line-height: <?php echo $fontSizes['label']['line_height'] ?>;
    }

    <?php
    } ?>

</style>