<div class="content_right">
          <div class="top_block_advance_search">
        		<div class="search_ad_block">
               	  <div class="refine_icon">
                    </div>
                    <div class="advance_search_box_content">
                    <?php  
						$sql="SELECT field_values FROM wp_cp_ad_fields WHERE field_name IN ('cp_breed','cp_sex','cp_height','cp_color','cp_all_levels','cp_discipline')";
						$data = $wpdb->get_results($sql);
						//var_dump($data);exit;
						$breed_values = $data[0]->field_values;
						$breed_array = explode(',', $breed_values);
						//var_dump($breed_array);
						$sex_values = $data[1]->field_values;
						$sex_array = explode(',', $sex_values);
						$height_values = $data[2]->field_values;
						$height_array = explode(',', $height_values);
						$color_values = $data[3]->field_values;
						$color_array = explode(',', $color_values);
						$all_level_values = $data[4]->field_values;
						$all_level_array = explode(',', $all_level_values);
						$discipline_values = $data[5]->field_values;
						$discipline_array = explode(',', $discipline_values);
						 /*if($_POST['advanceSearch'])
							 {
							 	$buyer_age = $_POST['age'];
								$buyer_breed = $_POST['breed'];
								$buyer_discip = $_POST['discip'];
								$buyer_sex = $_POST['sex'];
								$buyer_height = $_POST['height'];
								$buyer_color = $_POST['color'];
								$buyer_discip = $_POST['discip'];
								$buyer_price = $_POST['price'];
								$buyer_alllevels = $_POST['alllevels'];
								$buyer_location = $_POST['buyer_location'];
								 wp_redirect( site_url()."/buyer/?location='$buyer_location'&breed='$buyer_breed'&discipline='$buyer_discip'&sex='$buyer_sex'&height='$buyer_height'&color='$buyer_color'&all_levels='$buyer_alllevels'&price='$buyer_price'&age='$buyer_age'");
								  wp_redirect( site_url()."/buyer/?location='$buyer_location'&price='$buyer_price'&age='$buyer_age'");
								 //wp_redirect( site_url()."/buyer/?location='$buyer_location'&cp_breed='$buyer_breed'&cp_discipline='$buyer_discip'&cp_sex='$buyer_sex'");
								
							 }*/

						//var_dump($discipline_array);
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
						$age=$age1.'-'.$age2;
						$get_cp_price = isset($_POST['price'])?$_POST['price']:'';
						$search_cp_price= explode("-",$get_cp_price);
						$price1 = $search_cp_price[0];
						$price2 = $search_cp_price[1];
						$price=$price1.'-'.$price2;
						
						
						
					   ?>
                       <?php
					    /*?><form name="" method="post" action="<?php echo site_url();?>/show-and-horses/?id=<?php echo $_GET['id']; ?>"><?php */?>
                       <form name="" method="post" action="">
                        <h1>Refine Search</h1>
                        
                       <?php  //$search_location = $_GET['location'];?>
                        <input  type="text" placeholder="Zip or Location" name="buyer_location" value="<?php echo $search_location; ?>" />
                        <label>
                            <select name="breed">
                               <option selected="selected" value="">breed</option>
								<?php foreach($breed_array as $breed){?>
                                <option value="<?php echo $breed;?>" <?php if($search_breed==$breed){ echo 'selected="selected"'; } ?>><?php echo $breed;?></option>
                                <?php }?>
                            </select>
                        </label>
                        <label>
                            <select name="discip">
                                <option selected value=""> discipline </option>
                                <?php foreach($discipline_array as $discip){?>
                                <option value="<?php echo $discip;?>" <?php if($search_discip==$discip){ echo 'selected="selected"'; } ?>><?php echo $discip;?></option>
                                <?php }?>
                            </select>
                        </label>
                        <label>
                            <select name="sex">
                                <option selected value=""> sex </option>
                                <?php foreach($sex_array as $sex){?>
                                    <option value="<?php echo $sex;?>"  <?php if($search_sex==$sex){ echo 'selected="selected"'; } ?> ><?php echo $sex;?></option>
                                    <?php }?>
                            </select>
                        </label>
                        <label>
                            <select name="age">
                                <option selected value=""> age range </option>
                               <option value="1-10"   <?php if($age=='1-10'){ echo 'selected="selected"'; } ?> >1y-10y</option>
                                <option value="10-20"   <?php if($age=='10-20'){ echo 'selected="selected"'; } ?> >10y-20y</option>
                                <option value="20-30"   <?php if($age=='20-30'){ echo 'selected="selected"'; } ?> >20y-30y</option>
                            </select>
                        </label>
                        <label>
                            <select name="height">
                                <option selected value=""> height range </option>
                                <?php foreach($height_array as $height){?>
                                    <option value="<?php echo $height;?>"  <?php if($search_height==$height){ echo 'selected="selected"'; } ?>><?php echo $height;?></option>
                                    <?php }?>
                            </select>
                        </label>
                        <label>
                            <select name="color">
                                <option selected value=""> color </option>
                                <?php foreach($color_array as $color){?>
                                    <option value="<?php echo $color;?>"  <?php if($search_color==$color){ echo 'selected="selected"'; } ?>><?php echo $color;?></option>
                                    <?php }?>
                            </select>
                        </label>
                        <label style="color:#FFFFFF;">Show Experience</label>
                        <label>
                            <select name="all_levels">
                                <option selected value=""> all levels</option>
                                <?php foreach($all_level_array as $all_level){?>
                                    <option value="<?php echo $all_level;?>"  <?php if($search_all_levels==$all_level){ echo 'selected="selected"'; } ?>><?php echo $all_level;?></option>
                                    <?php }?>
                            </select>
                        </label>
                        <label>
                            <select name="price">
                                <option selected value=""> price range </option>
                                <option value="500-1000" <?php if($price=='500-1000'){ echo 'selected="selected"'; } ?>>$500-$1000</option>
                                <option value="1000-5000" <?php if($price=='1000-5000'){ echo 'selected="selected"'; } ?>>$1000-$5000</option>
                                <option value="5000-10000" <?php if($price=='5000-10000'){ echo 'selected="selected"'; } ?>>$5000-$10000</option>
                            </select>
                        </label>
                        <!--<a href="#">POSTED SEARCHES</a>-->
                        <input type="submit" class="width30" value="Search" name="advanceSearch" />
                        </form>
                        
                    </div>
                </div>
        
        </div>
       	  <img src="<?php bloginfo('template_url'); ?>/images/possibleAD.png" width="349" height="127" alt="" style="margin: 18px; width: 92%; height: auto;" /> 
          </div>