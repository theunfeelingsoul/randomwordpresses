<?php
/**
 * Function to get menus and submenus
 * 
 * */
function getMenuandSubmenus(){

	$menu_name = 'primary'; // name of the menu you want to show

	if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
	    $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
	    $menu_items = wp_get_nav_menu_items( $menu->term_id );
	    // the function that actually gets the menus
	    $menu_items_tree = get_menu_items_recursive( $menu_items ); 

	    // format the output
	    $menu_list = '<div class="navbar-nav ms-auto py-0 "id="menu-' . $menu_name . '">';

		    foreach ( (array) $menu_items_tree as $key => $menu_item ) {
		    	// check if the menu has a submenu
		        if (!empty($menu_item->children)) {
				        $title = $menu_item->title;
				        $url = $menu_item->url;
				        $menu_list .= '<div class="nav-item dropdown">';
					        $menu_list .= '<a href="' . $url . '" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">' . $title . '</a>';
					        $menu_list .= '<div class="dropdown-menu m-0">';
					        	// iterate through the children
					        	foreach ($menu_item->children as $childkey => $childvalue) {
							        $menu_list .= '<a href="' . $childvalue->url . '" class="dropdown-item">' . $childvalue->title . '</a>';
					        	}
					        $menu_list .= '</div>';
				        $menu_list .= '</div>';
		        }else{
		        	// else just display a normal menu
		        	$title = $menu_item->title;
			        $url = $menu_item->url;
			        $menu_list .= '<a href="' . $url . '" class="nav-item nav-link">' . $title . '</a>';
		        }
		     
		    }

		echo $menu_list .= '</div>';
	}
}

?>
