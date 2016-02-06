<?php
/*
Template Name: Page Favorites Template
*/

global $wpdb;  
global $cp_options;
?>
<?php if ( $cp_options->enable_featured ) : ?>

<div class="content">

	<div class="content_botbg">

		<div class="content_res">
        <div class="shadowblock_out slider_top feateadrd_ad" style="  margin-bottom: 20px;">
          <div class="shadowblockdir">
            <h2 class="home_slider_f" style="padding-left: 10px;">Favorites</h2>
			<style>
				.widget-container{
					list-style:none;
				}
			</style>
            
            <div class="sliderblockdir">
              <?php echo do_shortcode( '[user_favorites user_id="" include_image="true" include_links="true" site_id="" post_types="" include_buttons="false"]' ); ?>
            </div> 
            <!-- /sliderblock --> 
            
          </div>
          <!-- /shadowblock --> 
          
        </div>
        	
        <div class="clr"></div>

		</div><!-- /content_res -->

	</div><!-- /content_botbg -->

</div><!-- /content -->
<?php endif; // end feature ad slider check ?>
