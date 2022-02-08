<?php
/**
 * Created by PhpStorm.
 * User: georgehawthorne
 * Date: 15/02/2018
 * Time: 11:25
 */
//CLOSE ALL ACF FIELDS ON LOAD
function my_acf_admin_head()
{
    ?>

    <style type="text/css">

        [data-layout="grid_layout"] > .acf-fc-layout-handle {
            background-color: #F04848 !important;
            color: white !important;
        }

        [data-layout="text"] > .acf-fc-layout-handle {
            background-color: #F09018 !important;
            color: white !important;
        }
        [data-layout="image"] > .acf-fc-layout-handle {
            background-color: #18A8F0 !important;
            color: white !important;
        }
        label svg {
            width:100px;
        }
        label svg .cls-1 {
            fill: black;
        }
        label.selected svg .cls-1 {
            fill: white;
        }


    </style>


<!--    <script type="text/javascript">-->
<!--        (function ($) {-->
<!---->
<!--            $(document).ready(function () {-->
<!---->
<!--                $(".layout").each(function (index) {-->
<!--                    if (!$(this).hasClass('-collapsed')) {-->
<!--                        $(this).find('.acf-fc-layout-controlls').children('.-collapse').click();-->
<!--                    }-->
<!--                });-->
<!---->
<!---->
<!--            });-->
<!--            acf.add_filter('color_picker_args', function( args, field ){-->
<!---->
<!--                // do something to args-->
<!--                args.palettes = ['#7FCE5C', '#FFC500', '#F99500', '#CB267D', '#4F3584','#2492D3']-->
<!---->
<!---->
<!--                // return-->
<!--                return args;-->
<!---->
<!--            });-->
<!---->
<!--        })(jQuery);-->
<!---->
<!--    </script>-->
    <?php
}

add_action('acf/input/admin_head', 'my_acf_admin_head');


/*************************************************************/
/*   Friendly Block Titles                                  */
/***********************************************************/

function my_layout_title($title, $field, $layout, $i)
{
    if ($value = get_sub_field('admin_label')) {
        return $value;
    } else {
        foreach ($layout['sub_fields'] as $sub) {
            if ($sub['name'] == 'admin_label') {
                $key = $sub['key'];
                if (array_key_exists($i, $field['value']) && $value = $field['value'][$i][$key])
                    return $value;
            }
        }
    }
    return $title;
}

//add_filter('acf/fields/flexible_content/layout_title', 'my_layout_title', 10, 4);

/* TINY MCE FORMAT */

if ( ! function_exists( '_filter_mce_theme_format_insert_button' ) ) :
    function _filter_mce_theme_format_insert_button( $buttons ) {
        array_unshift( $buttons, 'styleselect' );

        return $buttons;
    } //_filter_mce_theme_format_insert_button()
endif;
add_filter( 'mce_buttons_2', '_filter_mce_theme_format_insert_button' );


function my_mce_before_init_insert_formats( $init_array ) {
    $style_formats = array(
        array(
            'title' => 'Text Styles',
            'items' => array(
                array(
                    'title' => 'Body Font',
                    'inline' => 'span',
                    'classes' => 'body-font'
                ),
                array(
                    'title' => 'Heading Font',
                    'inline' => 'span',
                    'classes' => 'heading-font'
                ),
            )
        ),
        array(
            'title' => 'Text Colour',
            'items' => array(
                array(
                    'title' => 'Green',
                    'inline' => 'span',
                    'classes' => 'pistachio-c '
                ),
                array(
                    'title' => 'Yellow',
                    'inline' => 'span',
                    'classes' => 'supernova-c'
                ),
                array(
                    'title' => 'Orange',
                    'inline' => 'span',
                    'classes' => 'pizazz-c'
                ),
                array(
                    'title' => 'Pink',
                    'inline' => 'span',
                    'classes' => 'cerise-c '
                ),
                array(
                    'title' => 'Dark Purple',
                    'inline' => 'span',
                    'classes' => 'minsk-c'
                ),
                array(
                    'title' => 'Blue',
                    'inline' => 'span',
                    'classes' => 'curious-blue-c'
                ),
            )
        ),
        array(
            'title' => 'Text Spacings',
            'items' => array(
                array(
                    'title' => 'Remove Margin',
                    'wrapper' => true,
                    'block' => 'div',
                    'classes' => 'no-margin'
                ),
            )
        ),
        array(
            'title' => 'Buttons',
            'items' => array(
                array(
                    'title' => 'Black Button',
                    'wrapper' => true,
                    'inline' => 'span',
                    'classes' => 'button black'
                ),
                array(
                    'title' => 'White Button',
                    'wrapper' => true,
                    'inline' => 'span',
                    'classes' => 'button white'
                ),
                array(
                    'title' => 'Green Button',
                    'wrapper' => true,
                    'inline' => 'span',
                    'classes' => 'button pistachio'
                ),
                array(
                    'title' => 'Yellow Button',
                    'wrapper' => true,
                    'inline' => 'span',
                    'classes' => 'button supernova'
                ),
                array(
                    'title' => 'Orange Button',
                    'wrapper' => true,
                    'inline' => 'span',
                    'classes' => 'button pizazz'
                ),
                array(
                    'title' => 'Pink Button',
                    'wrapper' => true,
                    'inline' => 'span',
                    'classes' => 'button cerise'
                ),
                array(
                    'title' => 'Purple Button',
                    'wrapper' => true,
                    'inline' => 'span',
                    'classes' => 'button minsk'
                ),
                array(
                    'title' => 'Blue Button',
                    'wrapper' => true,
                    'inline' => 'span',
                    'classes' => 'button curious-blue'
                ),
            )
        )
    );

    $init_array['style_formats'] = json_encode( $style_formats );

    return $init_array;
}

add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' );

// Method 1: Filter.
function my_acf_google_map_api( $api ){
    $api['key'] = 'AIzaSyDNIVftYn5q6tPwVlNhQ5NCN1dEaqGfhyA';
    return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');