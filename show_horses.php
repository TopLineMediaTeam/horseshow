<?php
/*
Template Name: show and horses
*/
global $wpdb;  
global $cp_options;
?>
<?php if ( $cp_options->enable_featured ) : ?>
<?php
			$sid = $_GET['id'];
			$sql="SELECT *FROM horseshows WHERE id='$sid'";
			$results = $wpdb->get_results($sql);
			//var_dump($results);
			
		?>
  <style type="text/css">
  .banner_show h2 a{    margin-left: 25%!important;}
.tabs {
      width: 94%;
	  display: inline-block;
	  background-color: #fff;
	  margin: 3%;
	  border-radius:8px;
}
 
    /*----- Tab Links -----*/
    /* Clearfix */
    .tab-links:after {
        display:block;
        clear:both;
        content:'';
    }
 
    .tab-links li {
        margin:0;
        float:left;
        list-style:none;
		background:none !important;
		border-bottom:none !important;
	    padding: 7px 5px 0 15px !important;
	    text-shadow:none !important;
    }
 
        .tab-links a {
            padding:9px 15px;
            display:inline-block;
            border-radius:3px 3px 0px 0px;
            background:#9D0707;
            font-size:16px;
            font-weight:600;
            color:#fff;
            transition:all linear 0.15s;
        }
 
        .tab-links a:hover {
            background:#9D0707;
            text-decoration:none;
        }
 
    li.active a, li.active a:hover {
          background: #252424;
  color: #FFFFFF;
    }
 
    /*----- Content of Tabs -----*/
    .tab-content {
        margin:0 15px 15px 15px;
		padding:10px 0 10px 0;
        border-radius:none;
        box-shadow:-1px 1px 1px rgba(0,0,0,0.15);
        background:#EFEFEF;
    }
	.tab-content table {
		width:96%;
		margin: 2%;  
		border: 5px solid #FFF;
  		background-color: #fff;
	}
 
        .tab {
            display:none;
        }
 
        .tab.active {
            display:block;
        }
		.pad5{
			padding:5px;
			width:20%;
		}
		.month_hs{
			font-size: 16px;
			  padding: 5px 0;
			  text-align: center;
			  font-weight: 600;
		}
		.date_hs{
			text-align: center;
			  font-size: 28px;
			  font-weight: 700;
			  padding:0;
		}
		.day_hs{
			font-size: 16px;
			  padding: 5px 0;
			  text-align: center;
			  font-weight: 600;
			  color:#999;
		}
		.td_hs{
			  background-color: #ccc;
  vertical-align: middle;
		}
		.tr_hs{
			padding-bottom:10px;
			border-bottom:1px solid #FFF;
		}
		.second p{
			padding: 0 0 0 10px;
		}
		.more_info{
		    padding: 5px;
			background-color: #2271BE;
			color: #fff;
			line-height: 15px;
			border-radius: 5px;
			float: right;
		}
		
</style>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
<script type="text/javascript">
jQuery(document).ready(function() {
    jQuery('.tabs .tab-links a').on('click', function(e)  {
        var currentAttrValue = jQuery(this).attr('href');
 
        // Show/Hide Tabs
        jQuery('.tabs ' + currentAttrValue).show().siblings().hide();
 
        // Change/remove current tab to active
        jQuery(this).parent('li').addClass('active').siblings().removeClass('active');
 
        e.preventDefault();
    });
});
</script>

<script src="<?php bloginfo('template_url'); ?>/includes/js/jdb_popup.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/jdb_popup.min.css" type="text/css">
<script language=javascript src='http://maps.google.com/maps/api/js?sensor=false'></script>
<script type="text/javascript">
   function initialize(){
     var myLatlng = new google.maps.LatLng(<?php echo $results[0]->latitude; ?>,<?php echo $results[0]->longitude;?>);
     var myOptions = {
         zoom: 5,
         center: myLatlng,
         mapTypeId: google.maps.MapTypeId.ROADMAP
         }
      map = new google.maps.Map(document.getElementById("map"), myOptions);
      var marker = new google.maps.Marker({
          position: myLatlng, 
          map: map,
      title:"Fast marker"
     });
} 

