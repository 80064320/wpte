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

class GVAElement_Icon_Box_Group extends GVAElement_Base{
	const NAME = 'gva_icon_box_group';
	const TEMPLATE = 'booking/booking';
	const CATEGORY = 'gowilds_general';

	public function get_categories() {
		return array(self::CATEGORY);
	}
		
	public function get_name() {
		return self::NAME;
	}

	public function get_title() {
		return esc_html__('Icon Box Carousel/Grid', 'gowilds-themer');
	}

	public function get_keywords() {
		return [ 'icon', 'box', 'content', 'carousel', 'grid' ];
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
					'carousel'  => esc_html__('Carousel', 'gowilds-themer'),
					'list'  		=> esc_html__('List', 'gowilds-themer'),
				]
			]
		);

		$this->add_control(
			'style',
			[
				'label' 		=> esc_html__('Style', 'gowilds-themer'),
				'type' 		=> Controls_Manager::SELECT,
				'options' 	=> [
					'style-1' => esc_html__('Style 01', 'gowilds-themer'),
					'style-2' => esc_html__('Style 02', 'gowilds-themer')
				],
				'default' => 'style-1',
				'condition' => [
					'layout' => ['grid', 'carousel', 'list'],
				],
			]
		);

		$repeater = new Repeater();
		$repeater->add_control(
			'selected_icon',
			[
				'label'      	=> esc_html__('Choose Icon', 'gowilds-themer'),
				'type'       	=> Controls_Manager::ICONS,
				'default' 		=> [
					'value' 		=> 'icon-gowilds-strategy',
					'library' 	=> 'gowilds-icons-theme'
				]
			]
		);
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
				'default'	  => 'When nothing prevents our to we like best, every pleasure to be.'
			]
		);
		
		$repeater->add_control(
			'link',
			[
				'label'     	=> esc_html__('Link', 'gowilds-themer'),
				'type'      	=> Controls_Manager::URL,
				'placeholder' 	=> esc_html__('https://your-link.com', 'gowilds-themer'),
				'label_block' 	=> true
			]
		);

		$repeater->add_control(
			'active',
			[
				'label' 			=> esc_html__('Active', 'gowilds-themer'),
				'type' 			=> Controls_Manager::SWITCHER,
				'placeholder' 	=> esc_html__('Active', 'gowilds-themer'),
				'default' 		=> 'no'
			]
		);

		$this->add_control(
			'icon_boxs',
			[
				'label'       => esc_html__('Brand Content Item', 'gowilds-themer'),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ title }}}',
				'default'     => array(
					array(
						'title'  					=> esc_html__('Tent Camping', 'gowilds-themer'),
						'selected_icon' 			=> array('value' => 'micon__car'),
					),
					array(
						'title'  					=> esc_html__('Mountain Biking', 'gowilds-themer'),
						'selected_icon' 			=> array('value' => 'micon__cardiogram'),
					),
					array(
						'title'  					=> esc_html__('Home insurance', 'gowilds-themer'),
						'selected_icon' 			=> array('value' => 'micon__home1'),
					),
					array(
						'title'  					=> esc_html__('Business insurance', 'gowilds-themer'),
						'selected_icon' 			=> array('value' => 'micon__suitcase'),
					)
				)
			]
		);
		
		$this->end_controls_section();

		$this->add_control_carousel(false, array('layout' => 'carousel'));

		$this->add_control_grid(array('layout' => 'grid'));

		// Icon Styling
		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__('Style', 'gowilds-themer'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_box',
			[
				'label'	=> esc_html__('Box', 'gowilds-themer'),
				'type'	=> Controls_Manager::HEADING
			]
		);

		$this->add_control(
			'primary_color',
			[
				'label' 		=> esc_html__('Primary Color', 'gowilds-themer'),
				'type' 		=> Controls_Manager::COLOR,
				'default' 	=> '',
				'selectors' => [
					'{{WRAPPER}} .iconbox-one__single:after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .iconbox-two__single, {{WRAPPER}} .iconbox-two__single:after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .feature-list-one__icon' => 'background-color: {{VALUE}};'
				]
			] 
		);

		$this->add_control(
			'heading_icon',
			[
				'label'	=> esc_html__('Icon', 'gowilds-themer'),
				'type'	=> Controls_Manager::HEADING
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' 		=> esc_html__('Icon Color', 'gowilds-themer'),
				'type' 		=> Controls_Manager::COLOR,
				'default' 	=> '',
				'selectors' => [
					'{{WRAPPER}} .iconbox-one__icon i, {{WRAPPER}} .iconbox-two__icon i, {{WRAPPER}} .feature-list-one__icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} iconbox-one__icon svg, {{WRAPPER}} iconbox-two__icon svg, {{WRAPPER}} .feature-list-one__icon svg' => 'fill: {{VALUE}};'
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' 		=> esc_html__('Size', 'gowilds-themer'),
				'type' 		=> Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 80,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .iconbox-one__icon i, {{WRAPPER}} .iconbox-two__icon i, {{WRAPPER}} .feature-list-one__icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .iconbox-one__icon svg, {{WRAPPER}} .iconbox-two__icon svg, {{WRAPPER}} .feature-list-one__icon svg' => 'width: {{SIZE}}{{UNIT}};'
				],
			]
		);

		$this->add_responsive_control(
			'icon_space',
			[
				'label' 		=> esc_html__('Spacing', 'gowilds-themer'),
				'type' 		=> Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .iconbox-one__icon' => 'padding-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .iconbox-two__icon' => 'padding-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .feature-list-one__icon' => 'margin-right: {{SIZE}}{{UNIT}};'
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
					'{{WRAPPER}} .iconbox-one__icon, {{WRAPPER}} .iconbox-two__icon, {{WRAPPER}} .feature-list-one__icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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
		$this->add_control( 
			'title_color',
			[
				'label' => esc_html__('Color', 'gowilds-themer'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .iconbox-one__title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .iconbox-two__title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .feature-list-one__title' => 'color: {{VALUE}};'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .iconbox-one__title, {{WRAPPER}} .iconbox-two__title, {{WRAPPER}} .feature-list-one__title',
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
					'{{WRAPPER}} .iconbox-one__title' => 'padding-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .iconbox-two__title' => 'padding-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .feature-list-one__title' => 'padding-bottom: {{SIZE}}{{UNIT}};'
				],
			]
		); 


		$this->add_control(
			'heading_desc',
			[
				'label' => esc_html__('Description', 'gowilds-themer'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control( 
			'desc_color',
			[
				'label' => esc_html__('Color', 'gowilds-themer'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .iconbox-one__desc' => 'color: {{VALUE}};',
					'{{WRAPPER}} .iconbox-two__desc' => 'color: {{VALUE}};',
					'{{WRAPPER}} .feature-list-one__desc' => 'color: {{VALUE}};'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typography',
				'selector' => '{{WRAPPER}} .iconbox-one__desc, {{WRAPPER}} .iconbox-two__desc, {{WRAPPER}} .feature-list-one__desc',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		printf('<div class="gva-element-%s gva-element">', $this->get_name() );
			if( !empty($settings['layout']) ){
				include $this->get_template('general/icon-box-group/' . $settings['layout'] . '.php');
			}
		print '</div>';
	}

}

$widgets_manager->register(new GVAElement_Icon_Box_Group());
