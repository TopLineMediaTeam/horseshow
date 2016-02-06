<?php
// Template Name: Register

// set a redirect for after logging in
if ( isset( $_REQUEST['redirect_to'] ) )
	$redirect = $_REQUEST['redirect_to'];

if (!isset($redirect))
	$redirect = home_url();

$show_password_fields = apply_filters( 'show_password_fields_on_registration', true );
?>




<div class="content_login">

	<div class="content_botbg content_left">

		<div class="content_res_login">

			<!-- full block -->
			<div class="shadowblock_out">

				<div class="shadowblock">

					<h2 class=""><span class="colour"><?php _e( 'Register', APP_TD ); ?></span></h2>

					<?php do_action( 'appthemes_notices' ); ?>

					<div class="left-box">

						<?php if ( get_option('users_can_register') ) : ?>

							<form action="<?php echo appthemes_get_registration_url( 'login_post' ); ?>" method="post" class="loginform" name="registerform" id="registerform">

								<div class="clr"></div>
                                <p>
									
									<input tabindex="1" type="text" class="text required" placeholder="Enter User Name" name="user_login" id="user_login" value="<?php if (isset($_POST['user_login'])) echo esc_attr(stripslashes($_POST['user_login'])); ?>" />
								</p>

								<p>
									
									<input tabindex="2" type="text" class="text required email" name="user_email" placeholder="Enter Email Id" id="user_email" value="<?php if (isset($_POST['user_email'])) echo esc_attr(stripslashes($_POST['user_email'])); ?>" />
								</p>

								<?php if ( $show_password_fields ) : ?>
									<p>
										<input tabindex="3" type="password" class="text required" name="pass1" id="pass1" value="" autocomplete="off" />
									</p>

									<p>
										<input tabindex="4" type="password" class="text required" name="pass2" id="pass2" value="" autocomplete="off" />
									</p>

									<div class="strength-meter">
										<div id="pass-strength-result" class="hide-if-no-js"><?php _e( 'Strength indicator', APP_TD ); ?></div>
										<span class="description indicator-hint"><?php _e( 'Hint: The password should be at least seven characters long. To make it stronger, use upper and lower case letters, numbers and symbols like ! " ? $ % ^ &amp; ).', APP_TD ); ?></span>
									</div>
								<?php endif; ?>
								<div class="captchadiv">
                            		<p class="captcha_login" style="text-align:center">
                            	<?php if ( ( function_exists( 'cptch_check_custom_form' ) && cptch_check_custom_form() !== true ) || ( function_exists( 'cptchpr_check_custom_form' ) && cptchpr_check_custom_form() !== true ) ) echo "Please complete the CAPTCHA." ?>
                            		</p>
                            	
                    		 </div>
								<?php do_action('register_form'); ?>

								<div id="checksave">

									<p class="submit" style="float:right;">
										<input tabindex="6" class="btn_orange" type="submit" name="register" id="register" value="<?php _e( 'Create Account', APP_TD ); ?>" />
									</p>

								</div>

								<input type="hidden" name="redirect_to" value="<?php echo esc_attr($redirect); ?>" />

								<!-- autofocus the field -->
								<script type="text/javascript">try{document.getElementById('user_login').focus();}catch(e){}</script>

							</form>

						<?php else : ?>

							<p><?php _e( '** User registration is currently disabled. Please contact the site administrator. **', APP_TD ); ?></p>

						<?php endif; ?>

					</div>

					<div class="right-box">

					</div><!-- /right-box -->

					<div class="clr"></div>

				</div><!-- /shadowblock -->

			</div><!-- /shadowblock_out -->

		</div><!-- /content_res -->

	</div><!-- /content_botbg -->
		<div class="clr"></div>
</div>
