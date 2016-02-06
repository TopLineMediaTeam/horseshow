<?php
/*
Template Name: horse-search
*/
global $wpdb;  
global $cp_options;
?>
<?php 
//var_dump( $wp_query->posts);
/*$term = get_queried_object();
if(!empty($wp_query->posts))
{
	foreach ($wp_query->posts as $wp_post) :
		$in_array[]=$wp_post->ID;
	endforeach;
		$in_array_string =implode(",",$in_array);
		$sql="SELECT count(post_id) AS post_count FROM wp_postmeta WHERE meta_value='seller' AND post_id IN (".$in_array_string.")";
		//echo $sql;
		  $post_count = $wpdb->get_results($sql);
		  //var_dump($post_details);
}
*/?>
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
				timeout: 2800,
				speed: 1100,
				easing: 'easeOutQuint' // for different types of easing, see easing.js
			});
		});
		// ]]>
	</script>
  <?php
  	 $term = get_queried_object(); 
    if(!empty($term)):?>

<div class="content">

	<div class="content_botbg">

		<div class="content_res">



<div class="shadowblock_out slider_top">

			<div class="shadowblockdir">

				<h2 class="home_slider_f"><?php echo $term->name; ?></h2>

				<div class="sliderblockdir">

					<div class="prev"></div>

					<div id="sliderlist">

						<div class="slider">

							<ul>
							<?php 

							//$args = array( 'post_type' => 'ad_listing','ad_cat' => $term->slug, 'posts_per_page' => 10 );


/*$querystr = "
								SELECT $wpdb->posts.* 
								FROM $wpdb->posts, $wpdb->postmeta, $wpdb->term_relationship, $wpdb->term_taxonomy
								WHERE $wpdb->posts.ID = $wpdb->postmeta.post_id 
								AND $wpdb->postmeta.meta_key = 'ad_cat' 
								AND $wpdb->postmeta.meta_value = " .$term->slug ."
								AND $wpdb->posts.post_status = 'publish' 
								AND $wpdb->posts.post_type = 'ad_listing'
								AND $wpdb->posts.post_date < NOW()
								ORDER BY $wpdb->posts.post_date DESC LIMIT 10
							 ";
							
							 $pageposts = $wpdb->get_results($querystr, OBJECT);*/
//var_dump( $pageposts);



							wp_reset_query(); 
