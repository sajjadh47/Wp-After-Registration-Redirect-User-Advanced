<?php

if ( isset( $_POST['wparua_registration_redirect_filter_reset'] ) )
{
	if ( ! isset( $_POST['wparua_after_registration_redirect_filters_submit'] ) || ! wp_verify_nonce( $_POST['wparua_after_registration_redirect_filters_submit'], 'wparua_after_registration_redirect_filters_submit' ) )
	{
		function wparua_reset_nonce_error_message()
		{
			$class = 'notice notice-warning';
			
			$message = __( 'Sorry, your nonce did not verify.', 'wparua' );

			printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );
		}

		add_action( 'admin_notices', 'wparua_reset_nonce_error_message' );

	   exit;
	}
	else
	{
		if( current_user_can( 'administrator' ) )
		{
			delete_option( "wparua_registration_redirect_filter" );

			update_option( "wparua_registration_redirect_enable", 'off' );

			function wparua_reset_success_message()
			{
				$class = 'notice notice-success';
				
				$message = __( 'Filters Reset Successfully', 'wparua' );

				printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );

			}

			add_action( 'admin_notices', 'wparua_reset_success_message' );
		}
	}
}

add_action( "admin_head", "wparua_redirect_url_suggestion" );

function wparua_redirect_url_suggestion()
{
	$is_https = isset( $_SERVER['HTTPS']) && ( $_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1 ) || isset( $_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https';

    $protocol = ( $is_https ) ? 'https://' : 'http://';

	echo

	"<script>

		var wparua_available_pages = [";

		$post_types = get_post_types( array( 'public'   => true, '_builtin' => false ), 'names', 'or' );

		$all_post_types = array();

		foreach ( $post_types  as $post_type )
		{	
			$all_post_types[] = $post_type;
		}

		$args = array(
			'posts_per_page'   => -1,
			'post_type'        => $all_post_types,
		);

		foreach( get_posts( $args ) as $post )
		{	
	    	echo '"' . str_replace( $protocol, "", get_the_permalink( $post->ID ) ) . '",';
	  	}

		echo "];var wparua_protocol = '$protocol';";

	echo "</script>";

}

add_action( "wp_ajax_wparua_registration_redirect_filter_toggle_enable_disable", "wparua_registration_redirect_filter_toggle_enable_disable" );

add_action( "wp_ajax_wparua_registration_redirect_filter", "wparua_registration_redirect_filter" );

function wparua_registration_redirect_filter_toggle_enable_disable()
{
	if ( isset( $_POST['wparua_registration_redirect_enable']) && ! empty( $_POST['wparua_registration_redirect_enable'] ) )
	{
		if ( ! isset( $_POST['wparua_after_registration_redirect_filters_submit'] ) || ! wp_verify_nonce( $_POST['wparua_after_registration_redirect_filters_submit'], 'wparua_after_registration_redirect_filters_submit' )
			)
		{
			$error = array( 'Sorry, your nonce did not verify.' );
			
			wp_send_json( $error );
		}
		else
		{
			if( current_user_can( 'administrator' ) )
			{
				if ( $_POST['wparua_registration_redirect_enable'] == 'on' )
				{
					update_option( "wparua_registration_redirect_enable", 'on' );
				}
				elseif ( $_POST['wparua_registration_redirect_enable'] == 'off' )
				{
					update_option( "wparua_registration_redirect_enable", 'off' );
				}
			}

			die();
		}
  	}
}

function wparua_registration_redirect_filter()
{
	if ( ! isset( $_POST['wparua_after_registration_redirect_filters_submit'] ) || ! wp_verify_nonce( $_POST['wparua_after_registration_redirect_filters_submit'], 'wparua_after_registration_redirect_filters_submit' )
	)
	{
		$error = array( 'Sorry, your nonce did not verify.' );
			
		wp_send_json( $error );
	}
	else
	{
		if( current_user_can( 'administrator' ) )
		{
			update_option( "wparua_registration_redirect_filter", sanitize_text_field( $_POST["wparua_registration_redirect_to_url"] ) );
		}

		wp_send_json( [ 'success' => true ] );

		die();
	}
}
