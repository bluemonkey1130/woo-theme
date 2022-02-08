<?php
//class IBenic_Walker extends Walker_Nav_Menu {
//
//    // Displays start of an element. E.g '<li> Item Name'
//    // @see Walker::start_el()
//    function start_el(&$output, $item, $depth=0, $args=array(), $id = 0) {
//        $object = $item->object;
//        $type = $item->type;
//        $title = $item->title;
//        $description = $item->description;
//        $permalink = $item->url;
//
//        $output .= "<li class='" .  implode(" ", $item->classes) . "'>";
//
//        //Add SPAN if no Permalink
//        if( $permalink && $permalink != '#' ) {
//            $output .= '<a href="' . $permalink . '">';
//        } else {
//            $output .= '<span>';
//        }
//
//        $output .= $title;
//
//        if( $description != '' && $depth == 0 ) {
//            $output .= '<small class="description">' . $description . '</small>';
//        }
//
//        if( $permalink && $permalink != '#' ) {
//            $output .= '</a>';
//        } else {
//            $output .= '</span>';
//        }
//    }
//}
/*--------------------------------------------------
    Custom SixthStory navwalker
--------------------------------------------------*/
function remove_wp_ul($menu){return preg_replace( array( '#^<ul[^>]*>#', '#</ul>$#' ), '', $menu );}
add_filter( 'wp_nav_menu', 'remove_wp_ul' );
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Theme_Walker extends Walker {

    var $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );

    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

        global $wp_query;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        $class_names = $value = '';
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;

        // remove unnecessary classes
        $classes = \array_diff($classes, ["menu-item-type-custom", "menu-item-object-custom", "current_page_item", "menu-item-home"]);

        // apply class names
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

        $output .= $indent . '<div' . $id . $value . $class_names .'>';

        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }

    function end_el( &$output, $item, $depth = 0, $args = array() ) {
        $output .= "</div>\n";
    }

    // Sub Menu
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class='sub-menu'>\n";
    }

    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }
}
