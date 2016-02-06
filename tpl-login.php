<?php
// Template Name: Login

?>


<div class="content_login">

	<div class="content_botbg content_left">

		<div class="content_res_login">

			<!-- full block -->
			<div class="shadowblock_out">

				<div class="shadowblock">
                
                	<div class="login_icon"></div>

					<h2><span class="colour"><?php /*?><?php _e( 'Login', APP_TD ); ?><?php */?></span></h2>

					<?php do_action( 'appthemes_notices' ); ?>

					<p><?php /*?><?php _e( 'Please complete the fields below to login to your account.', APP_TD ); ?><?php */?></p>

					<div class="login_form_box">

						<form action="<?php echo appthemes_get_login_url( 'login_post' ); ?>" method="post" class="loginform" id="login-form">
                  <div class="login_fb_conect" >
						  <?php
                          if (new_fb_is_user_connected()) {
                            echo new_fb_unlink_button();
                          } else {
                            echo new_fb_link_button();
                          }
                          ?>
				  </div>
                  <div class="clr or_icon"></div>
							<div class="login_input">
								<label for="login_username"><?php _e( '', APP_TD ); ?></label>
								<input type="text" class="text required" placeholder="Enter User Name" name="log" id="login_username" value="<?php if (isset($posted['login_username'])) echo esc_attr($posted['login_username']); ?>" />
							</div>

							<div class="login_input">
								<label for="login_password"><?php _e( '', APP_TD ); ?></label>
								<input type="password" class="text required" placeholder="Enter Email Address" name="pwd" id="login_password" value="" />
							</div>
                            <div class="captchadiv">
                            	<p class="captcha_login" style="text-align:center">
                            	<?php if ( ( function_exists( 'cptch_check_custom_form' ) && cptch_check_custom_form() !== true ) || ( function_exists( 'cptchpr_check_custom_form' ) && cptchpr_check_custom_form() !== true ) ) echo "Please complete the CAPTCHA." ?>
                            	</p>
                            	<p class="captcha_login" style="text-align:center">
								<?php if( function_exists( 'cptch_display_captcha_custom' ) ) { echo "<input type='hidden' name='cntctfrm_contact_action' value='true' />"; echo cptch_display_captcha_custom(); } if( function_exists( 'cptchpr_display_captcha_custom' ) ) { echo "<input type='hidden' name='cntctfrm_contact_action' value='true' />"; echo cptchpr_display_captcha_custom(); } ?>
                            	</p>
                     </div>
							<div class="submit login_input">
									<input type="submit" class="btn_login" name="login" id="login" value="LOGIN" />
									<?php echo APP_Login::redirect_field(); ?>
									<input type="hidden" name="testcookie" value="1" />
							</div>
                            <div class="clr or_icon"></div>
                                  
							</div>
							<div class="clr"></div>
                            
                            
							<?php /*?><p class="rememberme">
									<input name="rememberme" class="checkbox" id="rememberme" value="forever" type="checkbox" checked="checked" />
									<label for="rememberme"><?php _e( 'Remember me', APP_TD ); ?></label>
								</p>

							<p class="lostpass">
									<a class="lostpass" href="<?php echo appthemes_get_password_recovery_url(); ?>" title="<?php _e( 'Password Lost and Found', APP_TD ); ?>"><?php _e( 'Lost your password?', APP_TD ); ?></a>
							</p><?php */?>
                            
							<?php /*?><div class="login_input">

								<?php wp_register('<p class="register">','</p>'); ?>

								<?php do_action('login_form'); ?>

							</div><?php */?>

						</form>
                        
                       
 					<div class="submit login_input colour">
                            <form action="<?php echo appthemes_get_registration_url(); ?>">
									<input type="submit" class="btn_login"  value="REGISTER A NEW ACCOUNT" />
                                    
                            </form> 
						<!-- autofocus the field -->
						<script type="text/javascript">try{document.getElementById('login_username').focus();}catch(e){}</script>

					</div>

					<div class="right-box">

					</div><!-- /right-box -->

					

				</div><!-- /shadowblock -->

			</div><!-- /shadowblock_out -->

		</div><!-- /content_res -->

	</div><!-- /content_botbg -->
		<div class="clr"></div>
</div><!-- /content -->
