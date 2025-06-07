<?php
if(!defined('ABSPATH')){ exit; }

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Directorist\Helper;

class GVAElement_All_Tour extends GVAElement_Base{
	const NAME = 'gva-all-tour';
	const TEMPLATE = 'wte/all-tour/';
	const CATEGORY = 'gowilds_wte';

	public function get_name() {
		return self::NAME;
	}
	
	public function get_categories() {
		return array(self::CATEGORY);
	}

	public function get_title() {
		return esc_html__('WTE All Tour', 'gowilds-themer');
	}

	public function get_keywords() {
		return [ 'listings', 'content', 'carousel', 'grid' ];
	}

	public function get_script_depends() {
		return [
			'swiper',
			'gavias.elements'
		];
	}

	public function get_style_depends() {
		return array('swiper');
	}

	// taxonomy = tour_destination, tour_type, tour_tour_attraction 
	private function get_listing_term($taxonomy) {
		$result = array();
		$terms = get_terms( $taxonomy );
		foreach ( $terms as $term ) {
			$result[$term->slug] = $term->name;
		}
		return $result;
	}

	protected function register_controls() {
	  	$taxonomies = array(
			'destination' => __( 'Destination', 'gowilds-themer' ),
			'activities'  => __( 'Activities', 'gowilds-themer' ),
			'trip_types'  => __( 'Trip Types', 'gowilds-themer' ),
			'difficulty'  => __( 'Difficulty', 'gowilds-themer' ),
			'trip_tag'    => __( 'Trip Tag', 'gowilds-themer' ),
		);

	  	$this->start_controls_section(
			'section_query',
			[
				'label' => esc_html__('General', 'gowilds-themer'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
	  	);
		$this->add_control(
		 	'layout',
		 	[
				'label' => esc_html__( 'Layout', 'gowilds-themer' ),
				'type' => Controls_Manager::SELECT,
				'options' => array(
					'carousel' 	=> __( 'Carousel', 'gowilds-themer' ),
					'grid' 		=> __( 'Grid', 'gowilds-themer' ),
				),
				'default' => 'grid',
		 	]
		);
      $this->add_control(
         'card_style',
         [
             'label'     => esc_html__('Style', 'gowilds-themer'),
             'type'      => \Elementor\Controls_Manager::SELECT,
             'options' => [
                 'trip-style-1'      => esc_html__( 'Item Style 01', 'gowilds-themer' ),
                 'trip-style-2'      => esc_html__( 'Item Style 02', 'gowilds-themer' ),
                 'trip-style-3'      => esc_html__( 'Item Style 03', 'gowilds-themer' ),
             ],
              'default' => 'trip-style-1',
         ]
      );

      $this->add_control(
			'heading_query',
			[
				'label' => esc_html__( 'Query', 'gowilds-themer' ),
				'type' => Controls_Manager::HEADING
			]
	  	);

	  	$this->add_control(
			'tripsCount',
			[
				'label' => esc_html__( 'Number Per Page to Show', 'gowilds-themer' ),
				'type' => Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 100,
				'step'      => 1,
				'default'   => 6,
			]
	  	);
	  	$this->add_control(
	  		'listby',
	  		[
				'type'     => Controls_Manager::SELECT,
				'label'    => __( 'Show Trips By', 'gowilds-themer' ),
				'multiple' => true,
				'options' => array(
					'featured' => __('Featured', 'gowilds-themer'),
					'latest'   => __('Latest', 'gowilds-themer'),
					'onsale'   => __('On Sale', 'gowilds-themer'),
					'byterms'  => __('By Terms', 'gowilds-themer'),
					'byid'     => __('By Trips IDs', 'gowilds-themer'),
				),
				'default'	  => 'latest'
			]
		);

	  	$this->add_control(
			'tripsToDisplay',
			[
				'type'     		=> Controls_Manager::TEXT,
				'label'    		=> __( 'Select Trips IDs', 'gowilds-themer' ),
				'description' 	=> esc_html__('Example: 10, 12, 13, 16', 'gowilds-themer'),
				'condition' => [
					'listby' => ['byid'],
				]
			]
		);

		$this->add_control(
			'tax_relation',
			[
				'type'     		=> Controls_Manager::SWITCHER,
				'label'    		=> __( 'Enable Tax Relation', 'gowilds-themer' ),
				'label_on'     => 'OR',
				'label_off'    => 'AND',
				'description'  => esc_html__('This includes trips with at least one selected term enabled.', 'gowilds-themer'),
				'condition' => [
					'listby' => ['byterms'],
				]
			]
		);

		foreach ( $taxonomies as $filter_name => $filter_args ) {
			$this->add_control(
				"{$filter_name}_termstoDisplay",
				[
					'type'     		 => Controls_Manager::SELECT2,
					'label'    		 => $filter_args,
					'taxonomy_name' => $filter_name,
					'options'		 => $this->get_listing_term($filter_name),
					'multiple'		 => true, 
					'condition' => [
						'listby' => ['byterms'],
					]
				]
			);
		}

	  	$this->add_control(
			'image_size',
			[
				'label'     => esc_html__('Image Size', 'gowilds-themer'),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => $this->get_thumbnail_size(),
				'default'   => 'gowilds_medium'
			]
		);

		$this->add_control(
			'excerpt_words',
			[
				'label'     => __('Excerpt Words', 'gowilds-themer'),
				'type'      => 'number',
				'default'   => 15
			]
	  	);

		$this->end_controls_section();

		$this->add_control_carousel(false, array('layout' => 'carousel'));

		$this->add_control_grid(array('layout' => 'grid'));

	}

	public function query_posts() {
	  	$attributes = $this->get_settings_for_display();

		$attributes['default_taxonomies'] = array(
			'destination',
			'activities',
			'trip_types',
			'difficulty',
			'trip_tag',
		);
		$results = array();

		$query_args = array(
			'post_type'      => \WP_TRAVEL_ENGINE_POST_TYPE,
			'posts_per_page' => $attributes['tripsCount'],
			'fields'         => 'ids',
			'post_status'    => 'publish',
		);

		if ( isset( $attributes['listby'] ) ) {
			//$query_args['suppress_filters'] = false;

			if ( 'byid' === $attributes['listby'] ) {
				if($attributes['tripsToDisplay']){
					$query_args['post__in'] = explode(',', $attributes['tripsToDisplay']);
				}
			} elseif ( 'byterms' === $attributes['listby'] ) {
				if ( isset( $attributes['default_taxonomies'] ) && 'byterms' === $attributes['listby'] ) {
					$query_args['tax_query'] = array(
						'relation' => isset( $attributes['tax_relation'] ) && '' != $attributes['tax_relation'] ? 'OR' : 'AND',
					);
					foreach ( $attributes['default_taxonomies'] as $taxonomy ) {
						if ( is_array( $attributes[ '' . $taxonomy . '_termstoDisplay' ] ) && isset( $attributes[ '' . $taxonomy . '_termstoDisplay' ] ) && count( $attributes[ '' . $taxonomy . '_termstoDisplay' ] ) > 0 ) {
							$query_args['tax_query'][] = array(
								'field'    => 'slug',
								'taxonomy' => $taxonomy,
								'terms'    => $attributes[ '' . $taxonomy . '_termstoDisplay' ],
							);
						}
					}
				}
			} else {
				if ( 'featured' === $attributes['listby'] ) {
					$query_args['meta_key']   = 'wp_travel_engine_featured_trip';
					$query_args['meta_value'] = 'yes';
				} elseif ( 'onsale' === $attributes['listby'] ) {
					$query_args['meta_key']   = '_s_has_sale';
					$query_args['meta_value'] = 'yes';
				}
			}
		}

	  	if(is_front_page()){
			$query_args['paged'] = (get_query_var('page')) ? get_query_var('page') : 1;
	  	}else{
			$query_args['paged'] = (get_query_var('paged')) ? get_query_var('paged') : 1;
	  	}
	  	$results = new WP_Query($query_args);
	  	
	  return $results;
	}


	protected function render() {
	  	$settings = $this->get_settings_for_display();
      // Load the template
		printf( '<div class="gva-element-%s gva-element">', $this->get_name() );
         include $this->get_template(self::TEMPLATE . $settings['layout'] . '.php');
      print '</div>';
	}
}

$widgets_manager->register(new GVAElement_All_Tour());
