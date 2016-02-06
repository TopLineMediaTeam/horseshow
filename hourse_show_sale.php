<?php
/*
Template Name: horse show sale
*/
global $wpdb;  
global $cp_options;
?>
<?php if ( $cp_options->enable_featured ) : ?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $(".pop").click(function(){
		if($(".horseshow_show img").attr('check')=='login')
		{
        $(".popup").removeClass("display");
		}
		else
		{
		window.location.href = "<?php echo site_url(); ?>/login/";
		}
    });
});
$(document).ready(function(){
	$(".pop").each(function(){
	$("#error_msg").hide();
	$("#show_id").val(''); 
	 $(".horseshow_show img").click(function(){
   		var id = $(this).attr('show');
		$("#show_id").val(id);
    	});   	
	});
});

$('div').each(function(){
   $(this).click(function(){
          if($(this).find('img').is(':visible').length){
                    $(this).find('img').fadeOut(700);
          }
          else{
                    $(this).find('img').fadeIn(700);
              }
   });
});
$(document).ready(function(){
    $("#popdown").click(function(){
		$('.p_id').attr('checked', false); 
        $(".popup").addClass("display");
		
    });
});
$(document).ready(function(){
    $("#submit").click(function(){
		if ($('.p_id').is(":checked"))
		{
			return true;
		}
		else
		{
			$("#error_msg").show();
			return false;
		}
			
	});
});
function selectValue(id) 
{ 
	$("#error_msg").text("");
   //alert(id);
  // window.location.href = 'http://localhost/horseshowsales/horse-show-sale/?id='+ encodeURIComponent(id);
   
} 
function addPost()
{
	var data= {};
	data.checkedValues = $('input:checkbox:checked').map(function() {
    return this.value;
	}).get();
	var a = $("#show_id").val();
	//alert(a);
   data.user_id = $("#user_id").val();
   data.show_id = $("#show_id").val();
  //alert(varible);
   //console.log(data.checkedValues);
	$.ajax({
		 type:  'POST',
		 url:   "<?php bloginfo('url'); ?>/wp-admin/admin-ajax.php",
		 data:  {
		   'action': 'add_horses',
		   'data' : data ,
		   }, 
		   success:function(data){
		   //alert(data);
			   if(data=='inserted0')
			   {
			   	alert("successfully added");
				$("#error_msg").text("Successfully Added");
			   }
			   else
			   {
					$("#error_msg").text("Failed To Add");
			   }
		  }
		});
}
</script>
<script src="<?php bloginfo('template_url'); ?>/includes/js/jdb_popup.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/jdb_popup.min.css" type="text/css">

