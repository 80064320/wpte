<?php
/**
 * Global Trip Highlights Settings.
 */
return apply_filters(
	'highlights',
	array(
		'title'  => __( 'Global Trip Highlights', 'wp-travel-engine' ),
		'order'  => 20,
		'id'     => 'highlights',
		'fields' => array(
			array(
				'field_type' => 'HIGHLIGHTS',
				'name'       => 'highlights',
			),
		),
	)
);
