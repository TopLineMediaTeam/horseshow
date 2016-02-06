<?php
/*
Template Name: page buyer Template
*/

global $wpdb;  
global $cp_options;
?>
<?php if ( $cp_options->enable_featured ) : ?>

<div class="content">

	<div class="content_botbg">

		<div class="content_res">

		
			<?php /*?><div id="breadcrumb">
				<?php if ( function_exists('cp_breadcrumb') ) cp_breadcrumb(); ?>
			</div><?php */?>
	<script type="text/javascript" src="<?php echo site_url(); ?>/wp-content/themes/Horseshowsales/includes/js/jcarousellite.min.js"></script>
	<script type="text/javascript" src="<?php echo site_url(); ?>/wp-content/themes/Horseshowsales/includes/js/jcarousellite.js"></script>
    <script type="text/javascript" src="<?php echo site_url(); ?>/wp-content/themes/Horseshowsales/includes/js/easing.js"></script>
   
   
   
   
	<script type="text/javascript">
		// <![CDATA[
		/* featured listings slider */
		jQuery(document).ready(function($) {
			$('.slider').jCarouselLite({
				btnNext: '.next',
				btnPrev: '.prev',
				visible: ( $(window).width() < 940 ) ? 4 : 5,
				pause: true,
				auto: true,
				timeout: 28000,
				speed: 1100,
				easing: 'easeOutQuint' // for different types of easing, see easing.js
			});
		});
		// ]]>
	</script>
    <div class="clear">
<!-- featured listings -->
		<div class="shadowblock_out slider_top feateadrd_ad">

			<div class="shadowblockdir">

				<h2 class="home_slider_f">Find Buyers</h2>

				<div class="sliderblockdir">

					<div class="prev"></div>

					<div id="sliderlist">

						<div class="slider">

							<ul>
							<?php 
							$paged=(get_query_var('paged'))? absint(get_query_var('paged')):1;
							//$args = array( 'post_type' => 'ad_listing', 'posts_per_page' => 10, 'paged' =>$paged,);
							$args = array( 'post_type' => 'ad_listing', 'posts_per_page' => 10, 'paged' =>$paged,'meta_query' =>array('relation' => 'AND', array('key' => 'cp_type','value' => 'buyer')));
							$loop = new WP_Query( $args );
							while ( $loop->have_posts() ) : $loop->the_post();
							 $pst=get_post( get_the_ID()); $meta_id = $pst->ID;
							 /*$sql="SELECT meta_value FROM wp_postmeta WHERE meta_key='cp_type' AND post_id=".$meta_id;
								  $post_details = $wpdb->get_results($sql);
								  if($post_details[0]->meta_value=='seller')
									continue;*/
							?>
							<li style="height:260px; width:180px;">	
                                <span class="feat_left">
                                <?php echo get_avatar( get_the_author_meta( 'ID' ), 64 ); ?>
                                </span>
                                <div class="clr"></div>
                                <p><a href="<?php echo get_site_url().'/author/'.get_the_author(); ?>"><?php the_author() ?></a></p>
                                <p style="color:#020202;"><?php echo cp_get_content_preview( 20 ); ?><a href="<?php echo site_url();?>/ads/<?php echo $pst->post_name; ?>" style="color:#0054a6; font-size:12px;">read more</a></p>
							</li>
							<?php endwhile; ?>
							</ul>

						</div>

					</div><!-- /slider -->

					<div class="next"></div>

					<div class="clr"></div>

				</div><!-- /sliderblock -->

			</div><!-- /shadowblock -->

		</div><!-- /shadowblock_out -->
     


			<div class="clr"></div>
			
			<div class="content_left">

				<div class="shadowblock_out">

					<!--<div class="shadowblock">

						<h1 class="single dotted">Finf Buyer</h1>

						<div id="directory" class="directory <?php cp_display_style( 'dir_cols' ); ?>">

							

							<div class="clr"></div>

						</div><!--/directory-->

