<?php
/**
 * Trip Info.
 *
 * @since 6.2.0
 */

return apply_filters(
	'trip_info',
	array(
		'title'  => __( 'Trip Info', 'wp-travel-engine' ),
		'order'  => 15,
		'id'     => 'trip_info',
		'fields' => array(
			array(
				'label'      => __( 'Trip Info', 'wp-travel-engine' ),
				'field_type' => 'TRIP_INFO_TABS',
				'name'       => 'trip_info',
			),
		),
	)
);
