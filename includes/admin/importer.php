<?php

class CP_Importer extends APP_Importer {

	function setup() {
		parent::setup();

		$this->args['admin_action_priority'] = 11;
	}
}


function cp_csv_importer() {
	$fields = array(
		'title'       => 'post_title',
		'description' => 'post_content',
		'status'      => 'post_status',
		'author'      => 'post_author',
		'date'        => 'post_date',
		'slug'        => 'post_name'
	);

	$args = array(
		'taxonomies' => array( APP_TAX_CAT, APP_TAX_TAG ),

		'custom_fields' => array(
			'id'          => 'cp_sys_ad_conf_id',
			'expire_date' => 'cp_sys_expire_date',
			'duration'    => 'cp_sys_ad_duration',
			'total_cost'  => 'cp_sys_total_ad_cost',
			'price'       => 'cp_price',
			'street'      => 'cp_street',
			'city'        => 'cp_city',
			'zipcode'     => 'cp_zipcode',
			'state'       => 'cp_state',
			'country'     => 'cp_country'
		),

		'attachments' => true

	);

	$args = apply_filters( 'cp_csv_importer_args', $args );

	appthemes_add_instance( array( 'CP_Importer' => array( APP_POST_TYPE, $fields, $args ) ) );
}
add_action( 'wp_loaded', 'cp_csv_importer' );

