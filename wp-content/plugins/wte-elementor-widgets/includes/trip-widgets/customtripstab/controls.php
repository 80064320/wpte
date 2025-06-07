<?php

namespace WPTRAVELENGINEEB;

/**
 * Custom Trips Tabs Widget Controls.
 *
 * @since 1.3.9
 * @package wptravelengine-elementor-widgets
 */

$selectors = array(
	// general section
	'card_background_color'            => array(
		'{{WRAPPER}} .wpte-elementor-widget .wpte-card' => '--g-bg: {{VALUE}};',
	),
	'card_padding'                     => array(
		'{{WRAPPER}} .wpte-elementor-widget .wpte-card' => '--g-p: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	),
	'card_border'                      => '{{WRAPPER}} .wpte-elementor-widget .wpte-card__wrap',
	'card_border_radius'               => array(
		'{{WRAPPER}} .wpte-elementor-widget .wpte-card' => '--g-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

	),
	'card_boxshadow'                   => '{{WRAPPER}} .wpte-elementor-widget .wpte-card',

	// content section
	'content_alignment'            => array(
		'{{WRAPPER}} .wpte-elementor-widget .wpte-card' => '--content-alignment: {{VALUE}};',
	),
	'content_background_color'            => array(
		'{{WRAPPER}} .wpte-elementor-widget .wpte-card' => '--content-background: {{VALUE}};',
	),
	'content_padding'                     => array(
		'{{WRAPPER}} .wpte-elementor-widget .wpte-card' => '--content-padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	),
	'content_border'                      => '{{WRAPPER}} .wpte-elementor-widget .wpte-card .wpte-card__content',
	'content_border_radius'               => array(
		'{{WRAPPER}} .wpte-elementor-widget .wpte-card' => '--content-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	),
	'content_boxshadow'                   => '{{WRAPPER}} .wpte-elementor-widget .wpte-card .wpte-card__content',

	// image section
	'image_scale'                      => array(
		'{{WRAPPER}} .wpte-elementor-widget .wpte-card' => '--img-fit: {{VALUE}};',
	),
	'image_width'                      => array(
		'{{WRAPPER}} .wpte-elementor-widget .wpte-card' => '--img-w: {{SIZE}}{{UNIT}};',
	),
	'image_height'                     => array(
		'{{WRAPPER}} .wpte-elementor-widget .wpte-card' => '--img-h: {{SIZE}}{{UNIT}};',
	),
	'animation_type'                   => array(
		'{{WRAPPER}} .wpte-elementor-widget .wpte-card img' => 'transition-timing-function: {{VALUE}};',
	),
	'img_animation_duration'           => array(
		'{{WRAPPER}} .wpte-elementor-widget .wpte-card img' => 'transition-duration: {{VALUE}}s;',
	),
	'image_border_radius'              => array(
		'{{WRAPPER}} .wpte-elementor-widget .wpte-card' => '--img-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	),
	'image_boxshadow'                   => '{{WRAPPER}} .wpte-elementor-widget .wpte-card__media .wpte-card__image',


	// title
	'title_typography'  => '{{WRAPPER}} .wpte-elementor-widget .wpte-card__title',
	'title_color'       => array('{{WRAPPER}} .wpte-elementor-widget .wpte-card' => '--t-fc: {{VALUE}};'),
	'title_color_hover' => array('{{WRAPPER}} .wpte-elementor-widget .wpte-card' => '--t-fc-h: {{VALUE}};'),
	'title_margin'      => array('{{WRAPPER}} .wpte-elementor-widget .wpte-card' => '--t-m: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'),

	// location
	'location_typography' => '{{WRAPPER}} .wpte-elementor-widget .wpte-card .wpte-card__location',
	'location_icon_color' => array('{{WRAPPER}} .wpte-elementor-widget .wpte-card' => '--l-ic: {{VALUE}};'),
	'location_icon_size'  => array('{{WRAPPER}} .wpte-elementor-widget .wpte-card' => '--l-is: {{SIZE}}{{UNIT}};'),
	'location_margin'        => array('{{WRAPPER}} .wpte-elementor-widget .wpte-card' => '--l-m: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'),
	'location_color'  => array('{{WRAPPER}} .wpte-elementor-widget .wpte-card' => '--l-fc: {{VALUE}};'),
	'location_hover_color'  => array('{{WRAPPER}} .wpte-elementor-widget .wpte-card' => '--l-fc-h: {{VALUE}};'),
	'location_hover_decoration'  => array('{{WRAPPER}} .wpte-elementor-widget .wpte-card' => '--l-decoration: {{VALUE}};'),


	// meta
	'meta_typography'                  => '{{WRAPPER}} .wpte-elementor-widget .wpte-card .wpte-card__meta',
	'meta_color'                       => array(
		'{{WRAPPER}} .wpte-elementor-widget .wpte-card' => '--m-fc: {{VALUE}};',
	),
	'meta_icon_color'                  => array(
		'{{WRAPPER}} .wpte-elementor-widget .wpte-card' => '--m-ic: {{VALUE}};',
	),
	'meta_spacing'                     => array(
		'{{WRAPPER}} .wpte-elementor-widget .wpte-card' => '--m-sb: {{SIZE}}{{UNIT}};',
	),
	'meta_margin'                      => array(
		'{{WRAPPER}} .wpte-elementor-widget .wpte-card' => '--m-m: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	),
	'meta_icon_size'                     => array(
		'{{WRAPPER}} .wpte-elementor-widget .wpte-card' => '--m-is: {{SIZE}}{{UNIT}};',
	),
	
	// price
	'price_typography'                 => '{{WRAPPER}} .wpte-elementor-widget .wpte-card:not(.hero-color) .wpte-card__price .actual-price',
	'price_color'                      => array(
		'{{WRAPPER}} .wpte-elementor-widget .wpte-card:not(.hero-color)' => '--p-fc-n: {{VALUE}};',
	),
	'price_bg_color'                      => array(
		'{{WRAPPER}} .wpte-elementor-widget.wpte-adv-trips_two .wpte-card' => '--p-bg: {{VALUE}};',
	),
	'strike_typography'                => '{{WRAPPER}} .wpte-elementor-widget .wpte-card:not(.hero-color) .wpte-card__price .striked-price',
	'strike_color'                     => array(
		'{{WRAPPER}} .wpte-elementor-widget .wpte-card:not(.hero-color)' => '--p-fc-s: {{VALUE}};',
	),
	'price_margin'      => array('{{WRAPPER}} .wpte-elementor-widget .wpte-card:not(.hero-color)' => '--p-m: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',),


	// feat tag
	'feat_typography'                => '{{WRAPPER}} .wpte-elementor-widget .wpte-card .wpte-badge_featured .wpte-badge__text',
	'feat_tag_color'                   => array(
		'{{WRAPPER}} .wpte-elementor-widget .wpte-card' => '--f-fc: {{VALUE}};',
	),
	'feat_tag_bg_color'                => array(
		'{{WRAPPER}} .wpte-elementor-widget .wpte-card' => '--f-bg: {{VALUE}};',
	),

	// discounttag
	'discount_typography'                => '{{WRAPPER}} .wpte-elementor-widget .wpte-card .wpte-badge_discount .wpte-badge__text',
	'discount_tag_color'               => array(
		'{{WRAPPER}} .wpte-elementor-widget .wpte-card' => '--d-fc: {{VALUE}};',
	),
	'discount_tag_bg_color'            => array(
		'{{WRAPPER}} .wpte-elementor-widget .wpte-card' => '--d-bg: {{VALUE}};',
	),

	//tab
	'tab_typography'          => '{{WRAPPER}} .wpte-elementor-widget .wpte-trips-tab__nav button[role="tab"]',
	'tab_active_color'        => array('{{WRAPPER}} .wpte-elementor-widget .wpte-trips-tab__nav button[role="tab"][aria-selected="true"]' => '--tab-color: {{VALUE}};'),
	'tab_inactive_color'      => array('{{WRAPPER}} .wpte-elementor-widget .wpte-trips-tab__nav button[role="tab"][aria-selected="false"]' => '--tab-color: {{VALUE}};'),
	'tab_active_background'   => array('{{WRAPPER}} .wpte-elementor-widget .wpte-trips-tab__nav button[role="tab"][aria-selected="true"]' => '--tab-bg: {{VALUE}};'),
	'tab_inactive_background' => array('{{WRAPPER}} .wpte-elementor-widget .wpte-trips-tab__nav button[role="tab"][aria-selected="false"]' => '--tab-bg: {{VALUE}};'),
	'tab_active_border'       => '{{WRAPPER}} .wpte-elementor-widget .wpte-trips-tab__nav button[role="tab"][aria-selected="true"]',
	'tab_inactive_border'     => '{{WRAPPER}} .wpte-elementor-widget .wpte-trips-tab__nav button[role="tab"][aria-selected="false"]',
	'tab_border_radius'       => array('{{WRAPPER}} .wpte-elementor-widget .wpte-trips-tab__nav button[role="tab"]' => '--tab-border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',),
	'tab_nav_background'      => array('{{WRAPPER}} .wpte-elementor-widget .wpte-trips-tab__nav--layout-2' => '--nav-bg: {{VALUE}};'),
	'tab_nav_border'          => '{{WRAPPER}} .wpte-elementor-widget .wpte-trips-tab__nav',
	'tab_nav_padding'         => array('{{WRAPPER}} .wpte-elementor-widget .wpte-trips-tab__nav' => '--nav-padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'),
	'tab_nav_border_radius'   => array('{{WRAPPER}} .wpte-elementor-widget .wpte-trips-tab__nav' => '--nav-border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'),
	'tab_padding'             => array('{{WRAPPER}} .wpte-elementor-widget .wpte-trips-tab__nav button[role="tab"]' => '--tab-padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'),
	'tab_gap'                 => array('{{WRAPPER}} .wpte-elementor-widget .wpte-trips-tab__nav' => '--nav-gap: {{ROW}}{{UNIT}} {{COLUMN}}{{UNIT}};'),

	// rating
	'rating_typography' => '{{WRAPPER}} .wpte-elementor-widget .wpte-card .wpte-card__rating',
	'rating_color'      => array('{{WRAPPER}} .wpte-elementor-widget .wpte-card .wpte-card__rating' => '--r-fc: {{VALUE}};'),
	'rating_margin'     => array('{{WRAPPER}} .wpte-elementor-widget .wpte-card .wpte-card__rating' => '--r-m: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',),
	
	//Slider Arrow
	'slider_arrow_padding'             => array(
		'{{WRAPPER}} .wpte-elementor-widget' => '--slider-arrow-padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	),
	'slider_arrow_bg_color'            => array(
		'{{WRAPPER}} .wpte-elementor-widget' => '--slider-arrow-bg-n: {{VALUE}};',
	),
	'slider_arrow_color'               => array(
		'{{WRAPPER}} .wpte-elementor-widget' => '--slider-arrow-color-n: {{VALUE}};',
	),
	'slider_arrow_bg_color_hover'      => array(
		'{{WRAPPER}} .wpte-elementor-widget' => '--slider-arrow-bg-h: {{VALUE}};',
	),
	'slider_arrow_color_hover'         => array(
		'{{WRAPPER}} .wpte-elementor-widget' => '--slider-arrow-color-h: {{VALUE}};',
	),
	'slider_arrow_border'              => '{{WRAPPER}} .wpte-elementor-widget .wpte-swiper-btn-prev, {{WRAPPER}} .wpte-elementor-widget .wpte-swiper-btn-next',
	'slider_arrow_border_radius'       => array(
		'{{WRAPPER}} .wpte-elementor-widget' => '--slider-arrow-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	),
	'slider_arrow_box_shadow'          => '{{WRAPPER}} .wpte-elementor-widget .wpte-swiper-btn-prev, {{WRAPPER}} .wpte-elementor-widget .wpte-swiper-btn-next',
	'slider_arrow_border_hover'        => '{{WRAPPER}} .wpte-elementor-widget .wpte-swiper-btn-prev:hover, {{WRAPPER}} .wpte-elementor-widget .wpte-swiper-btn-next:hover',
	'slider_arrow_border_radius_hover' => array(
		'{{WRAPPER}} .wpte-elementor-widget' => '--slider-arrow-radius-h: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	),
	'slider_arrow_size'                => array(
		'{{WRAPPER}} .wpte-elementor-widget ' => '--slider-arrow-size: {{SIZE}}{{UNIT}};',
	),
	'slider_arrow_offset'              => array(
		'{{WRAPPER}} .wpte-elementor-widget' => '--slider-arrow-offset: {{SIZE}}{{UNIT}};',
	),

	// slider pagination.
	'slider_dots_active_color'         => array(
		'{{WRAPPER}} .wpte-elementor-widget' => '--slider-pagination-active-color: {{VALUE}};',
	),
	'slider_dots_color'                => array(
		'{{WRAPPER}} .wpte-elementor-widget' => '--slider-pagination-color: {{VALUE}};',
	),
	'slider_dots_spacing'              => array(
		'{{WRAPPER}} .wpte-elementor-widget' => '--slider-pagination-spacing: {{SIZE}}{{UNIT}};',
	),
);

$controls = array(
	// Content.
	'general_section'      => array(
		'type'        => 'control_section',
		'label'       => __( 'General', 'wptravelengine-elementor-widgets' ),
		'subcontrols' => array(
			'custom_trip_tabs'       => array(
				'label'     => __('Custom Trip Tabs', 'wptravelengine-elementor-widgets'),
				'type'      => 'SELECT',
				'options'   => 'trip' === get_post_type() ? $this->get_custom_trip_tabs_selector() : [],
				'default'   => '',
			)
		),
	),
	'title_settings'       => array(
		'type'        => 'control_section',
		'label'       => __( 'Title', 'wptravelengine-elementor-widgets' ),
		'subcontrols' => array(
			'show_title' => array(
				'label'     => __( 'Show Title', 'wptravelengine-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => __( 'Show', 'wptravelengine-elementor-widgets' ),
				'label_off' => __( 'Hide', 'wptravelengine-elementor-widgets' ),
				'default'   => 'yes',
			),
			'html_tag'   => array(
				'type'    => 'SELECT',
				'label'   => __( 'HTML Tag', 'wptravelengine-elementor-widgets' ),
				'default' => 'h3',
				'options' => array(
					'h1'   => __( 'H1', 'wptravelengine-elementor-widgets' ),
					'h2'   => __( 'H2', 'wptravelengine-elementor-widgets' ),
					'h3'   => __( 'H3', 'wptravelengine-elementor-widgets' ),
					'h4'   => __( 'H4', 'wptravelengine-elementor-widgets' ),
					'h5'   => __( 'H5', 'wptravelengine-elementor-widgets' ),
					'h6'   => __( 'H6', 'wptravelengine-elementor-widgets' ),
					'div'  => __( 'div', 'wptravelengine-elementor-widgets' ),
					'span' => __( 'span', 'wptravelengine-elementor-widgets' ),
					'p'    => __( 'p', 'wptravelengine-elementor-widgets' ),
				),
			),
		),
	),
);

return $controls;