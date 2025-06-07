<?php
if(!defined('ABSPATH')){ exit; }

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;

class GVAElement_Services extends GVAElement_Base{
  	const NAME = 'gva-services';
  	const TEMPLATE = 'general/services/';
  	const CATEGORY = 'gowilds_general';

  	public function get_name() {
	 	return self::NAME;
  	}

  	public function get_categories() {
	 	return array(self::CATEGORY);
  	}

	public function get_title() {
		return esc_html__('Services Grid/Carousel', 'gowilds-themer');
	}

	public function get_keywords() {
		return [ 'services', 'content', 'carousel', 'grid' ];
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
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__('Content', 'gowilds-themer'),
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
				'label' => esc_html__('Style', 'gowilds-themer'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'style-1' 	=> esc_html__('Style 01', 'gowilds-themer'),
					'style-2' 	=> esc_html__('Style 02', 'gowilds-themer'),
					'style-3' 	=> esc_html__('Style 03', 'gowilds-themer')
				],
				'default' => 'style-1',
			]
	  	);
		$this->add_responsive_control(
			'min_height',
			[
				'label' 		=> esc_html__('Min Height', 'gowilds-themer'),
				'type' 		=> Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 200,
						'max' => 600,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .service-one__content' => 'min-height: {{SIZE}}{{UNIT}};',
					
				],
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'title',
			[
				'label'       => esc_html__('Title', 'gowilds-themer'),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Add your Title',
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'desc',
			[
				'label'       => esc_html__('Description', 'gowilds-themer'),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => 'Lorem ipsum dolor sit amet, sed consectetur elit.',
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'image',
			[
				'label'      => esc_html__('Choose Image', 'gowilds-themer'),
				'default'    => [
					'url' => GAVIAS_GOWILDS_PLUGIN_URL . 'elementor/assets/images/image-3.jpg',
				],
				'type'       => Controls_Manager::MEDIA,
				'show_label' => false,
			]
		);
		$repeater->add_control(
			'selected_icon',
			[
				'label'      => esc_html__('Choose Icon', 'gowilds-themer'),
				'type'       => Controls_Manager::ICONS,
				'default' => [
				  'value' => 'fas fa-home',
				  'library' => 'fa-solid',
				]
			]
		);
		$repeater->add_control(
			'link',
			[
				'label'     => esc_html__('Link', 'gowilds-themer'),
				'type'      => Controls_Manager::URL,
				'placeholder' => esc_html__('https://your-link.com', 'gowilds-themer'),
				'label_block' => true
			]
		);
		$repeater->add_control(
         'active',
			[
	         'label'       => __('Active', 'gowilds-themer'),
	         'type'        => Controls_Manager::SWITCHER,
	         'default'	  => 'no'
	     	]
	   );
		$this->add_control(
			'services_content',
			[
				'label'       => esc_html__('Service Content Item', 'gowilds-themer'),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ title }}}',
				'default'     => array(
				  	array(
					 	'title'  => esc_html__('Tent Camping', 'gowilds-themer'),
					 	'image'  => [
                     'url' => GAVIAS_GOWILDS_PLUGIN_URL . 'elementor/assets/images/image-5.jpg'
                  ]
				  	),
				  	array(
					 	'title'  => esc_html__('Glamping Cabin', 'gowilds-themer'),
					 	'image'  => [
                     'url' => GAVIAS_GOWILDS_PLUGIN_URL . 'elementor/assets/images/image-6.jpg'
                  ]
				  	),
				  	array(
					 	'title'  => esc_html__('Adventure and climbing', 'gowilds-themer'),
					 	'image'  => [
                     'url' => GAVIAS_GOWILDS_PLUGIN_URL . 'elementor/assets/images/image-7.jpg'
                  ]
				  	),
				  	array(
					 	'title'  => esc_html__('Mountain climbing', 'gowilds-themer'),
					 	'image'  => [
                     'url' => GAVIAS_GOWILDS_PLUGIN_URL . 'elementor/assets/images/image-8.jpg'
                  ]
				  	)
				)
			]
		);
		
		$this->add_control(
			'image_size',
			[
				'label'     => __('Image Size', 'gowilds-themer'),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => $this->get_thumbnail_size(),
				'default'   => ''
			]
		);

		$this->end_controls_section();

		$this->add_control_carousel(false, array('layout' => 'carousel'));

		$this->add_control_grid(array('layout' => 'grid'));

		// Icon Styling
		$this->start_controls_section(
			'section_style_icon',
			[
				'label' => esc_html__('Icon', 'gowilds-themer'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__('Icon Color', 'gowilds-themer'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
				  '{{WRAPPER}} .service-one__icon i, {{WRAPPER}} .service-two__icon i, {{WRAPPER}} .service-three__icon i' => 'color: {{VALUE}};',
				  '{{WRAPPER}} .service-one__icon svg, {{WRAPPER}} .service-two__icon svg, {{WRAPPER}} .service-three__icon svg' => 'fill: {{VALUE}};'
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => esc_html__('Size', 'gowilds-themer'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
				  'px' => [
					 'min' => 20,
					 'max' => 80, 
				  ],
				],
				'selectors' => [
				  '{{WRAPPER}} .service-one__icon i, {{WRAPPER}} .service-two__icon i, {{WRAPPER}} .service-three__icon i' => 'font-size: {{SIZE}}{{UNIT}};',
				  '{{WRAPPER}} .service-one__icon svg, {{WRAPPER}} .service-two__icon svg, {{WRAPPER}} .service-three__icon svg' => 'width: {{SIZE}}{{UNIT}};'
				],
			]
		);

		$this->add_responsive_control(
			'icon_padding',
			[
				'label' => esc_html__('Padding', 'gowilds-themer'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
				  '{{WRAPPER}} .service-one__icon, {{WRAPPER}} .service-two__icon, {{WRAPPER}} .service-three__icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	 	$this->start_controls_section(
			'section_style_content',
			[
				'label' => esc_html__('Content', 'gowilds-themer'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_title',
			[
				'label' => esc_html__('Title', 'gowilds-themer'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'title_bottom_space',
			[
				'label' => esc_html__('Spacing', 'gowilds-themer'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
				  'px' => [
					 'min' => 0,
					 'max' => 100,
				  ],
				],
				'selectors' => [
				  '{{WRAPPER}} .service-one__title, {{WRAPPER}} .service-two__title, {{WRAPPER}} .service-three__title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		); 

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Color', 'gowilds-themer'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
				  '{{WRAPPER}} .service-one__title, {{WRAPPER}} .service-two__title, {{WRAPPER}} .service-three__title' => 'color: {{VALUE}};',
				  '{{WRAPPER}} .service-one__title a, {{WRAPPER}} .service-two__title a, {{WRAPPER}} .service-three__title a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .service-one__title, {{WRAPPER}} .service-two__title, {{WRAPPER}} .service-three__title',
			]
		);

		$this->add_control(
			'heading_description',
			[
				'label' => esc_html__('Description', 'gowilds-themer'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => esc_html__('Color', 'gowilds-themer'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
				  '{{WRAPPER}} .service-one__desc, {{WRAPPER}} .service-two__desc, {{WRAPPER}} .service-three__desc' => 'color: {{VALUE}};',
				],
			]
		);

	  	$this->add_group_control(
		 	Group_Control_Typography::get_type(),
		 	[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .service-one__desc, {{WRAPPER}} .service-two__desc, {{WRAPPER}} .service-three__desc',
			]
	  	);

		$this->end_controls_section();
	 }

	 protected function render() {
		$settings = $this->get_settings_for_display();
		printf('<div class="gva-element-%s gva-element">', $this->get_name() );
		if( !empty($settings['layout']) ){
			include $this->get_template(self::TEMPLATE . $settings['layout'] . '.php');
		}
		print '</div>';
	 }

}

$widgets_manager->register(new GVAElement_Services());