<div class="content">
    <div class="content_botbg">
        <div class="content_res">
        <?php /*?><div id="breadcrumb">
        <?php if ( function_exists('cp_breadcrumb') ) cp_breadcrumb(); ?>
        </div><?php */?>
        <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/includes/js/jcarousellite.min.js"></script> 
        <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/includes/js/jcarousellite.js"></script> 
        <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/includes/js/easing.js"></script> 
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
                <h2 class="home_slider_f">Horse Shows</h2>
                <div class="sliderblockdir">
                    <div class="prev"></div>
                    <div id="sliderlist">
                        <div class="slider">
                        <ul>
                        
                        <?php 
                        
                        $sql="SELECT *FROM horseshows where status=1";
                        //echo $sql;
                        $results = $wpdb->get_results($sql);
                        foreach($results as $hresult)
                        {
                            //var_dump($results);
                            //var_dump($result);
                        ?>
                            <li style="height:260px; width:180px;"> <span class="feat_left"><img src="<?php echo $hresult->image; ?>" width="150px" height="200px"/></span>
							<?php /*?><?php echo get_avatar( get_the_author_meta( 'ID' ), 64 ); ?> </span><?php */?>
                                <div class="clr"></div>
                                <p><a href="<?php echo site_url();?>/show-details/?id=<?php echo $hresult->id; ?>"><?php echo $hresult->name_show; ?></a></p>
                                <p style="color:#020202;"><?php $string = $hresult->show_desc; $string = substr($string , 0, 20); echo $string;?>...  <a href="<?php echo site_url();?>/show-details/?id=<?php echo $hresult->id; ?>" style="color:#0054a6; font-size:12px;">read more</a></p>
                            </li>
                        <?php };?>
                        </ul>
                        </div><!-- /slider -->
                    </div><!-- /sliderlist -->
                    
                
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
			//code commented are codes for region map using interactive uS map region plugin
			# define constant, serialize array
			/*
			define ("Pacific", serialize (array ("'washington'", "'oregon'", "'california'", "'alaska'", "'hawaii'")));
			define ("Mountain", serialize (array ("'montana'", "'idaho'", "'wyoming'","'nevada'","'utah'","'colorado'","'arizona'","'new mexico'")));
			define ("wncentral", serialize (array ("'north dakota'", "'south dakota'", "'nebraska'","'kansas'","'minnesota'","'iowa'","'arizona'","'missourl'")));
			define ("wscentral", serialize (array ("'oklahoma'", "'texas'", "'arkansas'","'louisiana'")));
			define ("encentral", serialize (array ("'wisconsin'", "'lllionois'", "'indiana'","'ohio'", "'michigan'")));
			define ("escentral", serialize (array ("'kentucky'", "'tennessee'", "'mississippi'","'alabama'")));
			define ("satlantic", serialize (array ("'florida'", "'georgia'", "'south carolina'","'virginia'", "'west virginia'", "'maryland'","'delaware'", "'north carolina'")));
			define ("matlantic", serialize (array ("'newyork'", "'pennsylvania'", "'new jersey'")));
			define ("nengland", serialize (array ("'malne'", "'vermont'", "'new hampshire'", "'massachusetts'","'rhode island'","'connecticut'")));
			
			# use it
			
			//$mapsearch = isset($_POST['mapsearch'])?$_POST['mapsearch']:'';//search region map region value,currently this value is not used
			$mapsearch = isset($_REQUEST['reg'])?$_REQUEST['reg']:'';//get search map region value which is passed in url
			if($mapsearch=='West_South_Central')
			{
				$wscentral=unserialize (wscentral);
				$regionvalue=implode(',',$wscentral);
			}
			if($mapsearch=='Pacific')
			{
				$Pacific = unserialize (Pacific);
				$regionvalue=implode(',',$Pacific);
			}
			if($mapsearch=='Mountain')
			{
				$Mountain = unserialize (Mountain);
				$regionvalue=implode(',',$Mountain);
			}
			if($mapsearch=='West_North_Central')
			{
				$wncentral = unserialize (wncentral);
				$regionvalue=implode(',',$wncentral);
			}
			if($mapsearch=='East_North_Central')
			{
				$encentral = unserialize (encentral);
				$regionvalue=implode(',',$encentral);
			}
			if($mapsearch=='East_South_Central')
			{
				$Pacific = unserialize (Pacific);
				$regionvalue=implode(',',$Pacific);
			}
			if($mapsearch=='South_Atlantic')
			{
				$satlantic = unserialize (satlantic);
				$regionvalue=implode(',',$satlantic);
			}
			if($mapsearch=='Middle_Atlantic')
			{
				$matlantic = unserialize (matlantic);
				$regionvalue=implode(',',$matlantic);
			}
			if($mapsearch=='New_England')
			{
				$nengland = unserialize (nengland);
				$regionvalue=implode(',',$nengland);
			}
			*/
			$regionvalue = isset($_REQUEST['reg'])?$_REQUEST['reg']:'';//get search map region value which is passed in url using googlemap
            $search_location = isset($_POST['show_location'])?$_POST['show_location']:'';
            $search_startdate_get = isset($_POST['start_date'])?$_POST['start_date']:'';
            $search_startdate  = strtotime($search_startdate_get);
            $search_enddate_get = isset($_POST['end_date'])?$_POST['end_date']:'';
            $search_enddate  = strtotime($search_enddate_get);
            $search_management = isset($_POST['show_management'])?$_POST['show_management']:'';
            $search_horsename = isset($_POST['h_name'])?$_POST['h_name']:'';
            
            $sql="SELECT *FROM horseshows WHERE 1=1 and status=1";
            if($search_startdate_get!='' && $search_enddate_get!='')
            {
				$str = "AND show_date_time BETWEEN '$search_startdate' AND '$search_enddate'";
				$sql=$sql." ".$str;
            }
            if($search_management!='')
            {
				$str= "AND name_show='$search_management'";
				$sql=$sql." ".$str;
            }
            if($search_location!='')
            {
				$statelikequery='';
				$placelikequery='';	
				$locationlikemergedquery='';
				
				$location=explode(' ',$search_location);
				if(count($location)==1)
					$locationlikemergedquery =" AND (city like '%$location[0]%' OR state like '%$location[0]%')";
									
				if(count($location)>1)
				{
					for($i=0;$i<count($location);$i++)
					{
						if($placelikequery!='')
							$placelikequery.=' OR '; 
						$placelikequery.="city like '%".$location[$i]."%'";
						
						if($statelikequery!='')
							$statelikequery.=' OR '; 
						$statelikequery.="state like '%".$location[$i]."%'";
					}
					$locationlikemergedquery= ' AND ( '.$placelikequery.' OR '.$statelikequery.' )';
				}			
				
				//$str ="AND (city IN ('$search_location') OR state IN ('$search_location'))";
				$sql=$sql.$locationlikemergedquery;
            }
			if($regionvalue!='')
            {
				$str ="AND (city IN ('".$regionvalue."') OR state IN ('".$regionvalue."') )";
				$sql=$sql." ".$str;
            }
			
			if($_POST['showname']!='')
			{
				//showname value from search show box on homepage
				$str ="AND name_show='".$_POST['showname']."'";
				$sql=$sql." ".$str;
			}
			//echo $sql;
			$horseresults = $wpdb->get_results($sql);
			if(!empty($horseresults))
			{
			foreach($horseresults as $result)
			{
			?>
            <div class="post-block-out ">
                <div class="post-block">
                    <div class="post-lefths buyer_image"> <a href="<?php echo site_url();?>/show-details/?id=<?php echo $result->id; ?>" title="<?php the_title() ?>"> <img src="<?php echo $result->image; ?>" align="middle" /> </a> </div>
                    <div class="post-right">
                        <div class="price-wrap">
                        <?php /*?><span class="tag-head">&nbsp;</span><p class="post-price"><?php cp_get_price($post->ID, 'cp_price'); ?></p><?php */?>
                        </div>
                        <h5><a class="header_title_name" href="<?php echo site_url();?>/show-details/?id=<?php echo $result->id; ?>"><?php echo $result->name_show; ?></a></h5>
                         <?php /* ?><p><span><?php echo $result->name_show;?></span></p>  <?php */ ?>
                        <?php ?><p><span><?php echo $result->show_date_time;?></span></p><?php ?> 
                        <p><span><?php echo $result->presented_by;?></span></p>
                        <p><span><?php echo $result->address;?></span></p>
                        <p><span><?php echo $result->city;?></span></p>
                        <p><span><?php echo $result->state;?></span></p>
                        
                        <p><?php cp_get_ad_details( $post->ID, $cat_id );	?></p>
                    </div>
                             
                    <div class="post-right_icons horseshow_show">
                    	<span title="Add Horse"  class="addhorses addhorsetoshow pop" style="float:left;padding:15px;" show="<?php echo $result->id; ?>" check="<?php if ( is_user_logged_in() ) { echo "login";} ?>" onclick="selectValue(id=<?php  echo $result->id; ?>)">Add your horse <br /> to this show</span>
                        <img class="addhorses pop" title="Add Horse" show="<?php echo $result->id; ?>" onclick="selectValue(id=<?php  echo $result->id; ?>)" check="<?php if ( is_user_logged_in() ) { echo "login";} ?>" src="<?php bloginfo('template_url'); ?>/images/Icon_Stirrup.png" width="34" height="34" alt="" />
                        
                        <div class="clear"></div>
                       <a class="addhorsetoshow" style="float:left;text-decoration:none;color:#000;padding:15px;" href="<?php echo site_url();?>/show-and-horses/?id=<?php echo $result->id; ?>">View Sales Horses <br /> at this Show</a>
                        <a href="<?php echo site_url();?>/show-and-horses/?id=<?php echo $result->id; ?>"><img  src="<?php bloginfo('template_url'); ?>/images/Icon_View.png" width="34" height="34" alt="" /> </a>
                    
                    </div>
                    <div class="post-desc">
                        <?php $string = $result->show_desc; $string = substr($string , 0, 200); echo $string;?>...<a href="<?php echo site_url();?>/show-details/?id=<?php echo $result->id; ?>" style="color:#0054a6; font-size:12px;">read more</a></p>
                    </div>
                    <div class="clr"></div>
                </div>
                <!-- /post-block --> 
                          
            </div>
            <!-- /post-block-out -->
            <?php
            }
			}
			else
			{
			echo '<div style="min-height:50%;padding:30px;text-align:center;"><h1>Search results not found...</h1></div>';
			}
            ?>
        </div>
        <!-- /shadowblock_out --> 
          
    </div>
    <!-- /content_left -->
	<?php get_template_part( 'show-sidebar'); ?> 
