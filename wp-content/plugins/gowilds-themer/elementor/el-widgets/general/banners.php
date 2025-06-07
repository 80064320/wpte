<?php

if (!defined('ABSPATH')) {
	 exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;

class GVAElement_Banners extends GVAElement_Base{
	const NAME = 'gva-banners';
	const TEMPLATE = 'general/banners';
	const CATEGORY = 'gowilds_general';

	public function get_categories() {
		return self::CATEGORY;
	}

	public function get_name() {
		return self::NAME;
	}

	public function get_title() {
		return esc_html__('Banners Grid/Carousel', 'gowilds-themer');
	}

	public function get_keywords() {
		return [ 'booking', 'banner', 'tour', 'image', 'content' ];
	}

	public function get_script_depends() {
		return [
			'swiper',
			'gavias.elements',
		];
	}

	public function get_style_depends() {
		return array('swiper');
	}

	protected function register_controls() {
		$taxonomies_list = array();
		
		if(defined('BABE_VERSION')){
			$taxonomies = get_terms(array(
				'taxonomy' => BABE_Post_types::$taxonomies_list_tax,
				'hide_empty' => false
			));

			if(!is_wp_error($taxonomies) && ! empty($taxonomies)){
				foreach ($taxonomies as $tax_term) {
					$taxonomies_list[BABE_Post_types::$attr_tax_pref . $tax_term->slug] = 'BA ' . apply_filters('translate_text', $tax_term->name);
				}
			}
		}

		if(class_exists('\WPTravelEngine\Plugin')){
			$taxonomies_list['destination'] = esc_html__('WTE Trip Destination Taxonomy', 'gowilds-themer');
			$taxonomies_list['trip_types'] = esc_html__('WTF Trip Type Taxonomy', 'gowilds-themer');
		}

		$this->start_controls_section(
			'section_content',
			[
				'label' => __('Content', 'gowilds-themer'),
			]
		);
		$this->add_control( // xx Layout
			'layout_heading',
			[
				'label'   => esc_html__('Layout', 'gowilds-themer'),
				'type'    => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'layout',
			[
				'label'   => esc_html__('Layout Display', 'gowilds-themer'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'carousel',
				'options' => [
					'grid'      => esc_html__('Grid', 'gowilds-themer'),
					'carousel'  => esc_html__('Carousel', 'gowilds-themer')
				]
			]
		);
		$this->add_control(
			'style',
			[
				'label'     => __('Style', 'gowilds-themer'),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => [
					'style-1'      => __('Style 01', 'gowilds-themer'),
					'style-2'      => __('Style 02', 'gowilds-themer'),
					'style-3'      => __('Style 03', 'gowilds-themer')
				],
			]
	  	);
	  	$repeater = new Repeater();
	  	$repeater->add_control(
			'subtitle',
			[
				'label' => __('SubTitle', 'gowilds-themer'),
				'type' => Controls_Manager::TEXT,
				'label_block'	=> true,
				'placeholder' => esc_html__('Add your Title', 'gowilds-themer'),
				'default' => esc_html__('Travel to', 'gowilds-themer')
			]
		);
		$repeater->add_control(
			'title',
			[
				'label' => __('Title', 'gowilds-themer'),
				'type' => Controls_Manager::TEXT,
				'label_block'	=> true,
				'placeholder' => esc_html__('Add your Title', 'gowilds-themer'),
				'default' => esc_html__('Switzerland', 'gowilds-themer')
			]
		);
		$repeater->add_control(
			'desc',
			[
				'label'       => esc_html__('Description', 'gowilds-themer'),
				'type'        => Controls_Manager::TEXTAREA,
				'default'	  => 'When nothing prevents our to we like best, every pleasure to be.'
			]
		);
		$repeater->add_control(
			'image',
			[
				'label' 		=> __('Image', 'gowilds-themer'),
				'type' 		=> Controls_Manager::TEXT,
				'default'    => [
					 'url' => GAVIAS_GOWILDS_PLUGIN_URL . 'elementor/assets/images/image-1.jpg',
				],
				'type'       => Controls_Manager::MEDIA,
				'show_label' => false,
			]
		);
			
		$repeater->add_control(
			'taxonomy',
			[
				'label' => __('Taxonomy', 'gowilds-themer'),
				'type' => Controls_Manager::SELECT,
				'label_block'	=> true,
				'options' => $taxonomies_list,
				'default' => 'ba_location',
			]
		);
		$repeater->add_control(
			'term_slug',
			[
				'label' => __('Region & Category Slug', 'gowilds-themer'),
				'type' => Controls_Manager::TEXT,
				'label_block'	=> true,
				'placeholder' => esc_html__('Term slug', 'gowilds-themer'),
				'default' => ''
			]
		);

		$repeater->add_control(
			'link_custom',
			[
				'label' => __('Link Custom', 'gowilds-themer'),
				'type' => Controls_Manager::TEXT,
				'label_block'	=> true,
				'default' => ''
			]
		);
		
		$this->add_control(
			'banners_content',
			[
				'label'       => esc_html__('Branner Content Item', 'gowilds-themer'),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ title }}}',
				'default'     => array(
					array(
						'title'  => esc_html__('Tent Campings', 'gowilds-themer'),
						'image'  => [
                     'url' => GAVIAS_GOWILDS_PLUGIN_URL . 'elementor/assets/images/image-1.jpg'
                  ]
					),
					array(
						'title'  => esc_html__('Trailers and RV Spots', 'gowilds-themer'),
						'image'  => [
                     'url' => GAVIAS_GOWILDS_PLUGIN_URL . 'elementor/assets/images/image-2.jpg'
                  ]
					),
					array(
						'title'  => esc_html__('Adventure Climbing', 'gowilds-themer'),
						'image'  => [
                     'url' => GAVIAS_GOWILDS_PLUGIN_URL . 'elementor/assets/images/image-3.jpg'
                  ]
					),
					array(
						'title'  => esc_html__('Couple Camping', 'gowilds-themer'),
						'image'  => [
                     'url' => GAVIAS_GOWILDS_PLUGIN_URL . 'elementor/assets/images/image-4.jpg'
                  ]
					)
				)
			]
		);

		$this->add_responsive_control(
			'height',
			[
				'label' => __('Height', 'gowilds-themer'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
				  'px' => [
					 'min' => 100,
					 'max' => 1000,
				  ],
				],
				'default' => [
				  'size'  => 380
				],
				'condition' => [
				  'style' => ['style-1']
				],
				'selectors' => [
				  '{{WRAPPER}} .banner-one__content' => 'min-height: {{SIZE}}{{UNIT}};',
				],
			]
		); 

		$this->add_control(
			'image_size',
			[
				'label'     => __('Image Size', 'gowilds-themer'),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => $this->get_thumbnail_size(),
				'default'   => 'full'
			]
		);
		if(defined('BABE_VERSION')){
			$this->add_control(
				'show_number_content',
				[
					'label'   => __('Show number content', 'gowilds-themer'),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'no'
				]
			 );
			$this->add_control(
				'show_number_text',
				[
					'label'   => __('Text Prefix', 'gowilds-themer'),
					'type'    => Controls_Manager::TEXT,
					'default' => esc_html__('tours', 'gowilds-themer'),
					'condition' => [
					  'show_number_content' => ['yes']
					],
				]
			 );
			$this->add_control(
				'show_number_one_text',
				[
					'label'   => __('Text Prefix One Item', 'gowilds-themer'),
					'type'    => Controls_Manager::TEXT,
					'default' => esc_html__('tour', 'gowilds-themer'),
					'condition' => [
					  'show_number_content' => ['yes']
					],
				]
			);
		}
		$this->end_controls_section();

		$this->add_control_carousel(false, array('layout' => 'carousel'));
		$this->add_control_grid(array('layout' => 'grid'));

		$this->start_controls_section(
			'section_style_content',
			[
				'label' => __('Content', 'gowilds-themer'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_subtitle',
			[
				'label' => __('Sub Title', 'gowilds-themer'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		  $this->add_control(
			 'subtitle_color',
			 [
				'label' => __('Color', 'gowilds-themer'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
				  '{{WRAPPER}} .banner-one__subtitle' => 'color: {{VALUE}};',
				  '{{WRAPPER}} .banner-two__subtitle' => 'color: {{VALUE}};',
				  '{{WRAPPER}} .banner-three__subtitle' => 'color: {{VALUE}};'
				],
			 ]
		  );

		  $this->add_group_control(
			 Group_Control_Typography::get_type(),
			 [
				'name' => 'subtitle_typography',
				'selector' => '{{WRAPPER}} .banner-one__subtitle, {{WRAPPER}} .banner-two__subtitle, {{WRAPPER}} .banner-three__subtitle',
			 ]
		  );

		$this->add_control(
			'heading_title',
			[
				'label' => __('Title', 'gowilds-themer'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		  $this->add_control(
			 'title_color',
			 [
				'label' => __('Color', 'gowilds-themer'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
				  '{{WRAPPER}} .banner-one__title' => 'color: {{VALUE}};',
				  '{{WRAPPER}} .banner-two__title' => 'color: {{VALUE}};',
				  '{{WRAPPER}} .banner-three__title' => 'color: {{VALUE}};'
				],
			 ]
		  );

		  $this->add_group_control(
			 Group_Control_Typography::get_type(),
			 [
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .banner-one__title, {{WRAPPER}} .banner-two__title, {{WRAPPER}} .banner-three__title'
			 ]
		  );


		  $this->end_controls_section();
	 }

	 /**
	  * Render testimonial widget output on the frontend.
	  *
	  * Written in PHP and used to generate the final HTML.
	  *
	  * @since  1.0.0
	  * @access protected
	  */
	 protected function render() {
		$settings = $this->get_settings_for_display();
		printf('<div class="gva-element-%s gva-element">', $this->get_name() );
		if( !empty($settings['layout']) ){
			include $this->get_template('general/banners/' . $settings['layout'] . '.php');
		}
		print '</div>';
	 }

}

$widgets_manager->register(new GVAElement_Banners());
