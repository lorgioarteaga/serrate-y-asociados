<?php
// integramos el modulo de eventos
include('eventos/index.php');
/******************************************************
	Funciones adicionales y muy utiles
*******************************************************/

/* function security */
remove_action( 'load-update-core.php', 'wp_update_plugins' ); 
add_filter( 'pre_site_transient_update_plugins', create_function( '$a', "return null;" ) ); 
remove_action('wp_head', 'wp_generator'); 

function failed_login() {
    return 'Review  your  data  enter.';
}
add_filter('login_errors', 'failed_login');

// remove wp version param from any enqueued scripts
function vc_remove_wp_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' . get_bloginfo( 'version' ) ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
add_filter( 'style_loader_src', 'vc_remove_wp_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'vc_remove_wp_ver_css_js', 9999 );


function _print($data,$hide=false){
	$style='';
	if($hide)
		$style=' style="display:none"';
		
	echo '<pre'.$style.'>';print_r($data);echo '</pre>';
}
function _get_post_meta($post_id, $key,$default=''){
	return (get_post_meta($post_id, $key, true)) ? get_post_meta($post_id, $key, true) : $default;
}
/* filtro what allow  run shortcode in the  widget text*/
add_filter('widget_text', 'do_shortcode');