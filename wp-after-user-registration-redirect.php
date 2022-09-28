<?php
/*
Plugin Name: After Registration Redirect
Plugin URI : https://wordpress.org/plugins/wp-after-registration-redirect-user-advanced/
Description: Redirect User After Registration To Any Page You Select.
Version: 1.0.2
Author: Sajjad Hossain Sagor
Author URI: https://profiles.wordpress.org/sajjad67
Text Domain: wpaura

License: GPL2
This WordPress Plugin is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

This free software is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this software. If not, see http://www.gnu.org/licenses/gpl-2.0.html.
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// ---------------------------------------------------------
// Define Plugin Folders Path
// ---------------------------------------------------------
define( "WPARUA_PLUGIN_PATH", plugin_dir_path( __FILE__ ) );

define( "WPARUA_PLUGIN_URL", plugin_dir_url( __FILE__ ) );

add_action( "init", "wparua_add_plugin_core_file" );

function wparua_add_plugin_core_file()
{
	if( current_user_can( 'administrator' ) )
	{
		require_once WPARUA_PLUGIN_PATH . 'includes/enqueue.php';
		
		require_once WPARUA_PLUGIN_PATH . 'includes/functions.php';
		
		require_once WPARUA_PLUGIN_PATH . 'includes/dashboard.php';
	}
	
	require_once WPARUA_PLUGIN_PATH . 'public/redirect.php';
}
