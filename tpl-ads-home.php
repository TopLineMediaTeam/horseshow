<?php
// Template Name: Ads Home Template?>
<div class="content">
  <div class="content_botbg">
    <div class="content_home">
      <div class="top_block_home">
        <div class="top_block_content">
          <div class="block_content_search">
            <div class="block_content_search_box">
              <div class="search_box_star"></div>
              <div class="search_box_content">
                <h1>Match-At-Show</h1>
                <p>Connect with prospective ponies in-person and in-action at a show near you with our exclusive Match-At-Show search. Find horse shows in your area and track which horses will be there along with horse stats and show information.</p>
              </div>
              <div class="clr"></div>
              <h2>Search Shows</h2>
              
              
              <form id="search-form" method="post" action="<?php echo site_url(); ?>/horse-show-sale">
                <input type="text" name="showname" id="showname"/>
                <input type="submit" name="searchshows_btn" value="Search" />
              </form>
              	
			
            
		
				
				<?php
                if($_POST['searchshows_btn'])
                {
                	$search_show = isset($_POST['showname'])?$_POST['showname']:'';
                }
                ?>
              <p></p>
            </div>
          </div>
          <div class="block_content_map" style="padding:3% 4%;">
            <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=false&amp;key=ABQIAAAAPDUET0Qt7p2VcSk6JNU1sBSM5jMcmVqUpI7aqV44cW1cEECiThQYkcZUPRJn9vy_TWxWvuLoOfSFBw" type="text/javascript"></script>
			<script src="<?php echo site_url(); ?>/map/epoly2.js" type="text/javascript"> </script>
            <h2 style="
    mar: 21px;
    position: absolute;
    margin-top: 12px;
    margin-left: 145px;
    z-index: 10000;
    font-size: 25px;">Click region for Sale Horses at Horse Shows</h2>        
            <div id="map" name="map" style="width: auto;height:400px;"></div>
            <script type="text/javascript">
			//<![CDATA[
			
		
			if (GBrowserIsCompatible()) {
		
			  var polys = [];
			  var labels = [];
			  // Display the map, with some controls and set the initial location 
			  var map = new GMap2(document.getElementById("map"));
			  map.addControl(new GLargeMapControl());
			  map.addControl(new GMapTypeControl());
			  map.setCenter(new GLatLng(42.16,-100.72),4);
		
			  GEvent.addListener(map, "click", function(overlay,point) {
				var T1 = new Date();
				if (!overlay) {
				  for (var i=0; i<polys.length; i++) {
					if (polys[i].Bound.contains(point)) {
					  if (polys[i].Contains(point)) {
						var area = polys[i].Area()/1000000;
						var sqmiles = area/2.58998811;
						var T2 = new Date();
						map.openInfoWindowHtml(point,"You clicked on "+labels[i]+"<br>The area of "+labels[i]+" is "+parseInt(area)
							+" sq km.<br>that's "+parseInt(sqmiles)+" square miles<br>"
							+"Its boundary is "+parseInt(polys[i].Distance()/1609.344)+" miles long"
							+"<hr>Time taken = "+(T2.getTime()-T1.getTime())+" milliseconds"
						);
						window.location.href='<?php echo site_url(); ?>/horse-show-sale/?reg='+labels[i];
					  }
					}
				  }
				}
			  });
			  
			  // Read the data from states.xml
			  var request = GXmlHttp.create();
			  request.open("GET", "<?php echo site_url(); ?>/map/states.xml", true);
			  request.onreadystatechange = function() {
				if (request.readyState == 4) {
				  var xmlDoc = GXml.parse(request.responseText);
				  // ========= Now process the polylines ===========
				  var states = xmlDoc.documentElement.getElementsByTagName("state");
		
				  // read each line
				  for (var a = 0; a < states.length; a++) {
					// get any state attributes
					var label  = states[a].getAttribute("name");
					var colour = states[a].getAttribute("colour");
					// read each point on that line
					var points = states[a].getElementsByTagName("point");
					var pts = [];
					var bound = new GLatLngBounds()
					for (var i = 0; i < points.length; i++) {
					   pts[i] = new GLatLng(parseFloat(points[i].getAttribute("lat")),
										   parseFloat(points[i].getAttribute("lng")));
					   bound.extend(pts[i]);
					}
					var poly = new GPolygon(pts,"#000000",1,1,colour,0.5,{clickable:false});
					polys.push(poly);
					labels.push(label);
					map.addOverlay(poly);
					poly.Bound = bound;
				  }
				}
			  }
			  request.send(null);
			}
			
			// display a warning if the browser was not compatible
			else {
			  alert("Sorry, the Google Maps API is not compatible with this browser");
			}
		
			// This Javascript is based on code provided by the
			// Community Church Javascript Team
			// http://www.bisphamchurch.org.uk/   
			// http://econym.org.uk/gmap/
		
			//]]>
			
			</script>

          
			<?php //echo free_usa_map_plugin_content('[freeusregionmap01]'); ?>
            
            <?php /*?><form id="search-form" action="<?php echo site_url(); ?>/horse-show-sale" method="post">
            <input type="hidden" id="mapsearch" name="mapsearch"/>
            <!--<input type="submit" value="Search" style="  float: right;margin-right: -170px;margin-top: 35px;" name="show_search"/>-->
            </form><?php */?>
            <?php
            /*if($_POST['show_search'])
            {
            $search_location = isset($_POST['mapsearch'])?$_POST['mapsearch']:'';
            }*/
            ?>
          
          </div>
        </div>
        <div class="top_block_advance_search">
          <div class="search_ad_block">
            <div class="advance_search_box_star"> </div>
            <div class="advance_search_box_content">
              <?php							 
			  $sql1="SELECT field_values FROM wp_cp_ad_fields WHERE field_name='cp_breed'";							 
			  $sql2="SELECT field_values FROM wp_cp_ad_fields WHERE field_name='cp_discipline'";							 
			  $discipline = $wpdb->get_results($sql2);							 
			  $discip_values = $discipline[0]->field_values;							 
			  $discip_array = explode(',', $discip_values);							 
			  //var_dump($myArray);     						 
			  $breeds = $wpdb->get_results($sql1);							 
			  $breeds_values = $breeds[0]->field_values;							 
			  $breeds_array = explode(',', $breeds_values);							 
			  if($_POST['hunter_search'])							 
			  {							 	
				  $horse_location = $_POST['cp_state'];							 	
				  $horse_breed = $_POST['cp_breed'];								
				  $horse_discip = $_POST['cp_discipline'];							 	
				  //wp_redirect( site_url()."/ad-category/hunters/?cp_breed='$horse_breed'&cp_discipline='$horse_discip'&cp_state='$horse_location'" );	
				  wp_redirect( site_url()."/ad-category/'$horse_discip'/?cp_breed='$horse_breed'&cp_discipline='$horse_discip'&cp_state='$horse_location'" );	
			  }							 
			  if($_POST['dressage_search'])							 
			  {							 	
				  $dressage_location = $_POST['cp_state'];								
				  $dressage_breed = $_POST['cp_breed'];								
				  $dressage_discip = $_POST['cp_discipline'];							 	
				  wp_redirect( site_url()."/ad-category/dressage/?cp_breed='$dressage_breed'&cp_discipline='$dressage_discip'&cp_state='$dressage_location'" );							 			  }				
			  if($_POST['buyer_search'])							 
			  {							 	
				  $buyer_location = $_POST['location'];								
				  $buyer_breed = $_POST['buyer_breed'];								
				  $buyer_discip = $_POST['buyer_discip'];							 	
				  //wp_redirect( site_url()."/buyer/?breed='$buyer_breed'&discipline='$buyer_discip'&location='$buyer_location'" );	
			  }			   ?>
              <form method="get" id="searchform" name="huntersearch" class="hunter_search" action="<?php echo site_url(); ?>/search/?s=&cp_type=seller">
                <h1>Search Horses/Ponies</h1>
                <input type="text" placeholder="Zip or Location" value="" name="cp_state" class="searchloc" />
                <input type="hidden" value="seller" name="cp_type" />
                <input type="hidden" value="" name="s" />
                <label> <!--<select name="horse_breed">-->
                  <select name="cp_breed">
                    <option selected="selected" value="">breed</option>
                    <?php foreach($breeds_array as $breed){?>
                    <option value="<?php echo $breed;?>"><?php echo $breed;?></option>
                    <?php }?>
                  </select>
                </label>
                <label> <!--<select name="horse_discip">-->
                  <select name="cp_discipline">
                    <option selected="selected" value="">discipline</option>
                    <?php foreach($discip_array as $discip){?>
                    <option value="<?php echo $discip;?>"><?php echo $discip;?></option>
                    <?php }?>
                  </select>
                </label>
                <input type="submit" value="Search" name="hunter_search" id="hunter_search" />
                <a href="<?php echo site_url();?>/ad-category/hunters/">Advanced search</a>
              </form>
            </div>
          </div>
          <?php /*?><div class="search_ad_block" style="display:none">
            <div class="advance_search_box_star"> </div>
            <div class="advance_search_box_content">
              <form method="post" id="searchform" action="#">
                <h1>Search Dressage</h1>
                <input  type="text" placeholder="Zip or Location"  name="cp_state"/>
                <label> <!--<select name="dressage_breed">-->
                  <select name="cp_breed">
                    <option selected="selected" value="">breed</option>
                    <?php foreach($breeds_array as $breed){?>
                    <option value="<?php echo $breed;?>"><?php echo $breed;?></option>
                    <?php }?>
                  </select>
                </label>
                <label> <!--<select name="dressage_discip">-->
                  <select name="cp_discipline">
                    <option selected="selected" value="">discipline</option>
                    <?php foreach($discip_array as $discip){?>
                    <option value="<?php echo $discip;?>"><?php echo $discip;?></option>
                    <?php }?>
                  </select>
                </label>
                <input type="submit" value="Search" name="dressage_search" />
                <a href="<?php echo site_url();?>/ad-category/dressage/">Advanced search</a>
              </form>
            </div>
          </div><?php */?>
          <div class="search_ad_block">
            <div class="advance_search_box_star"> </div>
            <div class="advance_search_box_content">
              <form method="post" id="searchform" action="<?php echo site_url().'/buyer'; ?>">
                <h1>Find a Buyer/leaser</h1>
                <!--<input  type="text" placeholder="Zip or Location" name="location" />-->
                <input  type="text" placeholder="Zip or Location" name="buyer_location" />
                <input type="hidden" value="buyer" name="cp_type" />
                <label> <!--<select name="buyer_breed">-->
                  <select name="breed">
                    <option selected="selected" value="">breed</option>
                    <?php foreach($breeds_array as $breed){?>
                    <option value="<?php echo $breed;?>"><?php echo $breed;?></option>
                    <?php }?>
                  </select>
                </label>
                <label> <!--<select name="buyer_discip">-->
                  <select name="discip">
                    <option selected="selected" value="">discipline</option>
                    <?php foreach($discip_array as $discip){?>
                    <option value="<?php echo $discip;?>"><?php echo $discip;?></option>
                    <?php }?>
                  </select>
                </label>
                <input type="submit" value="Search" name="buyer_search" />
                <a href="<?php echo site_url();?>/buyer/">Advanced search</a>
              </form>
            </div>
          </div>
          <div class="search_ad_block" >
           	<a href="<?php echo site_url().'/add-new'; ?>"><img src="<?php echo get_template_directory_uri().'/images/post-your-ad.png'; ?>"></a>
          </div>
        </div>
      </div>
      <div class="feateadrd_ad clear">
        <?php get_template_part( 'featured' ); ?>
      </div>
      <div class="feateadrd_ad clear home_bottom" style="background-color:#fff; padding-bottom: 20px;"> <!-- left block -->
        <div class="content_left" style="width:100%; background-color:#fff;">
          <div class="recent-post home_update">
            <h1>Latest News & Information</h1>
            <?php $first_query = new WP_Query('category_name=news&posts_per_page=10'); ?>
            <?php while ($first_query->have_posts()) : $first_query->the_post(); ?>
            <h2>
            <a href="<?php the_permalink(); ?>">
              <?php the_title();?>
            </a>
            </h2>
            <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail();?>
            </a>
            <?php the_excerpt() ?>
            <?php endwhile;?>
          </div>
          <?php get_sidebar(); ?>
        </div>
        <!-- /content_left --> </div>
      <div class="clr"></div>
    </div>
    <!-- /content_res --> </div>
  <!-- /content_botbg --> </div>
<!-- /content --> 
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css"/>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"> </script>
<script>
jQuery(document).ready(function(){
	jQuery("#showname").autocomplete({ source: '<?php echo admin_url( "admin-ajax.php" )?>?action=custom_select_shows_function',
	delay: 500
	});	
	
});			
jQuery(document).ready(function(){	
	jQuery( ".searchloc" ).change(function() {
	  //jQuery( ".hunter_search" ).submit(function( event ) {
	  //alert( "Handler for .submit() called." );
	  var val=jQuery(".searchloc").val();
	  var getNum = val.match(/(\d+)/g);
	  //alert(getNum);
	  var isnumeric=jQuery.isNumeric(val);
	  //alert(isnumeric);
	  if(isnumeric)
	  {
	   jQuery(".searchloc").attr("name","cp_city_zipcode");	
	  }
	});	
});			
					
</script>