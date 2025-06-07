<?php
Redux::setSection( $opt_name, array(
	'title' => esc_html__('Trip General', 'gowilds'),
	'desc' => '',
	'icon' => 'el-icon-wrench',
	'fields' => array(
		array(
		  	'id'  	=> 'lt-rating-options',
		  	'type'  	=> 'info',
		  	'raw' 	=> '<h3 style="margin: 0;">' . esc_html__( 'Listing Rating Option', 'gowilds' ) . '</h3>'
		),
		array(
		  'id'            => 'lt_reviews',
		  'type'          => 'multi_text',
		  'title'         => esc_html__('Listing Review Item / Title[key]', 'gowilds'),
		  'subtitle'      => esc_html__('Example: Quality[quality], Format: Title[key]', 'gowilds'),
		  'default'       => array('Quality[quality]', 'Location[Location]', 'Services[services]', 'Pricing[price]')
		),
		array(
			'id'        => 'lt_review_allow_owner',
			'type'      => 'select',
			'title'     => esc_html__('Allow listing owner review', 'gowilds'),
			'desc'      => esc_html__('Allow listing owners to review their own listings.', 'gowilds'),
			'options'   => array(
				'enable'         => esc_html__('Enable', 'gowilds'),
				'disable'        => esc_html__('Disable', 'gowilds'),
			),
			'default' => 'enable'
		)
	)
));