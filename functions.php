<?php

/****************************************************************************************/

/* Replace footer copyright statement w/ copyleft statement */
add_action( 'init', 'remove_copy' );
function remove_copy(){
    remove_action('spacious_footer_copyright', 'spacious_footer_copyright', 10);
}
add_action('spacious_footer_copyright', 'my_footer_info', 10);
function my_footer_info() {
    $my_footer_info = '<div class="copyright"><!--[if lte IE 8]><span style="filter: FlipH; -ms-filter: "FlipH"; display: inline-block;"><![endif]--><span style="-moz-transform: scaleX(-1); -o-transform: scaleX(-1); -webkit-transform: scaleX(-1); transform: scaleX(-1); display: inline-block;">©</span><!--[if lte IE 8]></span><![endif]--> CopyLeft, <a href="https://sudoroom.org/"><abbr>Sudo Room</abbr></a>, All Wrongs Reversed, <script type="text/javascript">var d = new Date(); var year = d.getFullYear(); document.write(year);</script>.</div>';
    echo do_shortcode( $my_footer_info );
}

/* Add flattr shortcode */
function flattr_func( $atts ){
    ob_start();
    the_flattr_permalink();
    return ob_get_clean();
}
add_shortcode( 'flattr', 'flattr_func' );

/* Adds login/logout menu item */

function add_login_logout_item_to_menu( $items, $args ){

    //change theme location with your them location name
    if( is_admin() ||  $args->theme_location != 'primary' )
        return $items;
    $redirect = ( is_home() ) ? network_home_url() : get_permalink();
    if( is_user_logged_in( ) )
        $link = '<a href="' . wp_logout_url( $redirect ) . '" title="' .  __( 'Logout' ) .'">' . __( 'Logout' ) . '</a>';
    else  $link = '<a href="' . wp_login_url( $redirect  ) . '" title="' .  __( 'Login' ) .'">' . __( 'Login' ) . '</a>';
    return $items.= '<li id="log-in-out-link" class="menu-item menu-type-link">'. $link . '</li>';
}
add_filter( 'wp_nav_menu_items', 'add_login_logout_item_to_menu', 50, 2 );

function add_login_logout_item_to_menu_footer( $items, $args ){

    //change theme location with your them location name
    if( is_admin() ||  $args->theme_location != 'footer' )
        return $items;
    $redirect = ( is_home() ) ? network_home_url() : get_permalink();
    if( is_user_logged_in( ) )
        $link = '<a href="' . wp_logout_url( $redirect ) . '" title="' .  __( 'Logout' ) .'">' . __( 'Logout' ) . '</a>';
    else  $link = '<a href="' . wp_login_url( $redirect  ) . '" title="' .  __( 'Login' ) .'">' . __( 'Login' ) . '</a>';
    return $items.= '<li id="log-in-out-link" class="menu-item menu-type-link">'. $link . '</li>';
}
add_filter( 'wp_nav_menu_items', 'add_login_logout_item_to_menu_footer', 50, 2 );



?>
