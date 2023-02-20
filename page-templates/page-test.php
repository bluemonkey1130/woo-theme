<?php
/**
 * Template Name: Test Page
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
    <section class="grid-row">
        <div class="grid narrow has-two-columns grid-gap-200 gap-top-200">
            <?php

            ?>
        </div>
    </section>
</main>
<?php //get_sidebar(); ?>
<?php get_footer();
ob_end_flush();
?>
