<?php

function wpaura_redirect_after_registration( $redirect_to )
{
	$wparua_registration_redirect_filter_enabled = get_option( "wparua_registration_redirect_enable" );

	if ( $wparua_registration_redirect_filter_enabled == 'on' )
	{
		if ( ! empty( get_option( "wparua_registration_redirect_filter" ) ) )
		{
			return get_option( "wparua_registration_redirect_filter" );
		}
	}

	return home_url();
}

add_filter( 'registration_redirect', 'wpaura_redirect_after_registration', 99, 3 );