<!--					</div><!-- /shadowblock -->


						<?php 
 							/*$search_breed = $_GET['breed'];
							$search_discip = $_GET['discipline'];
							$search_sex = $_GET['sex'];
							$search_height = $_GET['height'];
							$search_color = $_GET['color'];
							$search_location = $_GET['location'];
							$search_all_levels = $_GET['all_levels'];
							$get_age = $_GET['age'];
							$search_age= explode("-",$get_age);
							$age1 = $search_age[0];
							$age2 = $search_age[1];
							$get_cp_price = $_GET['price'];
							$search_cp_price= explode("-",$get_cp_price);
							$price1 = $search_cp_price[0];
							$price2 = $search_cp_price[1];*/
							//var_dump($_POST);
							$search_breed = isset($_POST['breed'])?$_POST['breed']:'';
							$search_discip = isset($_POST['discip'])?$_POST['discip']:'';
							$search_sex = isset($_POST['sex'])?$_POST['sex']:'';
							$search_height = isset($_POST['height'])?$_POST['height']:'';
							$search_color = isset($_POST['color'])?$_POST['color']:'';
							$search_location = isset($_POST['buyer_location'])?$_POST['buyer_location']:'';
							$search_all_levels = isset($_POST['all_levels'])?$_POST['all_levels']:'';
							$get_age = isset($_POST['age'])?$_POST['age']:'';
							$search_age= explode("-",$get_age);
							$age1 = $search_age[0];
							$age2 = $search_age[1];
							$get_cp_price = isset($_POST['price'])?$_POST['price']:'';
							$search_cp_price= explode("-",$get_cp_price);
							$price1 = $search_cp_price[0];
							$price2 = $search_cp_price[1];
							
							
							//var_dump(array($search_cp_price[0],$search_cp_price[1]));
							$metaquery_relation=array();
							$metaquery_relation['relation']='AND';
							if($search_location!='')
							{
								$metaquery_relation['meta_query']=array(
										'relation' => 'OR',
											array(
											'meta_key'     => 'cp_state',
											'value'   => $search_location,
											'compare' => 'IN'
											),
											array(
											'meta_key'     => 'cp_city',
											'value'   => $search_location,
											'compare' => 'IN'
											),
											array(
											'meta_key'     => 'cp_street',
											'value'   => $search_location,
											'compare' => 'IN'
											),
										);
										//var_dump($metaquery_relation['meta_query']);
							}		
							if($search_breed!='')
							{
								$metaquery_relation[]=array(
											'meta_key'     => 'cp_breed',
											'value'   => $search_breed,
											'compare' => '='
										);
							}		
							if($search_discip!='')
							{	
								$metaquery_relation[]=array(
											'meta_key'     => 'cp_discipline',
											'value'   => $search_discip,
											'compare' => 'IN'
										);
							}
							if($search_sex!='')
							{
								$metaquery_relation[]=array(
											'meta_key'     => 'cp_sex',
											'value'   => $search_sex,
											'compare' => 'IN'
										);
							}	
							if($search_height!='')
							{		
								$metaquery_relation[]=array(
											'meta_key'     => 'cp_height',
											'value'   => $search_height,
											'compare' => 'IN'
										);
							}
							if($search_all_levels!='')
							{
								$metaquery_relation[]=array(
											'meta_key'     => 'cp_all_levels',
											'value'   => $search_all_levels,
											'compare' => 'IN'
										);
							}
							if($search_color!='')
							{
								$metaquery_relation[]=array(
											'meta_key'     => 'cp_color',
											'value'   => $search_color,
											'compare' => 'IN'
										);
							}
							if($price1!='' && $price2!='')
							{
								$metaquery_relation[]=array(
											'meta_key' => 'cp_price',
											'value' =>  array($price1,$price2),
											'compare' => 'BETWEEN',
											'type' => 'numeric'
										);
							}
							if($age1!='' && $age2!='')
							{
								$metaquery_relation[]=array(
											'meta_key' => 'cp_age',
											'value'   =>  array($age1,$age2),
											'compare' => 'BETWEEN',
											'type' => 'numeric'
										);
							}		
							
							$args = array(
							// basics
							'post_type'   => 'ad_listing',
							'post_status' => 'publish',
							'posts_per_page' => -1,
							// meta query
								'meta_query' => $metaquery_relation
							);
									
							//query_posts('posts_per_page=3&paged=' . $paged);
							//var_dump($metaquery_relation);
							//var_dump($args);