google.maps.event.addDomListener(window,'load', initialize);
    </script>

<style>
a.badge:focus, a.badge:hover {
    color: #fff;
    text-decoration: none;
    cursor: pointer;
}
.closebtn {
    /*position: absolute;*/
    right: 7px;
    top: -6px;
	text-decoration:none;
}
.badge {
    display: inline-block;
    min-width: 10px;
    padding: 3px 7px;
    font-size: 12px;
    font-weight: 700;
    line-height: 1;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    background-color: #777;
    border-radius: 10px;
}
.photo a{width:0px!important;height:auto!important;}
</style>

<script type="text/javascript">

function removehorsefromshow(postid,showid,user)
{
	var elementdivname = ".horseblock_"+postid;
	// call an ajax remove function
	//$(elementdivname).remove();
	var result = window.confirm('Are you sure you want to delete this horse from show?');
	if (result == false) {
		e.preventDefault();
	}
	else
	{
		$.ajax({
				url: '<?php echo admin_url( "admin-ajax.php" )?>?action=removehorses_from_show_function&pid='+postid+'&uid='+user+'&sid='+showid,
				datatype: "json",
				type: 'post',
				success: function (data) {
				$(elementdivname).hide();
				}
		})
	
	}
		
}

</script>
<div class="content">
  <div class="content_botbg">
    <div class="content_res">
      <div class="clear"> 
        <!-- featured listings -->
        
        <!-- /shadowblock_out -->
        <style>
        .banner_show h2{
		font-size:24px;
		padding-top:0;
		}
		.banner_show h2 a{
		font-size:16px;
		font-family:"Times New Roman", Times, serif;
		margin-left:35%;
		}
		.img_hs_left{
		float:left;
		margin-left:10px;
		margin-right:10px;
		width:30%;
		min-width: 400px;
  		height: 195px;
		overflow:hidden;
		}
		.par_hs_right{
		float:left;
		width:40%;
		}
		.hs_map{
		float:left;
		width:25%;
		}
		#map{
		float:right;
		width:25%;
		}
        </style>
         
        <div class="shadowblock_out slider_top feateadrd_ad" style="  margin-bottom: 20px;">
          <div class="shadowblockdir banner_show">
            <h2 class="home_slider_f"><?php echo $results[0]->name_show; ?><a href="<?php echo site_url(); ?>/horse-show-sale/" style="text-decoration:none;">&lt;&lt;Back to Results</a> <style>
				.widget-container{
					list-style:none;
				}
			</style>
            <div style="width:auto;float: right;">
            <style>.lrshare_interfacehorizontal{padding:0;}.lrshare_iconsprite32.lrshare_sharingcounter32{display:none;}.lrshare_iconsprite32.lrshare_evenmore32{display:none;}</style>
            <?php /*?><div style="float:left;"><?php echo do_shortcode( '[favorite_button post_id="'.$id.'" site_id=""]' ); ?></div><?php */?>
            <?php if($results[0]->phone!=''){?><div style="float:left;"><a href="tel:<?php echo $results[0]->phone; ?>"><img  src="<?php bloginfo('template_url'); ?>/images/post_phone.png" width="34" height="34" alt="" /></a></div><?php } ?>
            <!--shortcode for social share using social share plugin-->
            <div style="float:left;"><?php echo do_shortcode( '[LoginRadius_Share]' ); ?></div>
            <div class="clr"></div>
            </div>
            
            
            
			<?php
				if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Custom Widget Area') ) : ?>
<?php endif; ?>
			<?php /*?><img src="<?php bloginfo('template_url'); ?>/images/icons.png" alt="" align="right" /><?php */?></h2>
            <div class="sliderblockdir">
              <div class="img_hs_left" style="height:auto;"><img src="<?php echo $results[0]->image; ?>"  alt="" style="max-width:100%"/></div>
              <div class="par_hs_right">
