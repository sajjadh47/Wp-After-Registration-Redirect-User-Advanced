jQuery( document ).ready( function( $ )
{
    $( document ).on( 'keydown.autocomplete', "#wparua_registration_redirect_url", function()
    {
        var options = { source: wparua_available_pages };

        $( this ).autocomplete(options);
    });

    $( "#wparua_registration_site_protocol" ).text( wparua_protocol );

    $( "#wparua_registration_redirect_enable" ).click( function( event )
    {
        if ( $( this ).is( ':checked' ) )
        {
            var data =
            {
                wparua_registration_redirect_enable : 'on',
                action  : 'wparua_registration_redirect_filter_toggle_enable_disable',
                wparua_after_registration_redirect_filters_submit   : $( "#wparua_after_registration_redirect_filters_submit" ).val()
            };

            $.post( ajaxurl, data, function( response )
            {
                $( ".wparua_registration_redirect_filter_save_message p" ).text( "Filters Enabled!" );

                $( ".wparua_registration_redirect_filter_save_message" ).removeClass( 'notice-warning' ).addClass( 'notice-success' ).show( 'slow' );

            });
        }
        else
        {
            var data =
            {
                wparua_registration_redirect_enable : 'off',
                action  : 'wparua_registration_redirect_filter_toggle_enable_disable',
                wparua_after_registration_redirect_filters_submit   : $( "#wparua_after_registration_redirect_filters_submit" ).val()
            };

            $.post( ajaxurl, data, function( response )
            {
                $( ".wparua_registration_redirect_filter_save_message p" ).text( "Filters Disabled!" );

                $( ".wparua_registration_redirect_filter_save_message" ).removeClass( 'notice-success' ).addClass( 'notice-warning' ).show( 'slow' );
            });
        }
    });

    $( "#wparua_registration_redirect_filter_submit" ).click( function( event )
    {
    	event.preventDefault();

        $( this ).text( 'Saving...' );

        var data =
        {
            wparua_registration_redirect_to_url :  $( "#wparua_registration_redirect_url" ).val(),
            action  : 'wparua_registration_redirect_filter',
            wparua_after_registration_redirect_filters_submit   : $( "#wparua_after_registration_redirect_filters_submit" ).val()
        };

        $.post( ajaxurl, data, function( response )
        {
            $( "#wparua_registration_redirect_filter_submit" ).text( 'Settings Saved' );

            setTimeout( function()
            {
                $( "#wparua_registration_redirect_filter_submit" ).text( 'Save Changes' );
            
            }, 2000 );

            $( ".wparua_registration_redirect_filter_save_message p" ).text( "Settings Saved Successfully!" );

            $( ".wparua_registration_redirect_filter_save_message" ).removeClass( 'notice-warning' ).addClass( 'notice-success' ).show( 'slow' );
        });
    });
});