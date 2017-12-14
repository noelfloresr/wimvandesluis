<?php
/*
Plugin Name: Divi Popup Maker Extension
Plugin URI: https://divi.space/product/divi-popup-extension
Description: Divi Integration & Custom Modules for the Popup Maker Plugin
Author: SJ James
Version: 1.0.0
Author URI: https://divi.space/
*/

function dpme_load_module(){
	if(class_exists("ET_Builder_Module")){
		include('trigger_module.php');
	}
}

add_action('et_builder_ready', 'dpme_load_module');

function dpme_load_stylesheet() {
    wp_enqueue_style('front-end-styles',  plugin_dir_url( __FILE__ ) . '/front_end.css');
}

add_action( 'wp_enqueue_scripts', 'dpme_load_stylesheet' );

function dpme_popup_post_type( $post_types ) {
    $post_types[] = 'popup';
    return $post_types;
}
add_filter( 'et_builder_post_types', 'dpme_popup_post_type' );