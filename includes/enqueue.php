<?php

add_action( "admin_enqueue_scripts", "wparua_enqueue_scripts" );

function wparua_enqueue_scripts()
{
	wp_enqueue_style ( "wparua_style_css", 	   WPARUA_PLUGIN_URL . "admin/assets/css/style.css", false );
	
	wp_enqueue_style ( "wparua_bootstrap_css", WPARUA_PLUGIN_URL . "admin/assets/css/bootstrap.css", false );
	
	wp_enqueue_script( "wparua_popper_js",     WPARUA_PLUGIN_URL . "admin/assets/js/popper.min.js", '' , true );
	
	wp_enqueue_script( "wparua_bootstrap_js",  WPARUA_PLUGIN_URL . "admin/assets/js/bootstrap.min.js", array( 'jquery', 'wparua_popper_js' ), '' , true );
	
	wp_enqueue_script( "wparua_script", 	   WPARUA_PLUGIN_URL . "admin/assets/js/script.js", array( 'jquery', 'jquery-ui-autocomplete' ), '' , true );
}