//echo $s_slug;
							//$args1 = array( 'post_type' => 'ad_listing','taxonomy' => 'ad_cat','ad_cat' => 'jumpers','field'  => 'slug', 'posts_per_page' => 10 );
							
							//$args1 = array( 'post_type' => 'ad_listing','taxonomy' => 'ad_cat','ad_cat' => 'jumpers','field'  => 'slug', 'posts_per_page' => 10 );
							$wp_query->set('meta_query', '' );
							$meta_query_args = array();
							
							//$args = array( 'post_type' => 'ad_listing','ad_cat' => $term->slug, 'posts_per_page' => 10  ,'meta_query'=>$meta_query_args);
							$args = array( 'post_type' => 'ad_listing','taxonomy' => 'ad_cat', 'posts_per_page' => 10  ,'meta_query'=>$meta_query_args);
							//$args = array( 'post_type' => 'ad_listing', 'posts_per_page' => 10 );							
							$args['meta_keys']='';
							
							//$loop_new = new WP_Query( $args);
							
							if(isset($term->slug) && $term->slug!='')
							{
							$actual_query=   "SELECT SQL_CALC_FOUND_ROWS  wp_posts.ID,wp_posts.post_title,wp_posts.post_content FROM wp_posts  INNER JOIN wp_term_relationships ON (wp_posts.ID = wp_term_relationships.object_id) INNER JOIN wp_postmeta ON ( wp_posts.ID = wp_postmeta.post_id ) 
							  INNER JOIN wp_term_taxonomy ON (wp_term_taxonomy.term_taxonomy_id=wp_term_relationships.term_taxonomy_id)
							  INNER JOIN wp_terms ON (wp_terms.term_id=wp_term_taxonomy.term_id) 							  
							  WHERE 1=1  AND ( wp_terms.slug='".$term->slug."'   
) AND wp_posts.post_type = 'ad_listing' AND (wp_posts.post_status = 'publish' OR wp_posts.post_status = 'tr_pending' OR wp_posts.post_status = 'tr_failed' OR wp_posts.post_status = 'tr_completed' OR wp_posts.post_status = 'tr_activated' OR wp_posts.post_status = 'private') GROUP BY wp_posts.ID ORDER BY wp_posts.post_date DESC LIMIT 0, 10";
							}
							else
							{
								$actual_query=   "SELECT SQL_CALC_FOUND_ROWS  wp_posts.ID,wp_posts.post_title,wp_posts.post_content FROM wp_posts  INNER JOIN wp_term_relationships ON (wp_posts.ID = wp_term_relationships.object_id) INNER JOIN wp_postmeta ON ( wp_posts.ID = wp_postmeta.post_id ) 
							  INNER JOIN wp_term_taxonomy ON (wp_term_taxonomy.term_taxonomy_id=wp_term_relationships.term_taxonomy_id)
							  INNER JOIN wp_terms ON (wp_terms.term_id=wp_term_taxonomy.term_id) 							  
							  WHERE 1=1  AND  wp_posts.post_type = 'ad_listing' AND (wp_posts.post_status = 'publish' OR wp_posts.post_status = 'tr_pending' OR wp_posts.post_status = 'tr_failed' OR wp_posts.post_status = 'tr_completed' OR wp_posts.post_status = 'tr_activated' OR wp_posts.post_status = 'private') GROUP BY wp_posts.ID ORDER BY wp_posts.post_date DESC LIMIT 0, 10";
							}


//echo $actual_query;
$actual_query1=   "SELECT SQL_CALC_FOUND_ROWS  wp_posts.ID FROM wp_posts  INNER JOIN wp_term_relationships ON (wp_posts.ID = wp_term_relationships.object_id) INNER JOIN wp_postmeta ON ( wp_posts.ID = wp_postmeta.post_id ) WHERE 1=1  AND ( 
  wp_term_relationships.term_taxonomy_id IN (11)
) AND wp_posts.post_type = 'ad_listing' AND (wp_posts.post_status = 'publish' OR wp_posts.post_status = 'tr_pending' OR wp_posts.post_status = 'tr_failed' OR wp_posts.post_status = 'tr_completed' OR wp_posts.post_status = 'tr_activated' OR wp_posts.post_status = 'private') GROUP BY wp_posts.ID ORDER BY wp_posts.post_date DESC LIMIT 0, 10";

							$custom_query=   "SELECT SQL_CALC_FOUND_ROWS  $wpdb->posts.ID FROM $wpdb->posts  INNER JOIN $wpdb->term_relationships ON ($wpdb->posts.ID = $wpdb->term_relationships.object_id) INNER JOIN $wpdb->postmeta ON ( $wpdb->posts.ID = $wpdb->postmeta.post_id ) WHERE 1=1  AND ( 
  $wpdb->term_relationships.term_taxonomy_id IN (11)
) AND $wpdb->posts.post_type = 'ad_listing' AND ($wpdb->posts.post_status = 'publish' OR $wpdb->posts.post_status = 'tr_pending' OR $wpdb->posts.post_status = 'tr_failed' OR $wpdb->posts.post_status = 'tr_completed' OR $wpdb->posts.post_status = 'tr_activated' OR $wpdb->posts.post_status = 'private') 
) GROUP BY $wpdb->posts.ID ORDER BY $wpdb->posts.post_date DESC LIMIT 0, 10";

							$querystr = "
								SELECT $wpdb->posts.* 
								FROM $wpdb->posts, $wpdb->postmeta
								WHERE $wpdb->posts.ID = $wpdb->postmeta.post_id 
								AND $wpdb->postmeta.meta_key = 'tag' 
								AND $wpdb->postmeta.meta_value = 'email' 
								AND $wpdb->posts.post_status = 'publish' 
								AND $wpdb->posts.post_type = 'post'
								AND $wpdb->posts.post_date < NOW()
								ORDER BY $wpdb->posts.post_date DESC
							 ";
							
							 //$featuredposts = $wpdb->get_results($custom_query, OBJECT);
							 $featuredposts = $wpdb->get_results($actual_query, OBJECT);
							 
 							//var_dump($featuredposts);
 
							//$loop_new =  query_posts($args);
							//add_filter( 'posts_where', 'posts_where_title', 10, 2 );
