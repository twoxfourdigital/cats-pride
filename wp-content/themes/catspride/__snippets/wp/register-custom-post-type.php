<?php

function catspride_register_post_type() {
    $singular = 'Custom post type name'; // Book
	$plural = 'Custom post type names';  // Books
	
    $slug = str_replace( ' ', '-', strtolower( $singular ) );

    $labels = array(
        'name' 			      => __( $plural, 'catspride' ),
        'singular_name' 	  => __( $singular, 'catspride' ),
        'add_new' 		      => _x( 'Add New', 'catspride', 'catspride' ),
        'add_new_item'  	  => __( 'Add New ' . $singular, 'catspride' ),
        'edit'		          => __( 'Edit', 'catspride' ),
        'edit_item'	          => __( 'Edit ' . $singular, 'catspride' ),
        'new_item'	          => __( 'New ' . $singular, 'catspride' ),
        'view' 			      => __( 'View ' . $singular, 'catspride' ),
        'view_item' 		  => __( 'View ' . $singular, 'catspride' ),
        'search_term'   	  => __( 'Search ' . $plural, 'catspride' ),
        'parent' 		      => __( 'Parent ' . $singular, 'catspride' ),
        'not_found'           => __( 'No ' . $plural .' found', 'catspride' ),
        'not_found_in_trash'  => __( 'No ' . $plural .' in Trash', 'catspride' ),
    );

    $args = array(
        'labels'              => $labels,
        'hierarchical'        => false,
        'public'              => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'has_archive'         => true,
        'rewrite'             => array('slug' => $slug),
        'menu_icon'           => '',
        'supports'            => array( 'title', 'thumbnail', 'editor' )
    );

    register_post_type( $slug, $args );
}

add_action( 'init', 'catspride_register_post_type' );