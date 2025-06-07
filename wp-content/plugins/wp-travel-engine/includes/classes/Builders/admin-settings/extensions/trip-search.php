<?php
/**
 * Extensions Trip Search Tab Settings.
 *
 * @since 6.2.0
 */

return apply_filters(
	'extension_trip_search',
	array(
		'title'  => __( 'Trip Search', 'wp-travel-engine' ),
		'order'  => 55,
		'id'     => 'extension-trip-search',
		'fields' => array(
			array(
				'divider'    => true,
				'label'      => __( 'Show Destination', 'wp-travel-engine' ),
				'help'       => __( 'Check the checkbox to show Destination field in the Trip Search Form.', 'wp-travel-engine' ),
				'field_type' => 'SWITCH',
				'name'       => 'trip_search.enable_destination',
			),
			array(
				'divider'    => true,
				'label'      => __( 'Show Activities', 'wp-travel-engine' ),
				'help'       => __( 'Check the checkbox to show Activities field in the Trip Search Form.', 'wp-travel-engine' ),
				'field_type' => 'SWITCH',
				'name'       => 'trip_search.enable_activities',
			),
			array(
				'divider'    => true,
				'label'      => __( 'Show Trip Types', 'wp-travel-engine' ),
				'help'       => __( 'Check the checkbox to show Trip Types field in the Search Page - FITER BY Section.', 'wp-travel-engine' ),
				'field_type' => 'SWITCH',
				'name'       => 'trip_search.enable_trip_types',
			),
			array(
				'divider'    => true,
				'label'      => __( 'Show Trip Tags', 'wp-travel-engine' ),
				'help'       => __( 'Check the checkbox to show Trip Types field in the Search Page - FITER BY Section.', 'wp-travel-engine' ),
				'field_type' => 'SWITCH',
				'name'       => 'trip_search.enable_trip_tags',
			),
			array(
				'divider'    => true,
				'label'      => __( 'Show Difficulties', 'wp-travel-engine' ),
				'help'       => __( 'Check the checkbox to show Difficulties field in the Search Page - FITER BY Section.', 'wp-travel-engine' ),
				'field_type' => 'SWITCH',
				'name'       => 'trip_search.enable_difficulties',
			),
			array(
				'divider'    => true,
				'label'      => __( 'Show Duration', 'wp-travel-engine' ),
				'help'       => __( 'Check the checkbox to show Duration field in the Trip Search Form.', 'wp-travel-engine' ),
				'field_type' => 'SWITCH',
				'name'       => 'trip_search.enable_duration',
			),
			array(
				'divider'    => true,
				'label'      => __( 'Show Budget', 'wp-travel-engine' ),
				'help'       => __( 'Check the checkbox to show Budget field in the Trip Search Form.', 'wp-travel-engine' ),
				'field_type' => 'SWITCH',
				'name'       => 'trip_search.enable_budget',
			),
			array(
				'divider'    => true,
				'label'      => __( 'Show Fixed Starting Dates', 'wp-travel-engine' ),
				'help'       => __( 'Check the checkbox to show Dates field in the Trip Search Form.', 'wp-travel-engine' ),
				'field_type' => 'SWITCH',
				'name'       => 'trip_search.enable_fsd',
			),
			array(
				'label'      => __( 'Show in Search Page - FILTER BY Section', 'wp-travel-engine' ),
				'help'       => __( 'Check the checkbox to apply the above settings in Search Page - FITER BY Section as well.', 'wp-travel-engine' ),
				'field_type' => 'SWITCH',
				'name'       => 'trip_search.enable_filter_by_section',
			),
		),
	)
);
