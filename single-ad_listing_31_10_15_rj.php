

<div class="content">

	<div class="content_botbg add_listing">

		<div class="content_res">

			<div id="breadcrumb">

				<?php if ( function_exists('cp_breadcrumb') ) cp_breadcrumb(); ?>

			</div>

			<!-- <div style="width: 105px; height:16px; text-align: right; float: left; font-size:11px; margin-top:-10px; padding:0 10px 5px 5px;"> -->
				<?php // if($reported) : ?>
					<!-- <span id="reportedPost"><?php _e( 'Post Was Reported', APP_TD ); ?></span> -->
				<?php // else : ?>
					<!--	<a id="reportPost" href="?reportpost=<?php echo $post->ID; ?>"><?php _e( 'Report This Post', APP_TD ); ?></a> -->
				<?php // endif; ?>
			<!-- </div> -->

			<div class="clr"></div>
		<div class="ad_list_bg">
			<div class="content_">

				<?php do_action( 'appthemes_notices' ); ?>

				<?php appthemes_before_loop(); ?>

				<?php if ( have_posts() ) : ?>

					<?php while ( have_posts() ) : the_post(); ?>

						<?php appthemes_before_post(); ?>

						<?php appthemes_stats_update( $post->ID ); //records the page hit ?>

						<div class="shadowblock_out <?php cp_display_style( 'featured' ); ?>">

							<div class="shadowblock">

								<?php appthemes_before_post_title(); ?>

								<h1 class="single-listing normal_heding"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>

								<div class="clr"></div>

								<?php appthemes_after_post_title(); ?>

								<div class="pad5 dotteed"></div>

								


								<?php if ( $cp_options->ad_images ) { ?>

									<div class="bigleft">

										<div id="main-pic">

											<?php cp_get_image_url(); ?>

											<div class="clr"></div>

										</div>

										<div id="thumbs-pic">

											<?php cp_get_image_url_single( $post->ID, 'thumbnail', $post->post_title, -1 ); ?>

											<div class="clr"></div>

										</div>

									</div><!-- /bigleft -->
                                    
                                    <div class="bigright <?php cp_display_style( 'ad_single_images' ); ?>">

									<ul>

									<?php
										// grab the category id for the functions below
										$cat_id = appthemes_get_custom_taxonomy( $post->ID, APP_TAX_CAT, 'term_id' );

										if ( get_post_meta($post->ID, 'cp_ad_sold', true) == 'yes' ) {
									?>
                                    		
											<li id="cp_sold"><span><?php _e( 'This Horse has been sold', APP_TD ); ?></span></li>
                                            <style type="text/css">#cp_for_sales{
											display:none;
											}</style>
									<?php
										}

										// 3.0+ display the custom fields instead (but not text areas)
										//cp_get_ad_details( $post->ID, $cat_id );
										cp_get_ad_details_custom( $post->ID, $cat_id );
									?>

										<?php /*?><li id="cp_listed"><span><?php _e( 'Listed:', APP_TD ); ?></span> <?php echo appthemes_display_date( $post->post_date ); ?></li>
									<?php if ( $expire_date = get_post_meta( $post->ID, 'cp_sys_expire_date', true ) ) { ?>
										<li id="cp_expires"><span><?php _e( 'Expires:', APP_TD ); ?></span> <?php echo cp_timeleft( $expire_date ); ?></li>
									<?php } ?>
<?php */?>
									</ul>

								</div><!-- /bigright -->

								<?php } ?>

								<div class="clr"></div>

								<?php appthemes_before_post_content(); ?>

								<div class="single-main">

									<?php
										// 3.0+ display text areas in content area before content.
										cp_get_ad_details( $post->ID, $cat_id, 'content' );
									?>

									
									<?php the_content(); ?>
                                    
                                   <div class="sigle_left"> <p class="contact_heading"> Contact</p>

									<li class="user_author"><?php the_author();?></li>
                                    
                                   <li> <?php the_author_email();?></li>
                                   <div class="single_note">
								<?php appthemes_after_post_content(); ?>
								</div></div>
                                <div class="sigle_right">
                                <style>
								.lrshare_iconsprite32.lrshare_sharingcounter32{display: none;}
								.lrshare_iconsprite32.lrshare_evenmore32{display: none;}
								.simplefavorite-button{background-color: transparent;border: 0;padding:0;}
							    .lrshare_interfacehorizontal{    padding-top: 0;}
								</style>
								<div style="float:left;"><?php echo do_shortcode( '[favorite_button post_id="'.$id.'" site_id=""]' ); ?></div>
								<?php /*?><?php if($results[0]->phone!=''){?><div style="float:left;"><a href="tel:<?php echo $results[0]->phone; ?>"><img  src="<?php bloginfo('template_url'); ?>/images/post_phone.png" width="34" height="34" alt="" /></a></div><?php } ?><?php */?>
                                <div style="float:left;"><?php echo do_shortcode( '[LoginRadius_Share]' ); ?></div>
                                <?php /*?><img src="<?php bloginfo('template_url'); ?>/images/sha.png" width="48" height="48" alt="" /> 
                                <img src="<?php bloginfo('template_url'); ?>/images/ema.png" width="48" height="48" alt="" />
                                <img src="<?php bloginfo('template_url'); ?>/images/pho.png" width="48" height="48" alt="" />
                                <img src="<?php bloginfo('template_url'); ?>/images/fav.png" width="48" height="48" alt="" />
                                <img src="<?php bloginfo('template_url'); ?>/images/tw.png" width="48" height="48" alt="" />
                                <img src="<?php bloginfo('template_url'); ?>/images/pi.png" width="48" height="48" alt="" />
                                <img src="<?php bloginfo('template_url'); ?>/images/fb.png" width="48" height="48" alt="" /><?php */?>
                                <div class="clr"></div>
                                </div>
                                </div>

								

							</div><!-- /shadowblock -->

						</div><!-- /shadowblock_out -->

						<?php appthemes_after_post(); ?>

					<?php endwhile; ?>

					<?php appthemes_after_endwhile(); ?>

				<?php else: ?>

					<?php appthemes_loop_else(); ?>

				<?php endif; ?>

				<div class="clr"></div>

				<?php appthemes_after_loop(); ?>

				<?php wp_reset_query(); ?>

				<div class="clr"></div>

				<?php //comments_template( '/comments-ad_listing.php' ); ?>

			</div><!-- /content_left -->
        </div>
        
			<?php get_sidebar('home'); ?>

			<div class="clr"></div>
		</div><!-- /content_res -->

	</div><!-- /content_botbg -->

	<div id="boxes">
		<div id="dialog" class="window">

	<img src="images/logo.png">
      <h3>Click here to add your horse to a <a href="http://horseshowsales.com/horse-show-sale/">Horse Show</a></h3> 

    <div class="close popup-close js-popup-close modal-close">X</div>
  </div>
  <div id="mask"></div>
</div>

</div><!-- /content -->