</div>
<div class="clr"></div>
</div>
<!-- /content_res --> 
<div  class="popup display">
<div class="inner_pop">
<a  id="popdown">close</a>
    <div id="error_msg"></div>
    
    <?php 
        $user_ID = get_current_user_id();
        $args = array( 'post_type' => 'ad_listing','author' =>$user_ID,'posts_per_page' => 12);
        $loop = new WP_Query( $args );
        while ( $loop->have_posts() ) : $loop->the_post();
     ?>
     <?php $pst=get_post( get_the_ID()); $meta_id = $pst->ID;?>
     <?php $sql="SELECT meta_value FROM wp_postmeta WHERE meta_key='cp_type' AND post_id=".$meta_id;
    // echo $sql;
      $post_details = $wpdb->get_results($sql);
     // var_dump($post_details);
      if($post_details[0]->meta_value=='buyer')
        continue;?>
    <div><input type="checkbox" name="post_id[]" id="p_id" class="p_id" value="<?php echo $meta_id;?>"><?php the_title();?><br></div>
     <?php endwhile;?>
     <input type="hidden" name="user_id" value="<?php echo $user_ID; ?>" id="user_id" />
     <input type="hidden" name="show" id="show_id" value="" />
     <input type="submit" name="submit" id="submit" value="Add To Show" onclick="addPost();"/>
     
</div>
</div>
</div>


</div>
<!-- /content_botbg --> 


<?php /*?>  <a href="<?php bloginfo('template_url'); ?>/images/image01.jpg" title="bien mettre un title si vous voulez afficher une légende" id="mypopup">
	<img src="<?php bloginfo('template_url'); ?>/images/thumb01.jpg" alt="Ceci est une image !" width="310" height="250">
</a>
  
  <div data-image="<?php bloginfo('template_url'); ?>/images/image01.jpg" data-caption="bien mettre data-caption avec cette méthode" id="mypopup">
	<img src="<?php bloginfo('template_url'); ?>/images/thumb01.jpg" alt="Ceci est une image !" width="310" height="250">
  </div>
  
</div>
<script>
$("#mypopup").jdbpopup()

$("#mypopup").jdbpopup({ effect: "scale" })

$("#mypopup").jdbpopup
({
	timeOpen: 1200,
	timeClose: 800,
	easing: "snap",
	effect: "translateX",
	caption: false,
	responsive: true, 
})
  </script>
<?php */?><!-- /content -->
<?php endif; // end feature ad slider check ?>
