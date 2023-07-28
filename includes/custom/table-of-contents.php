<?php

function generate_table_of_contents($page_id)
{
    $table_of_contents = '';

    $flexible_content = get_field('row',$page_id); // Replace 'flexible_content' with the name of your flexible content field group
    if (!empty($flexible_content)) {
        $table_of_contents .= '<div class="table-wrapper">';
        $table_of_contents .= '<nav role="navigation" class="table-of-contents">';
        $table_of_contents .= '<h3>Table of Contents</h3>';
        $table_of_contents .= '<ul role="menu" itemscope itemtype="https://schema.org/SiteNavigationElement">';

        foreach ($flexible_content as $flexible_row) {

            // Check if the row is a "grid_layout" flexible layout
            if ($flexible_row['acf_fc_layout'] == 'grid_layout') {
                // Loop through the "content" flexible layout within the "grid_layout" flexible layout
                $content_layout = $flexible_row['content'];
                if (!empty($content_layout)) {

                    foreach ($content_layout as $content_row) {
                        // Check if the row is a "text" flexible layout
                        if ($content_row['acf_fc_layout'] == 'text') {
                            $content = $content_row['text_content']; // Replace 'text_content' with the name of your WYSIWYG field
                            if (!empty($content)) {
                                $doc = new DOMDocument();
                                $doc->loadHTML($content);
                                $headings = [];
                                foreach ($doc->getElementsByTagName('h1') as $heading) {
                                    $headings[] = $heading;
                                }
                                foreach ($doc->getElementsByTagName('h2') as $heading) {
                                    $headings[] = $heading;
                                }
                                foreach ($doc->getElementsByTagName('h3') as $heading) {
                                    $headings[] = $heading;
                                }
                                foreach ($doc->getElementsByTagName('h4') as $heading) {
                                    $headings[] = $heading;
                                }
                                foreach ($doc->getElementsByTagName('h5') as $heading) {
                                    $headings[] = $heading;
                                }
                                foreach ($doc->getElementsByTagName('h6') as $heading) {
                                    $headings[] = $heading;
                                }
                                if (count($headings) > 0) {
                                    foreach ($headings as $heading) {
                                        $text = $heading->textContent;
                                        $anchor = strtolower(str_replace(' ', '-', $text));
                                        $table_of_contents .= '<li itemprop="name" role="menuitem"><a title="' . $text . '" itemprop="url" href="#' . $anchor . '">' . $text . '</a></li>';
                                    }
                                    break; // add this to exit the loop after the first occurrence of headings
                                }
                            }
                        }
                    }
                }
            }
        }
        $table_of_contents .= '</ul>';
        $table_of_contents .= '</nav>';
        $table_of_contents .= '</div>';
    }
    return $table_of_contents;
}