<?php
/**
 * Trip tabs settings.
 *
 * @since 6.2.0
 */

return apply_filters(
	'trip_tabs',
	array(
		'title'  => __( 'Trip Tabs', 'wp-travel-engine' ),
		'order'  => 10,
		'id'     => 'trip_tabs',
		'fields' => array(
			array(
				'label'      => __( 'Trip Tabs', 'wp-travel-engine' ),
				'field_type' => 'TRIP_TABS',
				'name'       => 'trip_tabs',
			),
		),
	)
);
