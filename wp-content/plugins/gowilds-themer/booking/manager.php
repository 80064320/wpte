<?php
if (!defined('ABSPATH')) {
	exit;
}
class Gowilds_Booking_Manager{
	public function __construct(){
		add_action('cmb2_booking_obj_after_av_dates', array($this, 'custom_fields'), 10);
		add_action('cmb2_booking_obj_after_taxonomies', array($this, 'include_exclude_fields'), 10);
		add_action('cmb2_booking_obj_after_taxonomies', array($this, 'external_link_fields'), 11);
		add_action('cmb2_admin_init', [$this, 'taxonomies_metabox'], 10, 1);
	}

	public function custom_fields($obj){
		$obj->add_field(array(
			'name'     => esc_html__('Video', 'gowilds-themer'),
			'id'       => 'gowilds_booking_video',
			'type'     => 'oembed',
			'desc'     => sprintf(
				esc_html__('Enter a youtube, twitter, or instagram URL. Supports services listed at %s.', 'gowilds-themer'),
				'<a href="https://wordpress.org/support/article/embeds/">codex.wordpress.org/Embeds</a>'
			),
		));

		$obj->add_field(
			array(
				'name' => esc_html__('Feature item', 'gowilds-themer'),
				'id'   => 'gowilds_booking_featured',
				'type' => 'checkbox',
			)
		);

		$obj->add_field(array(
			'name'     => esc_html__('Min Age', 'gowilds-themer'),
			'id'       => 'gowilds_booking_min_age',
			'type'     => 'text_small',
		));
	}

	public function include_exclude_fields($obj){
		//Included
		$obj->add_field(array(
			'name'       => esc_html__('Included Section'),
			'id'         => 'gowilds_row_title_included',
			'classes'    => 'cmb2-row-hidden',
			'type'       => 'title',
			'before_row' => array(__CLASS__, 'cmb2_before_row_header'),
		));


		  $obj->add_field(array(
			'name' => esc_html__('Included Content', 'gowilds-themer'),
			'id'   => 'gowilds_included',
			'type' => 'wysiwyg',
		  'options' => array(
				'wpautop' => true,
				'textarea_rows' => 7
		  ),
		  ));

		$obj->add_field(array(
		  'name' => esc_html__('Excluded Content', 'gowilds-themer'),
		  'id'   => 'gowilds_excluded',
		  'type' => 'wysiwyg',
		  'options' => array(
				'wpautop' => true,
				'textarea_rows' => 7
		  ),
		));
	}

  	public function external_link_fields($obj){
		$obj->add_field(array(
			'name'       => esc_html__('External Link'),
			'id'         => 'gowilds_row_external_link',
			'classes'    => 'cmb2-row-hidden',
			'type'       => 'title',
			 'before_row' => array(__CLASS__, 'cmb2_before_row_header'),
		));
		$obj->add_field(array(
		  'name' => esc_html__('External link', 'gowilds-themer'),
		  'id'   => 'external_link',
		  'type' => 'text'
		));
		$obj->add_field(array(
		  'name' => esc_html__('External Link Description', 'gowilds-themer'),
		  'id'   => 'external_link_desc',
		  'type' => 'wysiwyg',
		  'options' => array(
				'wpautop' => true,
				'textarea_rows' => 6
		  ),
		));
  	}

	public static function taxonomies_metabox() {
		if (!class_exists('BABE_Post_types')) {
			return;
		}

		$taxonomies_arr = array();

		foreach (BABE_Post_types::$taxonomies_list as $taxonomy_id => $taxonomy) {
			$taxonomies_arr[] = $taxonomy['slug'];
		}

		if (!empty($taxonomies_arr)) {

			$cmb_term = new_cmb2_box(array(
			  'id'           => 'gowilds_taxonomies_icon',
			  'title'        => esc_html__('Fontawesome Metabox', 'gowilds-themer'),
			  'object_types' => array('term'), 
			  'taxonomies'   => $taxonomies_arr,
			));

			$cmb_term->add_field(array(
			  'name' => esc_html__('Icon class', 'gowilds-themer'),
			  'id'   => 'fa_class',
			  'type' => 'text',
			));

			$cmb_term->add_field(array(
			  'name'       => esc_html__('Featured Image', 'gowilds-themer'),
			  'id'         => 'gowilds_location_image',
			  'type'       => 'file',
			  'query_args' => array(
					'type' => array(
						 'image/gif',
						 'image/jpeg',
						 'image/png',
					),
			  ),
			));

			$group_field_id = $cmb_term->add_field( array(
			  'id'          => 'taxonomy_info',
			  'type'        => 'group',
			  'description' => esc_html__( 'Taxonomy Information', 'gowilds-themer' ),
			  'options'     => array(
					'group_title'       => esc_html__( 'Entry {#}', 'gowilds-themer' ),
					'add_button'        => esc_html__( 'Add Another Entry', 'gowilds-themer' ),
					'remove_button'     => esc_html__( 'Remove Entry', 'gowilds-themer' ),
					'sortable'          => true,
			  ),
			) );

			$cmb_term->add_group_field( $group_field_id, array(
			  'name' => esc_html__('Entry Title', 'gowilds-themer' ),
			  'id'   => 'gowilds_title',
			  'type' => 'text',
			) );

			$cmb_term->add_group_field( $group_field_id, array(
			  'name' => esc_html__('Description', 'gowilds-themer' ),
			  'description' => 'Write a short description for this entry',
			  'id'   => 'gowilds_description',
			  'type' => 'textarea_small',
			) );
		}
	}

	public static function cmb2_before_row_header($args, $field){
		$name = isset($args['name']) ? $args['name'] : '';
		$html = '<div class="cmb-row cmb-type-row-header"><div class="cmb2-before-row-header">' . esc_html($name) . '</div></div>';
		echo wp_kses($html, true);
	}
}

new Gowilds_Booking_Manager();