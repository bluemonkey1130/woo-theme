<?php
/**
 * Template Name: Flexible Page
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
function removeWhitespace($buffer)
{
    return preg_replace('~>\s*\n\s*<~', '><', $buffer);
}

ob_start('removeWhitespace');
get_header();

?>
<main class="">

    <?php get_template_part('template-parts/content', 'hero'); ?>
    <?php get_template_part('template-parts/content', 'page-flex'); ?>

</main>
<?php //get_sidebar(); ?>
<?php get_footer();
ob_end_flush();
?>
