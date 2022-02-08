<?php
function removeWhitespace($buffer)
{
    return preg_replace('~>\s*\n\s*<~', '><', $buffer);
}

ob_start('removeWhitespace');
get_header();
get_template_part('template-parts/content', 'hero');
get_template_part('template-parts/content', 'page-flex');

/* Start the Loop */
while (have_posts()) :
    the_post();
    get_template_part('template-parts/content/content-page');
endwhile; // End of the loop.

get_footer();
ob_end_flush();