$wp_query = new WP_Query( $args );
while ( $wp_query->have_posts() ) : $wp_query->the_post();
 $pst=get_post( get_the_ID()); $meta_id = $pst->ID;
 $sql="SELECT meta_value FROM wp_postmeta WHERE meta_key='cp_type' AND post_id=".$meta_id;
      $post_details = $wpdb->get_results($sql);
	  if($post_details[0]->meta_value=='buyer'){
	  	//continue;
?>



  				<div class="post-block-out ">

			<div class="post-block">

				<div class="post-left">
					<a href="<?php echo get_site_url().'/author/'.get_the_author(); ?>" title="<?php the_title() ?>"> <?php echo get_avatar( get_the_author_meta( 'ID' ), 64 ); ?> </a>
				</div>

				<div class="post-right">
                    <?php /*?><div class="price-wrap">
                        <span class="tag-head">&nbsp;</span><p class="post-price"><?php cp_get_price($post->ID, 'cp_price'); ?></p>
                    </div><?php */?>
                    <h5><a href="<?php echo get_site_url().'/author/'.get_the_author(); ?>"><?php the_author() ?></a></h5>
                    <p><a class="horsetitle" href="<?php echo get_the_permalink();?>"><span>Seeking:&nbsp;</span><?php the_title();?></a></p>
                    <p><?php cp_get_ad_details( $post->ID, $cat_id );?></p>
				</div>
                <div class="post-right_icons"  style="width:auto">
                	<div class="price-wrap">
                        <span class="tag-head">&nbsp;</span><p class="post-price"><?php cp_get_price($post->ID, 'cp_price'); ?></p>
                    </div>
                	<style>
					    .post-right a.horsetitle{font-family: Georgia, "Times New Roman", Times, serif;font-size: 12px;}
						.widget-container{
						list-style:none;
						}
						.lrshare_iconsprite32.lrshare_sharingcounter32{display:none;}.lrshare_iconsprite32.lrshare_evenmore32{display:none;}
                	</style>
                    <?php echo do_shortcode( '[LoginRadius_Share]' ); ?>
                                  
                	<?php 
      				// Custom widget area start
      				if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Custom Widget Area') ) : ?>
					<?php endif; ?>
                    <?php /*?><img  src="<?php bloginfo('template_url'); ?>/images/post_msg.png" width="34" height="34" alt="" /> 
                    <img  src="<?php bloginfo('template_url'); ?>/images/post_phone.png" width="34" height="34" alt="" /> 
                    <img  src="<?php bloginfo('template_url'); ?>/images/post_fev.png" width="34" height="34" alt="" /> <?php */?>
                </div>
                <div class="clr"></div>
                <div class="post-desc"><?php echo cp_get_content_preview( 20 ); ?>..<a href="<?php echo site_url();?>/ads/<?php echo $pst->post_name; ?>" style="color:#0054a6; font-size:12px;text-decoration:none;">read more</a></div>

				<div class="clr"></div>

			</div><!-- /post-block -->

		</div><!-- /post-block-out -->
        <?php } ?>
<?php endwhile;?>


 <?php //echo paginate_links( $args ); ?> 


				</div><!-- /shadowblock_out -->

			</div><!-- /content_left -->
           
		 <?php get_template_part( 'buyer-sidebar'); ?>
			 </div>
             <div class="clr"></div>

		</div><!-- /content_res -->

	</div><!-- /content_botbg -->

</div><!-- /content -->
<?php endif; // end feature ad slider check ?>
