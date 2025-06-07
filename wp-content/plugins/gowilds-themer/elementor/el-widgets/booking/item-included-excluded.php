<?php
if (!defined('ABSPATH')) { exit; }

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

class GVAElement_BA_Item_Included_Excluded extends GVAElement_Base{
	 
	const NAME = 'gva_ba_item_included_excluded';
	const TEMPLATE = 'booking/item-included-excluded';
	const CATEGORY = 'gowilds_ba_booking';

	public function get_categories() {
		return array(self::CATEGORY);
	}

	public function get_name() {
		return self::NAME;
	}

	public function get_title() {
		return __('BA Item Included/Excluded', 'gowilds-themer');
	}

	public function get_keywords() {
		return [ 'booking', 'ba', 'item', 'book everthing', 'included', 'excluded' ];
	}


	protected function register_controls(){
		//--
		$this->start_controls_section(
			self::NAME . '_content',
			[
				'label' => esc_html__('Content', 'gowilds-themer'),
			]
		);

		$this->add_control(
			'type',
			[
				'label' => __( 'Type', 'gowilds-themer' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'included'      => __( 'Included', 'gowilds-themer' ),
					'excluded'      => __( 'Excluded', 'gowilds-themer' ),
				],
				'default' => 'included',
			]
		);

		$this->add_control(
			'heading_style_value',
			[
				'label' => esc_html__( 'Style Text', 'gowilds-themer' ),
				'type' => Controls_Manager::HEADING
			]
		);


		 $this->add_control(
			'list_item_space',
			[
				'label' => esc_html__( 'List Item space', 'gowilds-themer' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
				  'size' => 8
				],
				'range' => [
				  'px' => [
					 'min' => 0,
					 'max' => 30,
				  ],
				],
				'selectors' => [
					'{{WRAPPER}} .gowilds-single-in-ex ul li' => 'margin-bottom: {{SIZE}}{{UNIT}};', 
				],
			]
		);

		$this->add_control(
			'value_color',
			[
				'label' => esc_html__( 'Text Color', 'gowilds-themer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gowilds-single-in-ex ul li' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'value_typography',
				'selector' => '{{WRAPPER}} .gowilds-single-in-ex ul li',
			]
		);

		// --- Style Icon ---
		$this->add_control(
			'heading_style_icon',
			[
				'label' => esc_html__( 'Style Icon', 'gowilds-themer' ),
				'type' => Controls_Manager::HEADING
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'gowilds-themer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gowilds-single-in-ex ul li:before' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Size', 'gowilds-themer' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
				  'size' => 14
				],
				'range' => [
				  'px' => [
					 'min' => 5,
					 'max' => 80,
				  ],
				],
				'selectors' => [
				  '{{WRAPPER}} .gowilds-single-in-ex ul li:before' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_space',
			[
				'label' => __( 'Spacing', 'gowilds-themer' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
				  'size' => 10,
				],
				'range' => [
				  'px' => [
					 'min' => 0,
					 'max' => 50,
				  ],
				],
				'selectors' => [
				  '{{WRAPPER}} .gowilds-single-in-ex ul li:before' => 'padding-right: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->end_controls_section();

	}

	protected function render(){
		parent::render();

		$settings = $this->get_settings_for_display();
		printf( '<div class="gowilds-%s gowilds-element">', $this->get_name() );
			include $this->get_template(self::TEMPLATE . '.php');
		print '</div>';
	}
}

$widgets_manager->register(new GVAElement_BA_Item_Included_Excluded());
