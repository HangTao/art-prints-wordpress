<?php
/**
 * Bootstrap Walker Navigation Menu
 * 
 * Custom walker for Bootstrap navbar integration
 *
 * @package Art_Prints_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Bootstrap_Walker_Nav_Menu extends Walker_Nav_Menu {

	/**
	 * Start Level
	 */
	public function start_lvl( &$output, $depth = 0, $args = null ) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}

		$indent = str_repeat( $t, $depth );

		// Add Bootstrap dropdown class
		$output .= "{$n}{$indent}<ul class=\"dropdown-menu\">{$n}";
	}

	/**
	 * Start Element
	 */
	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}

		$indent = ( $depth ) ? str_repeat( $t, $depth ) : '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'nav-item';

		// Add dropdown class if has children
		if ( in_array( 'menu-item-has-children', $classes ) ) {
			$classes[] = 'dropdown';
		}

		/**
		 * Filters the arguments of a menu item's list item element.
		 */
		$args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

		/**
		 * Filters the CSS class(es) applied to a menu item's list item element.
		 */
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		/**
		 * Filters the ID applied to a menu item's list item element.
		 */
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $class_names . '>';

		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target ) ? $item->target : '';
		$atts['rel']    = ! empty( $item->xfn ) ? $item->xfn : '';
		$atts['href']   = ! empty( $item->url ) ? $item->url : '';

		// Add dropdown toggle class and attribute
		if ( in_array( 'menu-item-has-children', $classes ) ) {
			$atts['class'] = 'nav-link dropdown-toggle';
			$atts['data-bs-toggle'] = 'dropdown';
			$atts['aria-expanded'] = 'false';
		} else {
			$atts['class'] = 'nav-link';
		}

		// Add active class if current menu item
		if ( in_array( 'current-menu-item', $classes ) || in_array( 'current-menu-parent', $classes ) ) {
			$atts['class'] .= ' active';
			$atts['aria-current'] = 'page';
		}

		/**
		 * Filters the HTML attributes applied to a menu item's anchor element.
		 */
		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value      = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		/** This filter is documented in wp-includes/post-template.php */
		$title = apply_filters( 'the_title', $item->title, $item->ID );

		/**
		 * Filters a menu item's title.
		 */
		$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

		$output .= '<a' . $attributes . '>';
		$output .= $args->link_before . $title . $args->link_after;
		$output .= '</a>';
	}
}
