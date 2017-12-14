<?php

/**
 * Register all post types and taxonomies in this file.
 */	


	/**
	 * Post Type: Team members.
	 */
function cptui_register_my_cpts_team() {	

	$labels = array(
		"name" => __( 'Team members', '' ),
		"singular_name" => __( 'Team member', '' ),
		"add_new" => __( 'Add new team member', '' ),
		"add_new_item" => __( 'Add new team member', '' ),
		"edit_item" => __( 'Edit team Member', '' ),
		"new_item" => __( 'New team member', '' ),
		"view_item" => __( 'View team member', '' ),
		"view_items" => __( 'View team members', '' ),
		"search_items" => __( 'Search team member', '' ),
		"not_found" => __( 'No team member found', '' ),
		"featured_image" => __( 'Team member picture', '' ),
		"set_featured_image" => __( 'Set team member picture', '' ),
		"remove_featured_image" => __( 'Remove team member picture', '' ),
		"items_list" => __( 'Team members list', '' ),
		"attributes" => __( 'Team member attributes', '' ),
	);

	$args = array(
		"label" => __( 'Team members', '' ),
		"labels" => $labels,
		"description" => "Team members",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "team", "with_front" => true ),
		"query_var" => true,
		"menu_icon" => "dashicons-businessman",
		"supports" => array( "title", "editor", "thumbnail" ),
	);

	register_post_type( "team", $args );
}

add_action( 'init', 'cptui_register_my_cpts_team' );


?>