//echo $wpdb->last_query;exit;
							
	
							//while ( $loop_new->have_posts() ) : $loop_new->the_post();
							//var_dump(the_permalink());
							if ($featuredposts):
							 
								//var_dump($featuredposts);
								global $post;
								foreach ($featuredposts as $post):
								 
								//var_dump($post);
									setup_postdata($post);
							 	$pst=get_post( get_the_ID()); $meta_id = $pst->ID;
								$permalink = get_permalink(get_the_ID());
								//var_dump($permalink );
								//$horse_meta_id= $pst->ID;
								//var_dump($pst->ID);
							 	$postsql="SELECT meta_value FROM wp_postmeta WHERE meta_key='cp_type' AND post_id=".$meta_id;
							 //$postsql="SELECT meta_value FROM wp_postmeta WHERE meta_key='cp_type' ";
								  $post_details = $wpdb->get_results($postsql);
								   //var_dump($post_details);
								   
								  // echo get_post_meta('sticky',$meta_id);exit;
								  if($post_details[0]->meta_value=='buyer')

									continue;
								//var_dump($post_details);

							?>

                            <li style="height:260px; width:180px;">

										<span class="feat_left">

											<?php  cp_ad_featured_thumbnail(); ?>
											
									

										</span>

                                        <div class="clr"></div>

                                <?php /*?><p><a href="<?php the_permalink(); ?>"><?php if ( mb_strlen( get_the_title() ) >= $cp_options->featured_trim ) echo mb_substr( get_the_title(), 0, $cp_options->featured_trim ).'...'; else the_title(); ?></a>

                                </p><?php */
								//var_dump($post->post_title);
								//var_dump($post->post_content);
								
								?>
								<p><a href="<?php echo $permalink; ?>"><?php echo $post->post_title; ?></a>

                                </p>

                                <?php /*?><p style="color:#020202;"><?php echo cp_get_content_preview( 20 ); ?><a href="<?php the_permalink(); ?>" style="color:#0054a6; font-size:12px;">read more</a></p><?php */?>
								
								<?php /*?><p style="color:#020202;"><?php echo $post->post_content; ?><a href="<?php echo $permalink; ?>" style="color:#0054a6; font-size:12px;">read more</a></p><?php */?>

										

									</li>

                            <?php //endwhile;
								endforeach;
							endif;
							 ?>

							</ul>

						</div>

					</div><!-- /slider -->

					<div class="next"></div>

					<div class="clr"></div>

				</div><!-- /sliderblock -->

			</div><!-- /shadowblock -->

		</div><!-- /shadowblock_out -->
	

			<?php /*?><div id="breadcrumb">

				<?php if ( function_exists('cp_breadcrumb') ) cp_breadcrumb(); ?>

			</div><?php */?>

			<!-- left block -->
			<div class="content_left">



				<div class="shadowblock_out">

					<div class="shadowblock">

					</div><!-- /shadowblock -->

				</div><!-- /shadowblock_out -->


				<?php  get_template_part( 'loop', 'search_ad_listing' ); ?>


			</div><!-- /content_left -->


			<?php get_sidebar(); ?>


			<div class="clr"></div>

		</div><!-- /content_res -->

	</div><!-- /content_botbg -->

</div><!-- /content -->
 <?php endif;?>