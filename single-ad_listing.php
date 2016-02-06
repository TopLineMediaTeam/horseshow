<div class="content">
<?php $currentpoststatus='';?>
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
	 					<?php $currentpoststatus=$post->post_status; ?>
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

</div><!-- /content -->
<style>

#horseshowmask {
  position: absolute;
  left: 0;
  top: 0;
  z-index: 9000;
  background-color: #000;
  opacity: .5;
  display: none;
}
 
#horseshowalertboxes .window {
  position: absolute;
  left: 0;
  top: 0;
  max-width: 440px;
  max-height: 200px;
  display: none;
  z-index: 9999;
  padding: 20px;
  border-radius: 15px;
  text-align: center;
}
 
#horseshowalertboxes #dialog {
  max-width: 100%;
  max-height: 100%;
  background-color: #ffffff;
  font-family: 'Segoe UI Light', sans-serif;
  font-size: 15pt;
  
}
 
#horseshowalertboxes #popupfoot {
  font-size: 16pt;
  position: absolute;
  bottom: 0px;
  width: 250px;
  left: 250px;
}
#horseshowalertboxes .popup-close {
  background: none repeat scroll 0 0 #fff;
  cursor: pointer;
  display: block;
  font-size: 150%;
  line-height: 1.33333em;
  width: 1.3333em;
  height: 1.3333em;
  line-height: 130%;
  position: absolute;
  right: 0;
  text-align: center;
  top: 0;
  z-index: 2;
  color: #222222;
}

</style>

<div id="horseshowalertboxes">
		<div id="dialog" class="window">
		<img src="<?php echo $cp_options->logo; ?>" alt="<?php bloginfo('name'); ?>">
      	<h3>Click here to add your horse to a <a href="http://horseshowsales.com/horse-show-sale/">Horse Show</a></h3> 
    	<div class="close popup-close js-popup-close modal-close">X</div>
</div>
<div id="horseshowmask"></div>
<script type="text/javascript">
<?php if($currentpoststatus!='publish')
{ ?>
jQuery(document).ready(function($) {  
	popuphorseshowbox($) ;    
});
<?php } ?>

function popuphorseshowbox($)
{
	var id = '#dialog';     
	//Get the screen height and width
	var maskHeight = $(document).height();
	var maskWidth = $(window).width();
		 
	//Set heigth and width to mask to fill up the whole screen
	$('#horseshowmask').css({'width':maskWidth,'height':maskHeight});
	 
	//transition effect
	$('#horseshowmask').fadeIn(3500); 
	$('#horseshowmask').fadeTo("slow",0.9);  
		 
	//Get the window height and width
	var winH = $(window).height();
	var winW = $(window).width();
				   
	//Set the popup window to center
	$(id).css('top',  winH/2-$(id).height()/2);
	$(id).css('left', winW/2-$(id).width()/2);
		 
	//transition effect
	$(id).fadeIn(4000);     
		 
	//if close button is clicked
	$('.window .close').click(function (e) {
	//Cancel the link behavior
	e.preventDefault();
	 
	$('#horseshowmask').hide();
	$('.window').hide();
	});
	 
	//if mask is clicked
	$('#horseshowmask').click(function () {
	$(this).hide();
	$('.window').hide();
	});
}


</script>