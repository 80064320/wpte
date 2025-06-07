<?php

/**
 * Trip Card Display Settings.
 *
 * @since 6.2.0
 */

$site_url           = get_site_url();
$trip_page_url      = $site_url . '/trip/';
$difficulty_tax_url = $site_url . '/wp-admin/edit-tags.php?taxonomy=difficulty&post_type=trip';
$tag_tax_url        = $site_url . '/wp-admin/edit-tags.php?taxonomy=trip_tag&post_type=trip';
$is_fsd_active      = defined( 'WTE_FIXED_DEPARTURE_FILE_PATH' );

return apply_filters(
	'display-trip-card',
	array(
		'title'  => __( 'Trip Card/Listing ', 'wp-travel-engine' ),
		'order'  => 5,
		'id'     => 'display_trip_card',
		'fields' => array(
			array(
				'field_type' => 'ALERT',
				'content'    => sprintf( __( 'This section includes all the display settings for Trip Card/Listing page. Click <a href="%s" target="_blank">here</a> to see the page.', 'wp-travel-engine' ), $trip_page_url ),
			),
			array(
				'field_type' => 'DIVIDER',
			),
			array(
				'label'       => __( 'New Trip Layout', 'wp-travel-engine' ),
				'description' => __( 'Enable to display new design in trip listing page.', 'wp-travel-engine' ),
				'field_type'  => 'SWITCH',
				'name'        => 'card_new_layout.enable',
			),
			array(
				'condition'  => 'card_new_layout.enable === true',
				'field_type' => 'GROUP',
				'fields'     => array(
					array(
						'divider'     => true,
						'label'       => __( 'Show Slider', 'wp-travel-engine' ),
						'description' => '',
						'field_type'  => 'SWITCH',
						'name'        => 'card_new_layout.enable_slider',
					),
					array(
						'divider'     => true,
						'label'       => __( 'Show Featured Tag on Card', 'wp-travel-engine' ),
						'description' => __( 'Enable to show featured tag on card.', 'wp-travel-engine' ),
						'field_type'  => 'SWITCH',
						'name'        => 'card_new_layout.enable_featured_tag',
					),
					array(
						'divider'     => true,
						'label'       => __( 'Show Wishlist', 'wp-travel-engine' ),
						'description' => '',
						'field_type'  => 'SWITCH',
						'name'        => 'card_new_layout.enable_wishlist',
					),
					array(
						'divider'     => true,
						'label'       => __( 'Show Map', 'wp-travel-engine' ),
						'description' => '',
						'field_type'  => 'SWITCH',
						'name'        => 'card_new_layout.enable_map',
					),
					array(
						'divider'     => true,
						'label'       => __( 'Show Difficulty', 'wp-travel-engine' ),
						'description' => sprintf( __( 'Click <a href="%s">here</a> to add difficulty level.', 'wp-travel-engine' ), $difficulty_tax_url ),
						'field_type'  => 'SWITCH',
						'name'        => 'card_new_layout.enable_difficulty',
					),
					array(
						'divider'     => true,
						'label'       => __( 'Show Tag', 'wp-travel-engine' ),
						'description' => sprintf( __( 'Click <a href="%s">here</a> to add a tag.', 'wp-travel-engine' ), $tag_tax_url ),
						'field_type'  => 'SWITCH',
						'name'        => 'card_new_layout.enable_tags',
					),
					array(
						'divider'     => true,
						'label'       => __( 'Show Next Departure Dates', 'wp-travel-engine' ),
						'description' => __( 'Enable to show next departure dates.', 'wp-travel-engine' ),
						'field_type'  => 'SWITCH',
						'name'        => 'card_new_layout.enable_fsd',
					),
					array(
						'divider'     => true,
						'label'       => __( 'Show Available Months', 'wp-travel-engine' ),
						'description' => __( 'Enable to show available months on card.', 'wp-travel-engine' ),
						'field_type'  => 'SWITCH',
						'name'        => 'card_new_layout.enable_available_months',
					),
					array(
						'visibility'  => $is_fsd_active === true,
						'divider'     => true,
						'label'       => __( 'Show Available Dates', 'wp-travel-engine' ),
						'description' => __( 'Enable to show available dates on hover.', 'wp-travel-engine' ),
						'field_type'  => 'SWITCH',
						'name'        => 'card_new_layout.enable_available_dates',
					),
				),
			),
			array(
				'label'       => __( 'Trip Duration', 'wp-travel-engine' ),
				'description' => __( 'Choose how the trip duration should be displayed, not applicable for hourly trips.', 'wp-travel-engine' ),
				'field_type'  => 'SELECT_BUTTON',
				'name'        => 'trip_duration_label_on_card',
				'default'     => 'days',
				'options'     => array(
					array(
						'value' => 'both',
						'label' => __( 'Days and Nights', 'wp-travel-engine' ),
					),
					array(
						'value' => 'days',
						'label' => __( 'Days', 'wp-travel-engine' ),
					),
					array(
						'value' => 'nights',
						'label' => __( 'Nights', 'wp-travel-engine' ),
					),
				),
			),
		),
	),
);
