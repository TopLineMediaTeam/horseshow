<?php
/**
 * This is step 1 of 2 for the membership purchase submission form
 *
 * @package ClassiPress
 * @subpackage Purchase Membership
 * @author AppThemes
 *
 *
 */
?>
<?php /*?><div id="step1">

	<h2 class="dotted"><?php _e( 'Purchase a Membership Pack', APP_TD ); ?></h2>

	<img src="<?php echo appthemes_locate_template_uri('images/step1.gif'); ?>" alt="" class="stepimg" />

	<?php
		// display the custom message
		cp_display_message( 'membership_form_help' );

		if ( isset( $_GET['membership'] ) && $_GET['membership'] == 'required' ) {
	?>

			<p class="info">
			<?php
				if ( ! empty( $_GET['cat'] ) && $_GET['cat'] != 'all' ) {
					$category_id = appthemes_numbers_only( $_GET['cat'] );
					$category = get_term_by( 'term_id ', $category_id, APP_TAX_CAT );
					if ( $category ) {
						$term_link = html( 'a', array( 'href' => get_term_link( $category, APP_TAX_CAT ), 'title' => $category->name ), $category->name );
						printf( __( 'Membership is currently required in order to post to category %s.', APP_TD ), $term_link );
					}
				} else {
					_e( 'Membership is currently required.', APP_TD );
				}
			?>
			</p>

		<?php } ?>
 
	<p class="dotted">&nbsp;</p>

    
</div><?php */?>



<div class="content_pricing">
    <div class="shadowblock_out">
        <div class="shadowblock">

        <?php
        $sql = "SELECT * FROM $wpdb->cp_ad_packs WHERE pack_status = 'active_membership' ORDER BY pack_id asc";
        $results = $wpdb->get_results( $sql );
        if ( $results ) {
            foreach ( $results as $result ) {
            $result = apply_filters( 'cp_package_field', $result, 'membership' );
            if ( ! $result )
                continue;
            
            $rowclass = 'even';
            $requiredClass = '';
            $benefit = get_pack_benefit( $result );
            if ( stristr( $result->pack_type, 'required' ) )
                $requiredClass = 'required';
            ?>
                        
            <div class="pricing_table">
                <form name="mainform" id="mainform" class="form_membership_step" action="" method="post" enctype="multipart/form-data">
                <div class="table_heading">
                    <h1><?php echo stripslashes( $result->pack_name ); ?></h1>
                    <?php 
                    //echo appthemes_get_price( $result->pack_membership_price ).'<br>';
                    //echo $result->pack_duration.'<br>';
                    //echo '%1$s / %2$s days', APP_TD;
                    //printf( __( '%1$s / %2$s days', APP_TD ), appthemes_get_price( $result->pack_membership_price ), $result->pack_duration ); ?>
                    <p><span><?php echo appthemes_get_price( $result->pack_membership_price ); ?></span>
                    <?php echo ' / '.$result->pack_duration.' days'; ?></p>
                    <ul>
                        <li><?php echo $benefit; ?></li>
                        <?php if($result->pack_horse_limit != 0) {?><li><?php echo "Up to ". $result->pack_horse_limit ." Horses";?> </li><?php }?>                        
			<?php if($result->pack_video_limit != 0) { echo '<li>'.$result->pack_video_limit ." Videos"."</li>"; } ?>
                        <?php if($result->pack_imagelimit != 0) { echo '<li>'.$result->pack_imagelimit ." Images"."</li>"; } ?>
                        <?php if($result->pack_secure_mail == 1) { echo "<li>Secure Email"."<br />"; } ?>
                        <?php if($result->pack_social_media == 1){echo "<li>Ability to Share Ad with Social Media"."</li>";} ?>
                        <?php if($result->pack_cancel == 1){echo "<li>Cancel any time"."</li>";} ?>
                        <?php if($result->pack_ad_views == 1){echo "<li>See # of Ad Views"."</li>";} ?>
                        <?php if($result->pack_link_to_site == 1){echo "<li>Link to Your Website"."</li>";} ?>
                        <?php if($result->pack_iso_ad == 1){echo "<li>Free ISO Ad"."</li>";} ?>
                    </ul>
                    
                </div><!--/table_heading-->
                <div class="clr"></div>
                
                
                <?php if ( is_user_logged_in() ) {?>
                <div class="signup_btn"><a href="#">
                <input type="submit" name="step1" id="step1"  onclick="document.getElementById('pack').value=<?php echo $result->pack_id; ?>;" value="<?php _e( 'Buy Now', APP_TD ); ?>" style="" /></a></div>
                <?php } 
				else {?>
                <div class="signup_btn"><a href="<?php echo get_site_url().'/register'; ?>">SIGN UP</a></div>
                <?php } ?>
                <input type="hidden" id="oid" name="oid" value="<?php echo $order_id; ?>" />
                <?php /*?><input type="hidden" id="pack_<?php echo $result->pack_id; ?>" name="pack" value="<?php if ( isset( $_POST['pack'] ) ) echo $_POST['pack']; ?>" /><?php */?>
                <input type="hidden" id="pack_<?php echo $result->pack_id; ?>" name="pack" value="<?php if ( $result->pack_id!='' ) echo $result->pack_id; ?>" />
                </form>
            </div><!--/pricing_table-->
            <?php
            }// end for each
        }// end if
        else
        {
        ?>
            <div>
                <h1><?php _e( 'No membership packs found.', APP_TD ); ?></h1>
            </div>
        <?php
        } // end $results
        ?>
        </div><!--/shadowblock-->
        <div class="clr"></div>
        <div class="pricing_bottom_button">
            <a href="<?php echo get_site_url().'/contact'; ?>"><p>Need to List More Than 10 Horses, Contact Us!
            <p> </a>
        </div><!--/pricing_bottom_button-->
	</div><!--/shadowblock_out-->
</div><!--/content_pricing-->


