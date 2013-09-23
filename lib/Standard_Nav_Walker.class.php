<?php
/**
 * Creates an HTML list of nav menu items that introduces multi-levels into Bootstrap 2.0 menus.
 *
 * @package		Standard
 * @subpackage	Standard_Nav_Walker
 * @version		1.0
 * @since 		3.0
 * @uses 		Walker
 */
class Standard_Nav_Walker extends Walker_Nav_Menu {

	/**
	 * Each time an element is the child of the prior element, this is called.
	 *
	 * @param	string   $output	The opening unordered list for the menu.
	 * @param	int      $depth	    The level of depth at which the menu is being called.
	 * @param	array    $args	    The arguments passed to be added to the menu item
	 * @version	1.0
	 * @since	3.0
	 */
	function start_lvl( &$output, $depth, $args ) {
		if($depth >= 1) {
			$output .= apply_filters( 'walker_nav_menu_start_lvl', '<ul class="dropdown-menu submenu-hide">', $depth, $args );
		} else {
			$output .= apply_filters( 'walker_nav_menu_start_lvl', '<ul class="dropdown-menu">', $depth, $args );
		} // end if/else
	} // end start_lvl

	/**
	 * Each time an individual element is processed, start_el is called.
	 *
	 * @param	string   $output     The actual menu item to output.
	 * @param	string   $item	     The menu item that's being processed.
	 * @param	int      $depth	     The level of depth at which this item is being written.
	 * @param	array    $args	     The arguments passed to be added to the menu item
	 * @version	1.0
	 * @since	3.0
	 */
	function start_el( &$output, $item, $depth, $args ) {
		
		$css_classes = implode( ' ', $item->classes );
		
		// If the target is specified, then let's add it to the anchor
		$target = isset( $item->target ) && '' != $item->target ? ' target="_blank" ' : '';
		
		// If a title was specified, let's add it to the anchor
		$title = '' == $item->attr_title ? 'title="' . $item->title . '"' : 'title="' . $item->attr_title . '"';
		
		// If the XFN was specified, add it to the anchor
		$xfn = '' == $item->xfn ? '' : 'rel="' . $item->xfn . '"';
		
		// If the current menu item has children, we need to set the proper class names on the list items
		// and the anchors. Parent menu items can't have blank targets.
		if( $args->has_children ) {
		
			if( $item->menu_item_parent == 0 ) {

				$menu_item = get_permalink() == $item->url ? '<li class="dropdown ' . $css_classes . '">' : '<li class="dropdown ' . $css_classes . '">';
					$menu_item .= '<a href="' . $item->url . '" class="dropdown-toggle" data-toggle="dropdown"' . ' ' . $title . ' ' . $xfn . ' ' . $target . '>';
					
			} else { 

				$menu_item = '<li class="dropdown submenu ' . $css_classes . '">';
					$menu_item .= '<a href="' . $item->url . '" class="dropdown-toggle" data-toggle="dropdown"' . ' ' . $title . ' ' . $xfn . ' ' . $target . '>';
					
			} // end if/else
		
		// Otherwise, it's business as usual.		
		} else {

			$menu_item = get_permalink() == $item->url ? '<li class="active ' . $css_classes . '">' : '<li class="' . $css_classes . '">';
				$menu_item .= '<a href="' . $item->url . '"' . ' ' . $title . ' ' . $xfn . ' ' . $target . '>';
					
		} // end if
		
		// Render the actual menu title
		$menu_item .= $item->title;
		
		// If the item has children, display the dropdown image
		if($args->has_children) {
			$menu_item .= '<b class="caret"></b>';
		} // end if
		
		// Close the anchor
		$menu_item .= '</a>';
		
		$output .= apply_filters ( 'nav_walker_start_el', $menu_item, $item, $depth, $args );

	} // end start_el

	/**
	 * Set a value in the element's arguments that allow us to determine if the current menu item has children.
	 *
	 * @param	array    $element			The element that's being evaluated.
	 * @param	array    $children_elements	The child elements of the incoming element.
	 * @param	int      $max_depth			The level of depth at which this item is being written.
	 * @param	int      $depth				Optional. The depth at which we can evaluate the children.
	 * @param	array    $args				The arguments applied to this elemenet.
	 * @param	string   $output			The current rendering of this element.
	 * @link 	http://wordpress.stackexchange.com/a/16821/1014 
	 * @version	1.0
	 * @since	3.0
	 */
	function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {
	
		$id_field = $this->db_fields['id'];
		if( is_object( $args[0] ) ) {
			$args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
		} // end if
		
		return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	
	} // end display_element
	
	/**
	 * Each time an element is processed, end_el is called after start_el
	 *
	 * @param	string   $output     The actual menu item to terminate.
	 * @param	int      $item	     The menu item that's being processed.
	 * @param	int      $depth	     The level of depth at which this item is being written.
	 * @param	array    $args	     The arguments passed to be added to the menu item
	 * @version	1.0
	 * @since	3.0
	 */
	function end_el( &$output, $item, $depth, $args ) {
		$output .= apply_filters( 'nav_walker_end_el', '</li>', $item, $depth, $args );
	} // end end_el
	
	/**
	 * Each time an element is no longer below on of the current parents, this is called.
	 *
	 * @param	string   $output	The actual menu item to terminate.
	 * @param	int      $depth	    The level of depth at which this item is being written.
	 * @param	array    $args	    The arguments passed to be added to the menu item
	 * @version	1.0
	 * @since	3.0
	 */
	function end_lvl( &$output, $depth, $args ) {
		$output .= apply_filters( 'nav_walker_end_lvl', '</ul>', $depth, $args );
	} // end end_lvl
	
} // end class