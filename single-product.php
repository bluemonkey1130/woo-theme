<?php
function removeWhitespace($buffer)
{
    return preg_replace('~>\s*\n\s*<~', '><', $buffer);
}

ob_start('removeWhitespace');
get_header();
get_template_part('template-parts/content', 'hero');

/* Start the Loop */
while (have_posts()) :
    the_post();
    get_template_part('template-parts/content/content-product');
    the_content();
endwhile; // End of the loop.
get_template_part('template-parts/content', 'page-flex');
get_footer();
ob_end_flush();