<?php /*?>			  <p style="font-weight:bold;"><?php echo 'Presented By: '.$results[0]->presented_by; ?></p>
<?php */?>              
			  <p style="font-weight:bold;"><?php echo $results[0]->show_date_time; ?></p>
              <p style="color:#930"><?php echo $results[0]->address; ?></p> 
              <p style="color:#930"><?php echo $results[0]->city.",".$results[0]->state; ?></p>
 
              <?php if($results[0]->email!=''){?><p style="color:#930"><?php echo 'Email: '.$results[0]->email; ?></p><?php } ?>
              <?php if($results[0]->website!=''){?><p style="color:#930"><a href="<?php echo $results[0]->website; ?>"><?php echo $results[0]->website; ?></a></p><?php } ?>
              <p><?php echo $results[0]->show_desc; ?></p>
              
              </div>
              <div id="map" style="width:250px; height:200px;"></div>
              
            </div>
            <!-- /sliderblock --> 
            
          </div>
          <!-- /shadowblock --> 
          
        </div>
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
			$i=0;
			$sid = $_GET['id'];
			$sql="SELECT post_id FROM horseshows_meta WHERE show_id='$sid'";
					//echo $sql;
					$results_horses = $wpdb->get_results($sql);
					
					foreach($results_horses as $result_horse)
					{
						//if($i<5)
						//{
					$id = $result_horse->post_id;
					$post_data = get_post($id); 
					//var_dump($post_data);
					$title = $post_data->post_title;
					$post_name = $post_data->post_name;
					$post_content = $post_data->post_content
					//var_dump($title);
					
					
					
					

?>
            <div class="post-block-out horseblock_<?php echo $id; ?>">

			<div class="post-block">

				<div class="post-left">

					<?php 
					$current_user = wp_get_current_user();
					cp_ad_loop_thumbnail_custom($id); 
					?>

				</div>
                <?php if($current_user->ID==$post_data->post_author)
				{?>
				<span class="removehorsefromshow" style="float:right;" id="photo_<?php echo $id; ?>"><a title="Remove horse" class="badge closebtn" onclick="removehorsefromshow('<?php echo $id; ?>','<?php echo $sid; ?>','<?php echo $current_user->ID; ?>');">Remove horse</a></span>
				<?php } 
				?>
                <span class="price_span" style="float:right;">Price:<?php cp_get_price( $id, 'cp_price' );?>&nbsp;&nbsp;</span>
                
                
                
				<div class="<?php cp_display_style( array( 'ad_images', 'ad_class' ) ); ?>">

					

					<h3><a href="<?php the_permalink(); ?>/<?php echo $post_name;?>"><?php echo $title; ?></a></h3>

					<div class="clr"></div>
                    <p><?php cp_get_ad_details( $id, $cat_id );	
									?></p>
				</div>
                <?php $sql="SELECT MAX(horseshows.show_date_time) AS 'recentdate',horseshows.id,horseshows.city,horseshows.state FROM horseshows LEFT JOIN horseshows_meta ON horseshows.id=horseshows_meta.show_id WHERE horseshows_meta.post_id='$id'";
				$details = $wpdb->get_results($sql);
				$recentdate = $details[0]->recentdate;
				 $sql1="SELECT id,name_show,city,state FROM horseshows WHERE show_date_time='$recentdate'";
					$details1 = $wpdb->get_results($sql1);
				
				?>
                <div style="width: 28%; float: right; padding: 10px 0;"><p style="text-align: right;">Next Show:<span style="font-weight:bold;"><?php if(!empty($details[0]->id)){ echo $details[0]->recentdate.'</br>'.$details1[0]->city.','.$details1[0]->state; }else echo "not added in show"; ?></span></p></div>
                <div class="post-right_icons" style="width:auto">
					<style>
					.lrshare_iconsprite32.lrshare_sharingcounter32{display:none;}
					.lrshare_iconsprite32.lrshare_evenmore32{display:none;}
					.simplefavorite-button{background-color: transparent;border: 0;padding:0;}
                    </style>
                    <div style="float:left;"><?php echo do_shortcode( '[favorite_button post_id="'.$id.'" site_id=""]' ); ?></div>
                    <?php if($results[0]->phone!=''){?><div style="float:left;"><a href="tel:<?php echo $results[0]->phone; ?>"><img  src="<?php bloginfo('template_url'); ?>/images/post_phone.png" width="34" height="34" alt="" /></a></div><?php } ?>
                    <!--shortcode for social share using social share plugin-->
                    <div style="float:left;"><?php echo do_shortcode( '[LoginRadius_Share]' ); ?></div>
                
                <?php /*?><img  src="<?php bloginfo('template_url'); ?>/images/post_msg.png" width="34" height="34" alt="" /> 
                <img  src="<?php bloginfo('template_url'); ?>/images/post_phone.png" width="34" height="34" alt="" /> 
                <img  src="<?php bloginfo('template_url'); ?>/images/post_fev.png" width="34" height="34" alt="" /><?php */?> 
                </div>

				<div class="clr"></div>
                
                
                <div class="post-desc"><?php $string = $post_content; $string = substr($string , 0, 200); echo $string; ?>...<a href="<?php echo site_url();?>/<?php echo $post_name;?>" style="color:#0054a6; font-size:12px; text-decoration:none;">read more</a></div>

			</div><!-- /post-block -->

		</div>
            <!-- /post-block-out -->
            <?php
			$i++;
					//}
					};
