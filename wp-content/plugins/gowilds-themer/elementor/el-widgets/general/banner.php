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

class GVAElement_Banner extends GVAElement_Base{
	
	const NAME = 'ba_banner';
	const TEMPLATE = 'general/banner';
	const CATEGORY = 'gowilds_general';

	public function get_categories() {
		return self::CATEGORY;
	}

	public function get_name() {
		return self::NAME;
	}

	public function get_title() {
		return esc_html__('BA Banner Block', 'gowilds-themer');
	}

	public function get_keywords() {
		return [ 'booking', 'banner', 'tour' ];
	}

	public function get_script_depends() {
		return array();
	}

	public function get_style_depends() {
		return array();
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
					$taxonomies_list[BABE_Post_types::$attr_tax_pref . $tax_term->slug] = 'BA ' .  apply_filters('translate_text', $tax_term->name);
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
		$this->add_control(
			'style',
			[
				'label'     => __('Style', 'gowilds-themer'),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => [
					'style-1'      => __('Style I', 'gowilds-themer'),
					'style-2'      => __('Style II', 'gowilds-themer'),
					'style-3'      => __('Style III', 'gowilds-themer')
				],
			]
	  	);
		$this->add_control(
			'subtitle',
			[
				'label' => __('SubTitle', 'gowilds-themer'),
				'type' => Controls_Manager::TEXT,
				'label_block'	=> true,
				'placeholder' => esc_html__('Add your Sub Title', 'gowilds-themer'),
				'default' => esc_html__('Travel to', 'gowilds-themer')
			]
		);
		$this->add_control(
			'title',
			[
				'label' => __('Title', 'gowilds-themer'),
				'type' => Controls_Manager::TEXT,
				'label_block'	=> true,
				'placeholder' => esc_html__('Add your Title', 'gowilds-themer'),
				'default' => esc_html__('Switzerland', 'gowilds-themer')
			]
		);
		if(defined('BABE_VERSION')){
			$this->add_control(
				'taxonomy',
				[
					'label' => __('Taxonomy', 'gowilds-themer'),
					'type' => Controls_Manager::SELECT,
					'label_block'	=> true,
					'options' => $taxonomies_list,
					'default' => 'ba_location',
				]
			);

			$this->add_control(
				'term_slug',
				[
					'label' => __('Region & Category Slug', 'gowilds-themer'),
					'type' => Controls_Manager::TEXT,
					'label_block'	=> true,
					'placeholder' => esc_html__('Term slug', 'gowilds-themer'),
					'default' => ''
				]
			);
		}
		$this->add_control(
			'image',
			[
				'label' 		=> __('Image', 'gowilds-themer'),
				'type' 		=> Controls_Manager::TEXT,
				'default'    => [
					 'url' => GAVIAS_GOWILDS_PLUGIN_URL . 'elementor/assets/images/image-banner.jpg',
				],
				'type'       => Controls_Manager::MEDIA,
				'show_label' => false,
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
					 'max' => 500,
				  ],
				],
				'default' => [
				  'size'  => 270
				],
				'condition' => [
				  'style' => ['style-1', 'style-2']
				],
				'selectors' => [
				  '{{WRAPPER}} .lt-banner-one__wrap' => 'min-height: {{SIZE}}{{UNIT}};',
				  '{{WRAPPER}} .lt-banner-two__wrap' => 'min-height: {{SIZE}}{{UNIT}};'
				],
			]
		); 

		$this->add_control(
			'link_custom',
			[
				'label' => __('Link Custom', 'gowilds-themer'),
				'type' => Controls_Manager::TEXT,
				'label_block'	=> true,
				'default' => ''
			]
		);
		$this->add_control(
			'new_tab',
			[
				'label'   => __('Open New Tab', 'gowilds-themer'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no'
			]
		 );
		$this->add_control(
			'btn_title',
			[
				'label' => __('Title Button', 'gowilds-themer'),
				'type' => Controls_Manager::TEXT,
				'label_block'	=> true,
				'default' => 'View Deals'
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
	
		$this->add_control(
			'content_align',
			[
				'label' => __('Alignment Text', 'gowilds-themer'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __('Left', 'gowilds-themer'),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __('Center', 'gowilds-themer'),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __('Right', 'gowilds-themer'),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'center',
			]
		);
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
		$this->end_controls_section();


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
				  '{{WRAPPER}} .lt-banner-one__subtitle' => 'color: {{VALUE}};',
				  '{{WRAPPER}} .lt-banner-two__subtitle' => 'color: {{VALUE}};',
				  '{{WRAPPER}} .lt-banner-three__subtitle' => 'color: {{VALUE}};'
				],
			 ]
		  );

		  $this->add_group_control(
			 Group_Control_Typography::get_type(),
			 [
				'name' => 'subtitle_typography',
				'selector' => '{{WRAPPER}} .lt-banner-one__subtitle, {{WRAPPER}} .lt-banner-two__subtitle, {{WRAPPER}} .lt-banner-three__subtitle',
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
				  '{{WRAPPER}} .lt-banner-one__title' => 'color: {{VALUE}};',
				  '{{WRAPPER}} .lt-banner-two__title' => 'color: {{VALUE}};',
				  '{{WRAPPER}} .lt-banner-three__title' => 'color: {{VALUE}};'
				],
			 ]
		  );

		  $this->add_group_control(
			 Group_Control_Typography::get_type(),
			 [
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .lt-banner-one__title, {{WRAPPER}} .lt-banner-two__title, {{WRAPPER}} .lt-banner-three__title'
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
			include $this->get_template( self::TEMPLATE . '.php');
		print '</div>';
	 }

}

$widgets_manager->register(new GVAElement_Banner());
