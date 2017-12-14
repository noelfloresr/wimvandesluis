<?php

if ( ! function_exists( 'child_theme_settings' ) ) :

function child_theme_settings() {

    // register others menus
    register_nav_menus( array(
      'login_nav' => __( 'Login Navigation', 'child-theme' ),
      'footer_bottom_nav' => __( 'Footer Bottom Navigation', 'child-theme' )
    ) );

}

endif;
add_action( 'after_setup_theme', 'child_theme_settings' );



// quitando rest api
// add_filter( 'rest_authentication_errors', 'DRA_only_allow_logged_in_rest_access' );
// /**
//  * Returning an authentication error if a user who is not logged in tries to query the REST API
//  * @param $access
//  * @return WP_Error
//  */
// function DRA_only_allow_logged_in_rest_access( $access ) {
//     if( ! is_user_logged_in() ) {
//         return new WP_Error( 'rest_cannot_access', __( 'Only authenticated users can access the REST API.', 'disable-json-api' ), array( 'status' => rest_authorization_required_code() ) );
//     }
//     return $access;
// }