?>
          </div>
          <!-- /shadowblock_out --> 
          
        </div>
        <!-- /content_left -->
        
        <div class="content_right">
          <!--<div class="top_block_advance_search">
        		<div class="search_ad_block">
               	  <div class="refine_icon">
                    </div>
                    <div class="advance_search_box_content">
                        <h1>Refine Search</h1>
                        <input  type="text" placeholder="Zip or Location" />
                        <label>
                            <select>
                                <option selected> Select Box </option>
                                <option>Short Option</option>
                                <option>This Is A Longer Option</option>
                            </select>
                        </label>
                        <label>
                            <select>
                                <option selected> Select Box </option>
                                <option>Short Option</option>
                                <option>This Is A Longer Option</option>
                            </select>
                        </label>
                        <label><p class="re_sr_name">Horse Name</p></label>
                      <input  type="text" placeholder="Zip or Location" />
                        <label>
                            <select>
                                <option selected> Select Box </option>
                                <option>Short Option</option>
                                <option>This Is A Longer Option</option>
                            </select>
                        </label>
                        <label>
                            <select>
                                <option selected> Select Box </option>
                                <option>Short Option</option>
                                <option>This Is A Longer Option</option>
                            </select>
                        </label>
                        <label>
                            <select>
                                <option selected> Select Box </option>
                                <option>Short Option</option>
                                <option>This Is A Longer Option</option>
                            </select>
                        </label>
                        <label>
                            <select>
                                <option selected> Select Box </option>
                                <option>Short Option</option>
                                <option>This Is A Longer Option</option>
                            </select>
                        </label>
                         <label><p class="re_sr_name">Horse Name</p></label>
                        <label>
                            <select>
                                <option selected> Select Box </option>
                                <option>Short Option</option>
                                <option>This Is A Longer Option</option>
                            </select>
                        </label>
                         <label><p class="re_sr_name">Horse Name</p></label>
                      <input  type="text" placeholder="Zip or Location" />
                        <label>
                            <select>
                                <option selected> Select Box </option>
                                <option>Short Option</option>
                                <option>This Is A Longer Option</option>
                            </select>
                        </label>
                        <a href="#">Advace search</a>
                        <input type="submit" class="width30" value="Search" />
                        
                    </div>
                </div>
        
        </div>-->
        								
        	<div class="tabs">
                <ul class="tab-links">
                    <li class="active"><a href="#tab1">Upcoming</a></li>
                    <li><a href="#tab2">Just Announced</a></li>
                </ul>
             
                <div class="tab-content">
                    <div id="tab1" class="tab active">
                     <table>
                     <!--<tr>
                        <td class="pad5">Date</td>
                        <td class="pad5">Event</td>
                        <td class="pad5"></td>
                     </tr>-->
                      
                        <?php 
                    $sql="SELECT *FROM horseshows";
                    $results = $wpdb->get_results($sql);
                    $i=0;
                    foreach($results as $result)
                    {
                    if($i<2)
                    {
                    ?>
                      <tr class="tr_hs">
                      <td class="td_hs">
                      <?php /*?><?php 
                      $show_date =  $result->show_date_time; 
                      $show_date_split= explode("-",$show_date);
                      $time=strtotime($show_date);
                      $month=date("F",$time);
                      $string=substr($month, 0,3);
                      $show_date_split[0];
                      $day=date("D",$time);
                      ?>
                      <p class="month_hs"><?php echo $string;?></p>
                      <p class="date_hs"><?php echo $show_date_split[0];?></p>
                      <p class="day_hs"><?php echo $day;?></p><?php */?>
                      <?php
					  $show_date_get =  $result->show_date_time; 
					  $show_date_split_to = explode(" to ",$show_date_get);
					  $show_date_split_space = explode(" ",$show_date_split_to[0]);
					  $date=date_create($show_date_split_space[0]);
					  $dateconverted_month_date=date_format($date,"M/d/Y");
					  $dateconverted_M_D_Y=date_format($date,"m/d/Y");
					  $datesplitbyslash_month_date=explode("/",$dateconverted_month_date);
					  ?>
					  <?php if($show_date_get!=" to "){?>
					  <p class="month_hs"><?php echo $datesplitbyslash_month_date[0].' '.$datesplitbyslash_month_date[1];?></p>
					  <p class="date_hs" style="font-size: 10px;"><?php echo $dateconverted_M_D_Y;?></p>
					  <?php } ?>
                      </td>
                      <td class="second"><p><?php echo $result->name_show;?></p>
                      <p><?php echo $result->presented_by;?></p>
                      <p><?php echo $result->city.",".$result->state;?></p>
                      </td>
                      <td><a class="more_info" href="<?php echo site_url();?>/show-details/?id=<?php echo $result->id; ?>">MORE INFO</a></td>
                      </tr>
                    <?php $i++; } }?>
                     </table>
        
                    </div>
                    <div id="tab2" class="tab">
                        <table>
                       <!--<tr>
                        <td class="pad5">Date:</td>
                        <td class="pad5">Event</td>
                        <td class="pad5"></td>
                     </tr>-->
                      
                        <?php 
                    $sql="SELECT *FROM horseshows";
                    $results = $wpdb->get_results($sql);
                    $i=0;
                    foreach($results as $result)
                    {
                    if($i<2)
                    {
                    ?>
                      <tr class="tr_hs">
                      <td class="td_hs">
                      <?php /*?><?php 
                      $show_date =  $result->show_date_time; 
                      $show_date_split= explode("-",$show_date);
                      $time=strtotime($show_date);
                      $month=date("F",$time);
                      $show_date_split[0];
                      $day=date("D",$time);
                      ?>
                      <p class="month_hs"><?php echo $string;?></p>
                      <p class="date_hs"><?php echo $show_date_split[0];?></p>
                      <p class="day_hs"><?php echo $day;?></p><?php */?>
                      
                      <?php
					  $show_date_get =  $result->show_date_time; 
					  $show_date_split_to = explode(" to ",$show_date_get);
					  $show_date_split_space = explode(" ",$show_date_split_to[0]);
					  $date=date_create($show_date_split_space[0]);
					  $dateconverted_month_date=date_format($date,"M/d/Y");
					  $dateconverted_M_D_Y=date_format($date,"m/d/Y");
					  $datesplitbyslash_month_date=explode("/",$dateconverted_month_date);
					  ?>
					  <?php if($show_date_get!=" to "){?>
					  <p class="month_hs"><?php echo $datesplitbyslash_month_date[0].' '.$datesplitbyslash_month_date[1];?></p>
					  <p class="date_hs" style="font-size: 10px;"><?php echo $dateconverted_M_D_Y;?></p>
					  <?php } ?>
                      </td>
                      <td class="second"><p><?php echo $result->name_show;?></p>
                      <p><?php echo $result->presented_by;?></p>
                      <p><?php echo $result->city.",".$result->state;?></p>
                      </td>
                      <td><a class="more_info"  href="<?php echo site_url();?>/show-details/?id=<?php echo $result->id; ?>">MORE INFO</a></td>
                      </tr>
                    <?php  $i++; } }?>
                     </table>
                    </div>
                </div>
            </div>

          </div>
      </div>
      				

      <div class="clr"></div>
    </div>
    <!-- /content_res --> 
  </div>
  </div>
  <!-- /content_botbg --> 
<?php endif; // end feature ad slider check ?>
