<?php
// Template Name: signle show Template
$show_id = $_GET['id'];

?>
 <?php 
 	$sql="SELECT *FROM horseshows WHERE id='$show_id'";
	$show_details = $wpdb->get_results($sql);
	//var_dump($show_details);
	 foreach($show_details as $show)
	 {
	 //var_dump($show);
 ?>

		<div class="content">
        
		<div class="content_botbg add_listing">

		<div class="content_res">

			<div id="breadcrumb">

				<div id="crumbs"><a href="<?php echo site_url(); ?>">Home</a> <a href="<?php echo site_url(); ?>/show-details/?id=<?php echo $show_id; ?>">&raquo; Show dtails</a>&raquo;<?php echo $show->name_show;?><span class="current"></span></div>
			</div>


			<div class="clr"></div>
		<div class="ad_list_bg">
			<div class="content_">

				

						<div class="shadowblock_out ">

							<div class="shadowblock">
                                <?php
                                 //echo $show->show_date_time;
                                  $show_date_split_to = explode(" to ",$show->show_date_time);
                                  $show_date_split_space1 = explode(" ",$show_date_split_to[0]);
                                  $show_date_split_space2 = explode(" ",$show_date_split_to[1]);
                                  $date1=date_create($show_date_split_space1[0]);
                                   $date2=date_create($show_date_split_space2[0]);
                                  $dateconverted_month_date1=date_format($date1,"M/d/Y"); 
                                  $dateconverted_month_date2=date_format($date2,"M/d/Y");
                                  ?>
								
								<h1 class="single-listing normal_heding" style="float:left;"><a href="#" title="Show Details"><?php echo $show->name_show;?></a></h1>
                                <?php  //if($show->show_date_time!=' to '){?>
								<?php /*?><span style="float:right; font-weight: bold;">Date Of Show : <?php echo $show->show_date_time;?></span><?php */?>
                                <span style="float:right; font-weight: bold;">Date Of Show : <?php echo $show->show_date_time; //echo $dateconverted_month_date1.' to '.$dateconverted_month_date2;?></span>
                                <?php //}?> 
								<div class="clr"></div>

								

							  <div class="pad5 dotteed"></div>

								<?php /*?><div class="carisol_single">
                                <img src="<?php echo site_url(); ?>/wp-content/themes/Horseshowsales/images/single_slider.jpg" width="577" height="285" alt="" /> 
                                </div><?php */?>


							  
									<div class="bigleft">

										<div id="main-pic">

											<img class="attachment-medium" alt="" title="" src="<?php echo $show->image; ?>" />
											<div class="clr"></div>

										</div>

										<div id="thumbs-pic">

											
											<div class="clr"></div>

										</div>

									</div><!-- /bigleft -->
                                    
                                    <div class="bigright ">

									<ul>
                                    	<?php  echo $show->show_desc; ?>

									
									</ul>

								</div><!-- /bigright -->

								
								<div class="clr"></div>

								
								<div class="single-main">
                                
                                   <div class="sigle_left"> <p class="contact_heading"> Horse Show Location Address </p>
									<p><a href=""><?php echo $show->website; ?></a></p>
									<p><?php echo $show->address; ?></p>
                                    <p><?php echo $show->phone; ?></p>
                                    <p><?php echo $show->email; ?></p>
                                    <p><a href=""><?php echo $show->video_url; ?></a></p>
                                   <li> </li>
                                   </div>
                                
                                </div>

								

							</div><!-- /shadowblock -->

						</div><!-- /shadowblock_out -->

						

				

				<div class="sigle_right">
                 
                <style>.lrshare_iconsprite32.lrshare_sharingcounter32{display:none;}.lrshare_iconsprite32.lrshare_evenmore32{display:none;}
				.simplefavorite-button{background-color: transparent;border: 0;padding:0;}
			    .lrshare_interfacehorizontal{    padding-top: 0;}
                </style>
				<?php /*?><div style="float:left;"><?php echo do_shortcode( '[favorite_button post_id="'.$id.'" site_id=""]' ); ?></div><?php */?>
				<?php if($show->phone!=''){?><div style="float:left;"><a href="tel:<?php echo $show->phone; ?>"><img  src="<?php bloginfo('template_url'); ?>/images/post_phone.png" width="34" height="34" alt="Phone" title="Phone"/></a></div><?php } ?>
                <!--shortcode for social share using social share plugin-->
				<div style="float:left;"><?php echo do_shortcode( '[LoginRadius_Share]' ); ?></div>
                                
                                <?php /*?><img src="<?php echo site_url(); ?>/wp-content/themes/Horseshowsales/images/sha.png" width="48" height="48" alt="" /> 
                                <img src="<?php echo site_url(); ?>/wp-content/themes/Horseshowsales/images/ema.png" width="48" height="48" alt="" />
                                <img src="<?php echo site_url(); ?>/wp-content/themes/Horseshowsales/images/pho.png" width="48" height="48" alt="" />
                                <img src="<?php echo site_url(); ?>/wp-content/themes/Horseshowsales/images/fav.png" width="48" height="48" alt="" />
                                <img src="<?php echo site_url(); ?>/wp-content/themes/Horseshowsales/images/tw.png" width="48" height="48" alt="" />
                                <img src="<?php echo site_url(); ?>/wp-content/themes/Horseshowsales/images/pi.png" width="48" height="48" alt="" />
                                <img src="<?php echo site_url(); ?>/wp-content/themes/Horseshowsales/images/fb.png" width="48" height="48" alt="" /><?php */?>
                                </div>
				
				<div class="clr"></div>

				
			</div><!-- /content_left -->
        </div>
        
			
<!-- right sidebar -->
<!-- /content_left -->
        </div>
        
			<?php get_sidebar('shows'); ?>

			<div class="clr"></div>
		</div><!-- /content_res -->

	</div><!-- /content_botbg -->

</div><!-- /content -->
<?php } ?>

