<?php

function _get_menu( $menu_id ) {

    return wp_nav_menu( array( 'theme_location' => $menu_id, 'menu_id' => $menu_id ) );

}