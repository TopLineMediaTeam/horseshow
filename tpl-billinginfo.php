<?php
/*
Template Name: Billing Info
*/

$current_user = wp_get_current_user(); // grabs the user info and puts into vars
$user_id = get_current_user_id();
var_dump($user_id);
//$WP_User['data']->ID;
$display_user_name = cp_get_user_name();
var_dump($display_user_name);

?>


<div class="content">

	<div class="content_botbg">

		<div class="content_res">

			<!-- left block -->
			<div class="content_left">

				<div class="shadowblock_out">

					<div class="shadowblock">

						<h1 class="single dotted"><?php printf( __( 'Billing Info', APP_TD ), esc_html( $display_user_name ) ); ?></h1>

						<?php do_action( 'appthemes_notices' ); ?>

						<form name="profile" id="your-profile" action="" method="post">

						<?php wp_nonce_field( 'app-edit-profile' ); ?>

							<input type="hidden" name="from" value="profile" />
							<input type="hidden" name="checkuser_id" value="<?php echo $user_ID; ?>" />


							

							<br />

							<?php
								//var_dump($current_user);
								do_action('show_user_profile', $current_user);
							?>

							<br />
                             
                             <div class="shadowblock">

			<?php /*?><h2 class="dotted"><?php _e( 'Account Information', APP_TD ); ?></h2><?php */?>

			<?php /*?><div class="avatar"><?php appthemes_get_profile_pic($current_user->ID, $current_user->user_email, 60); ?></div><?php */?>

				<?php /*?><ul class="user-info">
					<li><h3 class="single"><a href="<?php echo get_author_posts_url($current_user->ID); ?>"><?php echo $display_user_name; ?></a></h3></li>
					<li><strong><?php _e( 'Member Since:', APP_TD ); ?></strong> <?php echo appthemes_display_date( $current_user->user_registered, 'datetime', true ); ?></li>
					<li><strong><?php _e( 'Last Login:', APP_TD ); ?></strong> <?php echo appthemes_get_last_login($current_user->ID); ?></li>
				</ul><?php */?>

				<?php if ( $cp_options->enable_membership_packs ) { ?>
				<?php $membership = get_pack( $current_user->active_membership_pack ); ?>
				<ul class="membership-pack">
					<?php if ( $membership && ( appthemes_days_between_dates( $current_user->membership_expires ) < 0 ) ) { ?>
						<li><?php printf( __( 'Your membership pack "%1$s" expired on %2$s.', APP_TD ), $membership->pack_name, appthemes_display_date( $current_user->membership_expires ) ); ?></li>
						<li><a href="<?php echo CP_MEMBERSHIP_PURCHASE_URL; ?>"><?php _e( 'Renew Your Membership Pack', APP_TD ); ?></a></li>
					<?php } elseif( $membership ) { ?>
						<li><strong><?php _e( 'Membership Pack:', APP_TD ); ?></strong> <?php echo stripslashes($membership->pack_name); ?></li>
						<li><strong><?php _e( 'Membership Expires:', APP_TD ); ?></strong> <?php echo appthemes_display_date( $current_user->membership_expires ); ?></li>
						<li><a href="<?php echo CP_MEMBERSHIP_PURCHASE_URL; ?>"><?php _e( 'Renew or Extend Your Membership Pack', APP_TD ); ?></a></li>
					<?php } else { ?>
						<li><a href="<?php echo CP_MEMBERSHIP_PURCHASE_URL; ?>"><?php _e( 'Purchase a Membership Pack', APP_TD ); ?></a></li>
					<?php } ?>
				</ul>
				<?php } ?>

				<?php /*?><ul class="user-details">
					<li><div class="emailico"></div><a href="mailto:<?php echo $current_user->user_email; ?>"><?php echo $current_user->user_email; ?></a></li>
					<?php if ( ! empty( $current_user->twitter_id ) ) { ?><li><div class="twitterico"></div><a href="http://twitter.com/<?php echo esc_attr( $current_user->twitter_id ); ?>" target="_blank"><?php _e( 'Twitter', APP_TD ); ?></a></li><?php } ?>
					<?php if ( ! empty( $current_user->facebook_id ) ) { ?><li><div class="facebookico"></div><a href="<?php echo appthemes_make_fb_profile_url( $current_user->facebook_id ); ?>" target="_blank"><?php _e( 'Facebook', APP_TD ); ?></a></li><?php } ?>
					<?php if ( ! empty( $current_user->user_url ) ) { ?><li><div class="globeico"></div><a href="<?php echo esc_attr( $current_user->user_url ); ?>" target="_blank"><?php echo esc_html( $current_user->user_url ); ?></a></li><?php } ?>
				</ul><?php */?>
                
                <?php 
					$query="select p.* from wp_posts p left join wp_p2pmeta pp on p.id='pp.p2p_from' left join wp_p2pmeta pm on pp.p2p_id=pm.p2p_id where p.post_author='".$user_id."' and p.post_type='transaction'";
					$bill_list = $wpdb->get_results($query, OBJECT);
					//var_dump($billList);
				?>
               </div>
                <table border="0" cellpadding="4" cellspacing="1" class="tblwide footable">
							<thead>
								<tr>
									<th width="2px" data-class="expand">&nbsp;slno</th>
									<th data-class="expand">&nbsp;User</th>
                                    <th width="5px" data-class="expand">&nbsp;Post Date&time</th>
									<th data-class="expand">&nbsp;Status</th>
									
								</tr>
							</thead>
							<tbody>
                <?php	
					
					if ($bill_list):
							 
								//var_dump($featuredposts);
						global $post;
						foreach ($bill_list as $post):
						//var_dump($post);
						
						?>
						<tr class="even">
									<td><?php echo $post->ID; ?></td>
									<td class="expand"><?php echo $display_user_name ?></td>
									<td class="expand"><?php echo $post->post_date; ?></td>
                                    <td class="expand"><?php echo $post->ping_status; ?></td>

						</tr>

							
					
			
                 
                 <?php //endwhile;
						endforeach;
						endif;
				?>
</tbody>

						</table>
				<?php cp_author_info( 'sidebar-user' ); ?>

		
                             

							
								

						</form>

					</div><!-- /shadowblock -->

				</div><!-- /shadowblock_out -->

			</div><!-- /content_left -->

			<?php get_sidebar( 'user' ); ?>

			<div class="clr"></div>

		</div><!-- /content_res -->

	</div><!-- /content_botbg -->

</div><!-- /content -->
<style>
.page-template-tpl-billinginfo .wpua-edit-container {display:none;}
.page-template-tpl-billinginfo .even .expand {
	text-align: center;	
	}
</style>