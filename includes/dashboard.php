<?php

add_action( 'admin_menu', 'wparua_add_dashboard_page' );

// ---------------------------------------------------------
// Add Plugin Settings page to wp dashboard
// ---------------------------------------------------------

function wparua_add_dashboard_page()
{
	add_menu_page( "Registration Redirect", "Registration Redirect", "manage_options" , "wp-registration-redirect-advanced", "wparua_wp_redirect_user_after_registration", "dashicons-menu" );
}

function wparua_wp_redirect_user_after_registration()
{
	$filters = get_option( "wparua_registration_redirect_filter" ); ?>

	<div class="wrap">
		<h2>Redirect User After Registration</h2>
			<div class="notice wparua_registration_redirect_filter_save_message"> <p></p> </div>
		<br>

		<form action="" method="post" id="wparua_wp_registration_redirect_form">
			<div class="form-group row">
			    <div class="col-sm-2" style="line-height: 35px;">Enable Redirection</div>
			    <div class="col-sm-10">
			    	<div class="form-check">
			        	  <div class="wparua-filter-slider">
						    <input type="checkbox" name="wparua_registration_redirect_enable" class="wparua-filter-slider-checkbox" id="wparua_registration_redirect_enable" <?php checked( "on", get_option( "wparua_registration_redirect_enable" )); ?>>
						    <label class="wparua-filter-slider-label" for="wparua_registration_redirect_enable">
						      <span class="wparua-filter-slider-inner"></span>
						      <span class="wparua-filter-slider-circle"></span>
						    </label>
						  </div>
			    	</div>
			    </div>
			</div>

    		<div class="input-group mb-3">
			  <div class="input-group-prepend">
			    <span class="input-group-text">Redirect User</span>
			  </div>

			  <div class="input-group-append">
			    <span class="input-group-text">After Registration To</span>
    			<span class="input-group-text" id="wparua_registration_site_protocol"></span>
			  </div>

			  <input type="text" class="form-control " id="wparua_registration_redirect_url" name="wparua_registration_redirect_url" placeholder="Enter Redirect URL..." value="<?php echo $filters ; ?>">
			</div>

			<button type="submit" class="button button-secondary" name="wparua_registration_redirect_filter_submit" id="wparua_registration_redirect_filter_submit">Save Changes</button>

			<?php wp_nonce_field( 'wparua_after_registration_redirect_filters_submit', 'wparua_after_registration_redirect_filters_submit' ); ?>

			<button type="submit" class="button button-secondary" name="wparua_registration_redirect_filter_reset" id="wparua_registration_redirect_filter_reset">Reset</button>
		</form>
	</div>
<?php }
