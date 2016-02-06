<?php
/**
 * Main loop for displaying ads
 *
 * @package ClassiPress
 * @author AppThemes
 *
 */
global $wpdb; 
global $cp_options;
?>
<?php appthemes_after_endwhile(); ?>
<?php appthemes_before_loop(); ?>
<?php /*?><?php if ( have_posts() ) : ?>
<?php while ( have_posts() ) : the_post();  ?>
<?php $pst=get_post( get_the_ID()); $meta_id = $pst->ID;?>
<?php $sql="SELECT meta_value FROM wp_postmeta WHERE meta_key='cp_type' AND post_id=".$meta_id;
      $post_details = $wpdb->get_results($sql);
	  if($post_details[0]->meta_value=='buyer')
	  	continue;

 ?>
<?php */
$flag=0;
$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
$term = get_queried_object();
if($term->slug)
	$args = array( 'post_type' => 'ad_listing','ad_cat' =>$term->slug, 'posts_per_page' =>5,'paged' => $paged,);
else
	$args = array( 'post_type' => 'ad_listing', 'posts_per_page' =>5,'paged' => $paged,);	

	
$loop = new WP_Query( $args);
while ( $loop->have_posts() ) : $loop->the_post();
$flag=1;
 $pst=get_post( get_the_ID()); $meta_id = $pst->ID;
 $sql="SELECT meta_value FROM wp_postmeta WHERE meta_key='cp_type' AND post_id=".$meta_id;
      $post_details = $wpdb->get_results($sql);
	  if($post_details[0]->meta_value=='buyer')
	  	continue; 


?>	<?php appthemes_before_post(); ?>
		<div class="post-block-out <?php cp_display_style( 'featured' ); ?>">

			<div class="post-block">

				<div class="post-left">

					<?php 
					
					
					if ( $cp_options->ad_images ) cp_ad_loop_thumbnail(); ?>

				</div>
                <span class="price_span"><?php appthemes_before_post_title(); ?></span>

				<div class="<?php cp_display_style( array( 'ad_images', 'ad_class' ) ); ?>">

					

					<h3><a href="<?php the_permalink(); ?>"><?php if ( mb_strlen( get_the_title() ) >= 75 ) echo mb_substr( get_the_title(), 0, 75 ).'...'; else the_title(); ?></a></h3>

					<div class="clr"></div>
                    <p><?php cp_get_ad_details( $post->ID, $cat_id );				
									?></p>
				</div>
                <?php $id = $post->ID;  $sql="SELECT MAX(horseshows.show_date_time) AS 'recentdate',horseshows.id,horseshows.city,horseshows.state FROM horseshows LEFT JOIN horseshows_meta ON horseshows.id=horseshows_meta.show_id WHERE horseshows_meta.post_id='$id'";
				$details = $wpdb->get_results($sql);
				$recentdate = $details[0]->recentdate;
				 $sql1="SELECT id,name_show,city,state,image FROM horseshows WHERE show_date_time='$recentdate'";
					$details1 = $wpdb->get_results($sql1);
					//print_r($details1);
				?>
				
				<div class="show_time"><p><span style="font-weight:bold;"><?php echo $details1[0]->name_show;?></span></br><img src="<?php echo $details1[0]->image;?>"></p></div>
                <!--<div class="show_time"><p>Next Show:<span style="font-weight:bold;"><?php if(!empty($details[0]->id)){ echo $details[0]->recentdate.'</br>'.$details1[0]->city.','.$details1[0]->state; }else echo "not added in show"; ?></span></p></div>-->
                <div style="clear:right"></div>
                <div class="post-right_icons" style="width:auto">
                <div style="text-align:center; font-weight:bold;margin-bottom: 10px;font-size: 16px;margin-left: 30px;">Share!</div>
                <style>.lrshare_iconsprite32.lrshare_sharingcounter32{display:none;}
				.lrshare_iconsprite32.lrshare_evenmore32{display:none;}
               .simplefavorite-button{background-color: transparent;border: 0;padding:0;}
			   .lrshare_interfacehorizontal{    padding-top: 0;}
                </style>
				<div style="float:left;"><?php echo do_shortcode( '[favorite_button post_id="'.$id.'" site_id=""]' ); ?></div>
				<?php /*?><?php if($results[0]->phone!=''){?><div style="float:left;"><a href="tel:<?php echo $results[0]->phone; ?>"><img  src="<?php bloginfo('template_url'); ?>/images/post_phone.png" width="34" height="34" alt="" /></a></div><?php } ?><?php */?>
				<!--shortcode for social share using social share plugin-->
				<div style="float:left;"><?php echo do_shortcode( '[LoginRadius_Share]' ); ?></div>
                <?php /*?><img  src="<?php bloginfo('template_url'); ?>/images/post_msg.png" width="34" height="34" alt="" /> 
                <img  src="<?php bloginfo('template_url'); ?>/images/post_phone.png" width="34" height="34" alt="" />
		<img  src="<?php bloginfo('template_url'); ?>/images/post_fev.png" width="34" height="34" alt="" /><?php */?>
		
		
		
		
		<style>
                .widget-container{
				list-style:none;
				}
                </style>
                <?php 
      // Custom widget area start
      if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Custom Widget Area') ) : ?>
<?php endif; ?></div>

				<div class="clr"></div>
                
                
                <div class="post-desc"><?php echo cp_get_content_preview( 20 ); ?><p style="color:#020202;"><a href="<?php echo the_permalink(); ?>" style="color:#0054a6; font-size:12px;text-decoration:none;">read more..</a></p> </div>

			</div><!-- /post-block -->

		</div><!-- /post-block-out -->  
		<?php appthemes_after_post(); ?>

	<?php endwhile; ?>
    <?php if($flag==0)echo '<div style="min-height:50%;padding:30px;text-align:center;"><h1>Search results not found...</h1></div>';?>
	<?php appthemes_after_endwhile(); ?>

<?php /*?><?php else: ?>

	<?php appthemes_loop_else(); ?>

<?php endif; ?>
<?php */?>
<?php appthemes_after_loop(); ?>

<?php wp_reset_query(); ?>
