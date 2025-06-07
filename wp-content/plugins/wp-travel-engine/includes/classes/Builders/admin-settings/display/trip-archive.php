<?php
/**
 * Trip Archive Display Settings.
 *
 * @since 6.2.0
 */

$sorting_options = wptravelengine_get_sorting_options();
$sort_trip_by    = array();

foreach ( $sorting_options as $key => $value ) {
	if ( is_array( $value ) && isset( $value['options'] ) ) {
		$group = array(
			'label'   => $value['label'],
			'options' => array(),
		);
		foreach ( $value['options'] as $k => $v ) {
			$group['options'][] = array(
				'label' => $v,
				'value' => $k,
			);
		}
		$sort_trip_by[] = $group;
	} else {
		$sort_trip_by[] = array(
			'label' => $value,
			'value' => $key,
		);
	}
}

return apply_filters(
	'display-trip-archive',
	array(
		'title'  => __( 'Trip Archive', 'wp-travel-engine' ),
		'order'  => 15,
		'id'     => 'display-trip-archive',
		'fields' => array(
			array(
				'label'       => __( 'Show Archive Title', 'wp-travel-engine' ),
				'description' => __( 'The Archive titles (Destination, Trip Types, Activities, etc) will display if you enable this feature.', 'wp-travel-engine' ),
				'field_type'  => 'SWITCH',
				'name'        => 'enable_archive_title',
				'divider'     => true,
			),
			array(
				'label'       => __( 'Sort Trips By', 'wp-travel-engine' ),
				'description' => __( 'Choose the sorting type in which trips should be listed on archive pages.', 'wp-travel-engine' ),
				'field_type'  => 'SELECT',
				'options'     => $sort_trip_by,
				'divider'     => true,
				'name'        => 'sort_trips_by',
			),
			array(
				'label'       => __( 'Trip View Mode', 'wp-travel-engine' ),
				'description' => __( 'Choose the view mode: List|Grid.', 'wp-travel-engine' ),
				'field_type'  => 'SELECT_BUTTON',
				'options'     => array(
					array(
						'label' => __( 'List', 'wp-travel-engine' ),
						'value' => 'list',
					),
					array(
						'label' => __( 'Grid', 'wp-travel-engine' ),
						'value' => 'grid',
					),
				),
				'divider'     => true,
				'name'        => 'trip_view_mode',
			),
			array(
				'label'       => __( 'Show featured trips always on top', 'wp-travel-engine' ),
				'description' => '',
				'field_type'  => 'SWITCH',
				'name'        => 'featured_trips.enable',
				'divider'     => true,
			),
			array(
				'field_type' => 'GROUP',
				'condition'  => 'featured_trips.enable === true',
				'fields'     => array(
					array(
						'label'       => __( 'Number of Featured Trips', 'wp-travel-engine' ),
						'description' => __( 'Set the number of featured trips to show in the archive pages.', 'wp-travel-engine' ),
						'field_type'  => 'NUMBER',
						'default'     => '2',
						'min'         => 0,
						'name'        => 'featured_trips.number',
						'divider'     => true,
					),
				),
			),
			array(
				'label'       => __( 'Customize Archive Title', 'wp-travel-engine' ),
				'description' => __( 'Customize the Archive titles (Archives: Trips).', 'wp-travel-engine' ),
				'field_type'  => 'TEXT',
				'name'        => 'archives.title',
				'divider'     => true,
			),
			array(
				'label'       => __( 'Show Archives: Trips Title', 'wp-travel-engine' ),
				'description' => __( 'Enabling this feature will show the Archive title (Archives: Trips).', 'wp-travel-engine' ),
				'field_type'  => 'SWITCH',
				'name'        => 'archives.enable_title',
				'divider'     => true,
			),
			array(
				'label'       => __( 'Advance Search Panel', 'wp-travel-engine' ),
				'description' => __( 'Enable advance search panel for smaller devices in archive pages.', 'wp-travel-engine' ),
				'field_type'  => 'SWITCH',
				'name'        => 'archives.enable_advance_search',
				'divider'     => true,
			),
			array(
				'label'       => __( 'Toggle Criteria Filter Display', 'wp-travel-engine' ),
				'description' => __( 'Enabling this feature will display each filter option as a requirement on the archive page, allowing users to toggle the visibility of criteria filters.', 'wp-travel-engine' ),
				'field_type'  => 'SWITCH',
				'name'        => 'enable_criteria_filter',
			),
		),
	),
);
