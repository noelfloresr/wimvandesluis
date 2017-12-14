<?php 

// Add Shortcode
function load_team_function() {
	wp_enqueue_script( 'team', get_stylesheet_directory_uri() . '/src/js/team.js', array ( 'jquery' ), '1', false );
	ob_start();
	get_template_part('partials/team'); 
	return ob_get_clean();
}
add_shortcode( 'load_team', 'load_team_function' );