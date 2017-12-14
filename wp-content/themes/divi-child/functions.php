<?php


//include get_stylesheet_directory() . '/includes/post_types.php'; // Post types
//include get_stylesheet_directory() . '/includes/custom_fields_group.php'; // ACF fields
//include get_stylesheet_directory() . '/includes/custom_shortcodes.php'; // Shortcodes

add_action( 'wp_enqueue_scripts', 'child_theme_assets' );

function child_theme_assets() {

    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    //wp_enqueue_style( 'parallax_theme_styles', get_stylesheet_directory_uri() . '/dist/css/jquery.fullpage.css');
    wp_enqueue_style('font-awesome', get_stylesheet_directory_uri() . '/dist/css/font-awesome.min.css');
    wp_enqueue_style( 'child_theme_styles', get_stylesheet_directory_uri() . '/dist/css/main.css');

    //wp_enqueue_script( 'parallax_theme_scripts', get_stylesheet_directory_uri() . '/dist/js/jquery.fullpage.extensions.min.js', array('jquery'), '1', true);
    wp_enqueue_script( 'sofyshare_theme_scripts', get_stylesheet_directory_uri() . '/dist/js/sofyshare.js', array('jquery'), '1', true); 
    wp_enqueue_script( 'child_theme_scripts', get_stylesheet_directory_uri() . '/dist/js/scripts.min.js', array('jquery'), '1', true); 
    // to add external fonts
    //wp_enqueue_style( 'external-font', 'https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800|Roboto+Condensed:300,400,700', false );

}

function add_query_vars_filter( $vars ){
  $vars[] = "term_id";
  return $vars;
}
add_filter( 'query_vars', 'add_query_vars_filter' );


/*
*   Load Theme Core 
*/
require 'core/init.php';