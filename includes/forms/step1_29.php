<?php
/**
 * This is step 1 of 3 for the ad submission form
 *
 * @package ClassiPress
 * @subpackage New Ad
 * @author AppThemes
 *
 *
 */

global $current_user, $wpdb;
global $horselimit,$pack_id;
$change_cat_url = add_query_arg( array( 'action' => 'change' ) );

$sql = "SELECT post_title,post_author FROM wp_posts where post_author = $user_ID and post_type='ad_listing' and post_status='publish'";
$userads = $wpdb->get_results($sql);
$timezone=date_default_timezone_get();
//date_default_timezone_set('Asia/Kolkata');
date_default_timezone_set($timezone);
$currentdatetime=date('Y-m-d H:i:s');
//2016-02-05 13:38:17
//2015-10-28 19:30:06
$usersql = "SELECT meta_key,meta_value FROM wp_usermeta where user_id = $user_ID and meta_key='membership_expires'";
$usermeta = $wpdb->get_results($usersql);
$membershipexpires=$usermeta[0]->meta_value;
if(count($userads)<$horselimit && $membershipexpires>=$currentdatetime)
{
	$ad_pack_id=$pack_id;
}

?>

<div id="step1">

	<?php
		// show the category dropdown when first arriving to this page.
		// Also show it if cat equals -1 which means the 'select one' option was submitted
		if ( !isset($_POST['cat']) || ($_POST['cat'] == '-1') ) {
	?>
    
	<?php if(count($userads)<$horselimit && $membershipexpires>=$currentdatetime)
    {?>
	<form name="mainform" id="mainform" class="form_step" action="" method="post">
    

		<ol style="float:none; margin:0 auto;">

			<li>
				<div class="labelwrapper"><label><?php _e( '', APP_TD ); ?></label></div>
				<?php cp_cost_per_listing(); ?>
				<div class="clr"></div>
			</li>

			<?php
				$category = ( isset( $_GET['renew'] ) ) ? true : false;
				if ( $category ) {
					$terms = wp_get_post_terms( $_GET['renew'], APP_TAX_CAT );
					$category = ( ! empty( $terms ) ) ? $terms[0] : false;
				}

				if ( ! isset( $_GET['renew'] ) || ! $category || ( isset( $_GET['action'] ) && $_GET['action'] == 'change' ) ) {
			?>
            <li>
            	<div class="labelwrapper" id="labelwrapper"><label>Are You Looking To..</label></div>
            	<input type="radio" id="radio-id-to-change" name="type" value="seller" checked="checked"> Sell or Lease<input type="radio" name="type" value="buyer"> Buy
                <div class="clr"></div>
            </li>

			<li>
				
				
                
				<div id="ad-categories-footer" class="button-container">
					<input type="submit" name="getcat" id="getcat" class="btn_orange" value="<?php _e( 'Go &rsaquo;&rsaquo;', APP_TD ); ?>" />
					<div id="chosenCategory"><input id="ad_cat_id" name="cat" type="hidden" value="15" /></div>
					<div style="clear:both;"></div>
				</div>
				<div style="clear:both;"></div>
			</li>

			<?php
				} else {
					if ( $cp_options->price_scheme == 'category' && cp_payments_is_enabled() ) {
						$prices = $cp_options->price_per_cat;
						$cat_fee = ( isset( $prices[ $category->term_id ] ) ) ? (float) $prices[ $category->term_id ] : 0;
						$cat_fee = ' - ' . appthemes_get_price( $cat_fee );
					} else {
						$cat_fee = '';
					}
			?>

			<li>
				<div class="labelwrapper"><label><?php _e( 'Category:', APP_TD ); ?></label></div>
				<strong><?php echo $category->name; ?></strong><?php echo $cat_fee; ?>&nbsp;&nbsp;<small><a href="<?php echo $change_cat_url; ?>"><?php _e( '(change)', APP_TD ); ?></a></small>
				<div class="clr pad5"></div>
				<div class="button-container">
					<input id="ad_cat_id" name="cat" type="hidden" value="<?php echo $category->term_id; ?>" />
					<input type="submit" name="getcat" class="btn_orange" value="<?php _e( 'Go &rsaquo;&rsaquo;', APP_TD ); ?>" />
				</div>
			</li>

			<?php } ?>

		</ol>

	</form>
    <?php }
	else
	{
		if(!is_admin()){?>
    
		<div class="error"><p>You are exceeded your ad limit.If you wish to add more horses <a href="<?php echo CP_MEMBERSHIP_PURCHASE_URL; ?>">upgrade your plan.</a></p></div>
        <?php 
		}
		else
		{?>
        <form name="mainform" id="mainform" class="form_step" action="" method="post">
    

		<ol style="float:none; margin:0 auto;">

			<li>
				<div class="labelwrapper"><label><?php _e( '', APP_TD ); ?></label></div>
				<?php cp_cost_per_listing(); ?>
				<div class="clr"></div>
			</li>

			<?php
				$category = ( isset( $_GET['renew'] ) ) ? true : false;
				if ( $category ) {
					$terms = wp_get_post_terms( $_GET['renew'], APP_TAX_CAT );
					$category = ( ! empty( $terms ) ) ? $terms[0] : false;
				}

				if ( ! isset( $_GET['renew'] ) || ! $category || ( isset( $_GET['action'] ) && $_GET['action'] == 'change' ) ) {
			?>
            <li>
            	<div class="labelwrapper" id="labelwrapper"><label>Are You Looking To..</label></div>
            	<input type="radio" id="radio-id-to-change" name="type" value="seller" checked="checked"> Sell or Lease<input type="radio" name="type" value="buyer"> Buy
                <div class="clr"></div>
            </li>

			<li>
				
				
                
				<div id="ad-categories-footer" class="button-container">
					<input type="submit" name="getcat" id="getcat" class="btn_orange" value="<?php _e( 'Go &rsaquo;&rsaquo;', APP_TD ); ?>" />
					<div id="chosenCategory"><input id="ad_cat_id" name="cat" type="hidden" value="15" /></div>
					<div style="clear:both;"></div>
				</div>
				<div style="clear:both;"></div>
			</li>

			<?php
				} else {
					if ( $cp_options->price_scheme == 'category' && cp_payments_is_enabled() ) {
						$prices = $cp_options->price_per_cat;
						$cat_fee = ( isset( $prices[ $category->term_id ] ) ) ? (float) $prices[ $category->term_id ] : 0;
						$cat_fee = ' - ' . appthemes_get_price( $cat_fee );
					} else {
						$cat_fee = '';
					}
			?>

			<li>
				<div class="labelwrapper"><label><?php _e( 'Category:', APP_TD ); ?></label></div>
				<strong><?php echo $category->name; ?></strong><?php echo $cat_fee; ?>&nbsp;&nbsp;<small><a href="<?php echo $change_cat_url; ?>"><?php _e( '(change)', APP_TD ); ?></a></small>
				<div class="clr pad5"></div>
				<div class="button-container">
					<input id="ad_cat_id" name="cat" type="hidden" value="<?php echo $category->term_id; ?>" />
					<input type="submit" name="getcat" class="btn_orange" value="<?php _e( 'Go &rsaquo;&rsaquo;', APP_TD ); ?>" />
				</div>
			</li>

			<?php } ?>

		</ol>

		</form>
		<?php } ?>
	<?php }?>

	<?php } else {
		// show the form based on the category selected
		// get the cat nice name and put it into a variable
		$category_id = appthemes_numbers_only( $_POST['cat'] );
		$category = get_term_by( 'id', $category_id, APP_TAX_CAT );
		//$_POST['catname'] = $ad_category->name;
	?>
     <!-- custom code -->
   <?php 
    	$sql="SELECT *FROM horseshows WHERE 1=1";
    	$horseresults = $wpdb->get_results($sql);
    ?>
    
	<?php if(isset($_POST['getcat'])){ $type = $_POST['type']; if($type=='buyer') {?>
	<form name="mainform" id="mainform" class="form_step seller_form" action="" method="post" enctype="multipart/form-data">
     <h2 class="form_main_hedding">In search <span>PREMIUM ACCOUNT</span></h2>
    <div class="add_new">
    <span>AD MANAGER</span>
    <ul>
        <li><a href="<?php echo site_url(); ?>/add-new/">Create An Ad</a></li>
        <li><a href="<?php echo site_url(); ?>/dashboard/">Manage Ad</a></li>
        <li><a href="<?php echo site_url(); ?>/dashboard/">Messages</a></li>
	</ul>
    </div>
			
            	<div class="post-head"><span class="add_new_heding">In Search Of..</span></div>
           
		<ol>
        	
            <li style="display:none;">
            	<input name="cp_type" id="cp_type" type="hidden"  minlength="2" value="<?php echo $type;?>">
            </li>
			<?php /*?><li>
				<div class="labelwrapper"><label><?php _e( 'Category:', APP_TD ); ?></label></div>
				<strong><?php echo $category->name; ?></strong>&nbsp;&nbsp;<small><a href="<?php echo $change_cat_url; ?>"><?php _e( '(change)', APP_TD ); ?></a></small>
			</li><?php */?>

			<?php
				$renew_id = ( isset( $_GET['renew'] ) ) ? $_GET['renew'] : false;
				$renew = ( $renew_id ) ? get_post( $renew_id ) : false;
				
				//var_dump($category->name);
				//echo cp_show_form($category_id, $renew);
				?>
				<?php /*?><div id="ad-categories" style="display:block;">						
					<div id="catlvl0">
						<?php
							$args = array(
								'show_option_none' => __( 'Select category', APP_TD ),
								'class' => 'dropdownlist',
								'id' => 'ad_cat_id',
								'orderby' => 'name',
								'order' => 'ASC',
								'name' =>'cat',
								'hide_empty' => 0,
								'hierarchical' => 1,
								'depth' => 1,
								'taxonomy' => APP_TAX_CAT,
							);
				
							cp_dropdown_categories_prices( $args );

						?>
						<div style="clear:both;"></div>
					</div>
				</div><?php */?>
               <?php  
			  		//echo cp_show_form_buyer($category_id, $renew,'buyer');
					echo cp_show_form_buyer('', $renew,'buyer');
			?>
			
			   
            
			<p class="btn1">
            	<input type="hidden" id="ad_pack_id" name="ad_pack_id" value="<?php echo $ad_pack_id; ?>" />
				<input type="submit" name="step1" id="step1" class="btn_orange" value="<?php _e( 'Continue &rsaquo;&rsaquo;', APP_TD ); ?>" />
			</p>

		</ol>

		<input type="hidden" id="ad_cat_id" name="cat" value="<?php echo esc_attr( $category_id ); ?>" />
		<input type="hidden" id="catname" name="catname" value="<?php echo esc_attr( $category->name ); ?>" />
		<input type="hidden" id="fid" name="fid" value="<?php if ( isset( $_POST['fid'] ) ) echo esc_attr( $_POST['fid'] ); ?>" />
		<input type="hidden" id="oid" name="oid" value="<?php echo esc_attr( $order_id ); ?>" />

	</form>
    <?php }else{?>
    <form name="mainform" id="mainform" class="form_step buyer_form" action="" method="post" enctype="multipart/form-data">
    <h2 class="form_main_hedding">Place An Ad <span>PREMIUM ACCOUNT</span></h2>
    <div class="add_new">
    <span>AD MANAGER</span>
    <ul>
        <li><a href="<?php echo site_url(); ?>/add-new/">Create An Ad</a></li>
         <li><a href="<?php echo site_url(); ?>/dashboard/">Manage Ad</a></li>
        <li><a href="<?php echo site_url(); ?>/dashboard/">Messages</a></li>
	</ul>
    </div>
			
        <div class="post-head"><span class="add_new_heding">ADD LISTING</span></div>
		<ol>
        	<li style="display:none;">
            	<input name="cp_type" id="cp_type" type="hidden"  minlength="2" value="<?php echo $type;?>">
            </li>
			<?php
				$renew_id = ( isset( $_GET['renew'] ) ) ? $_GET['renew'] : false;
				$renew = ( $renew_id ) ? get_post( $renew_id ) : false;
				
				//var_dump($category->name);
		?>
        	
				<div id="ad-categories" style="display:block;">						
					<div id="catlvl0">
						<?php
                               /* $args = array(
								'show_option_none' => __( 'Select category', APP_TD ),
								'class' => 'dropdownlist',
								'id' => 'ad_cat_id',
								'orderby' => 'name',
								'order' => 'ASC',
								'name' =>'cat',
								'hide_empty' => 0,
								'hierarchical' => 1,
								'depth' => 1,
								'taxonomy' => APP_TAX_CAT,
								);
				
                                cp_dropdown_categories_prices( $args );*/

						?>
						<div style="clear:both;"></div>
					</div>
				</div>
                <?php
				//echo cp_show_form( $category_id, $renew );
				echo cp_show_form( '', $renew,'seller' );
			?>
            
			<p class="btn1">
				<input type="submit" name="step1" id="step1" class="btn_orange" value="<?php _e( 'Continue &rsaquo;&rsaquo;', APP_TD ); ?>" />
			</p>

		</ol>

		<input type="hidden" id="ad_cat_id" name="cat" value="<?php echo esc_attr( $category_id ); ?>" />
		<input type="hidden" id="catname" name="catname" value="<?php echo esc_attr( $category->name ); ?>" />
		<input type="hidden" id="fid" name="fid" value="<?php if ( isset( $_POST['fid'] ) ) echo esc_attr( $_POST['fid'] ); ?>" />
		<input type="hidden" id="oid" name="oid" value="<?php echo esc_attr( $order_id ); ?>" />

	</form>
    <?php }}?>

	<?php } ?>
    <style>
    .page-template-tpl-add-new #cp_price {
		  margin-top: 10px;		
	}
    </style>

</div>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
<script type="text/javascript">

	var myOptions = {
		<?php 
		$i=1;
		foreach($horseresults as $h){
			echo '"'.$h->name_show.'":"'.$h->name_show.'",';
			$i++;
		}
		?>
	};
	var mySelect = jQuery('#cp_horse_shows');
	jQuery('#cp_horse_shows option:eq(1)').remove();
	jQuery.each(myOptions, function(val, text) {
    	mySelect.append(
        	jQuery('<option></option>').val(val).html(text)
    	);
	});
	var $j = jQuery;
	 $j(function() {
    $j( "#cp_show_date" ).datepicker();
  });
</script>
