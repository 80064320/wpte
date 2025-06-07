<?php
/**
 * Checkout.
 *
 * @since 6.2.0
 */

return apply_filters(
	'taxonomy_settings',
	array(
		'title'  => __( 'Taxonomy', 'wp-travel-engine' ),
		'order'  => 25,
		'id'     => 'taxonomy_settings',
		'fields' => array(
			array(
				'label'       => __( 'Show Taxonomy Image', 'wp-travel-engine' ),
				'description' => __( 'Enable to show taxonomy image in the taxonomy page.', 'wp-travel-engine' ),
				'field_type'  => 'SWITCH',
				'name'        => 'taxonomy.enable_image',
				'divider'     => true,
			),
			array(
				'label'       => __( 'Show Taxonomy children terms', 'wp-travel-engine' ),
				'description' => __( 'If checked, the terms with parent will be shown on the taxonomy archive page. This term children are not displayed in default.', 'wp-travel-engine' ),
				'field_type'  => 'SWITCH',
				'name'        => 'taxonomy.enable_children_terms',
				'divider'     => true,
			),
			array(
				'label'       => __( 'Show taxonomy term description', 'wp-travel-engine' ),
				'description' => __( 'If checked, the taxonomy term description would be displayed on archive pages.', 'wp-travel-engine' ),
				'field_type'  => 'SWITCH',
				'name'        => 'taxonomy.enable_term_description',
				'divider'     => true,
			),
			array(
				'label'       => __( 'Show Excerpt', 'wp-travel-engine' ),
				'description' => __( 'Enable to display trip excerpt in the taxonomy pages.', 'wp-travel-engine' ),
				'field_type'  => 'SWITCH',
				'name'        => 'taxonomy.enable_excerpt',
				'divider'     => true,
			),
		),
	)
);
