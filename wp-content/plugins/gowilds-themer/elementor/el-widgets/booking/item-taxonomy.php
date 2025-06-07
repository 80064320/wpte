<?php
if (!defined('ABSPATH')) { exit; }

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

class GVAElement_BA_Item_Taxonomy extends GVAElement_Base{
	 
	const NAME = 'gva_ba_item_taxonomy';
	const TEMPLATE = 'booking/item-taxonomy';
	const CATEGORY = 'gowilds_ba_booking';

	public function get_categories() {
		return array(self::CATEGORY);
	}

	public function get_name() {
		return self::NAME;
	}

	public function get_title() {
		return __('BA Item Taxonomy', 'gowilds-themer');
	}

	public function get_keywords() {
		return [ 'booking', 'ba', 'item', 'book everthing', 'taxonomy', 'term', 'locations', 'amenities', 'language', 'type' ];
	}


	protected function register_controls() {

		$taxonomies = get_terms( array(
			'taxonomy' => BABE_Post_types::$taxonomies_list_tax,
			'hide_empty' => false
		));

		$taxonomies_arr = array();
		if (!is_wp_error($taxonomies) && ! empty($taxonomies)){
			foreach ($taxonomies as $tax_term) {
				$taxonomies_arr[$tax_term->slug] = apply_filters('translate_text', $tax_term->name);
			}
		}

		$taxonomies_arr = array();
      $taxonomies = BABE_Post_types::$taxonomies_list;
      
      foreach ($taxonomies as $tax_term) {
         $taxonomies_arr[$tax_term['slug']] = apply_filters('translate_text', $tax_term['name']);
      }


		$this->start_controls_section(
			self::NAME . '_content',
			[
				'label' => esc_html__('Content', 'gowilds-themer'),
			]
		);

		$this->add_control(
			'title_text',
			[
				'label'        => esc_html__('Title', 'gowilds-themer'),
				'type'         => Controls_Manager::TEXT,
				'placeholder'  => esc_html__('Enter your title', 'gowilds-themer'),
				'default'      => esc_html__('Your Title', 'gowilds-themer'),
				'label_block'  => true
			]
		);
		$this->add_control(
			'taxonomy_slug',
			array(
				'label'   => esc_html__('Ba Taxonomies', 'gowilds-themer'),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => $taxonomies_arr,
				'label_block' => true,
			)
		);

		$this->add_control(
			'style',
			[
				'label'     => __('Style', 'gowilds-themer'),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => [
					'style-1'      => __('Style I', 'gowilds-themer'),
					'style-2'      => __('Style II', 'gowilds-themer')
				],
				'condition' => [
					'taxonomy_slug' => array('features', 'amenities', 'car-amenities', 'car-feautures')
				]
			]
	  	);

		$this->add_control(
			'selected_icon',
			[
				'label'      => esc_html__('Choose Icon', 'gowilds-themer'),
				'type'       => Controls_Manager::ICONS,
				'default' => [
				  'value' => 'flaticon-place'
				]
			]
		);

		$this->add_control(
			'heading_style_title',
			[
				'label' => esc_html__('Style Title Text', 'gowilds-themer'),
				'type' => Controls_Manager::HEADING
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Text Color', 'gowilds-themer'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gowilds-single-taxonomy .ba-meta-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .gowilds-single-taxonomy .ba-meta-title',
			]
		);

		$this->add_control(
			'heading_style_value',
			[
				'label' => esc_html__('Style Value Text', 'gowilds-themer'),
				'type' => Controls_Manager::HEADING
			]
		);
		$this->add_control(
			'value_color',
			[
				'label' => esc_html__('Text Color', 'gowilds-themer'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gowilds-single-taxonomy .item-value' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'value_typography',
				'selector' => '{{WRAPPER}} .gowilds-single-taxonomy .item-value',
			]
		);

		// --- Style Icon ---
		$this->add_control(
			'heading_style_icon',
			[
				'label' => esc_html__('Style Icon', 'gowilds-themer'),
				'type' => Controls_Manager::HEADING
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__('Icon Color', 'gowilds-themer'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gowilds-single-taxonomy .icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .gowilds-single-taxonomy .icon svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .gowilds-single-taxonomy.style-2 .content-inner .box-content .term-item i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .gowilds-single-taxonomy.style-2 .content-inner .box-content .term-item svg' => 'fill: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __('Size', 'gowilds-themer'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
				  'size' => 32
				],
				'range' => [
				  'px' => [
					 'min' => 20,
					 'max' => 80,
				  ],
				],
				'selectors' => [
				  '{{WRAPPER}} .gowilds-single-taxonomy .icon i' => 'font-size: {{SIZE}}{{UNIT}};',
				  '{{WRAPPER}} .gowilds-single-taxonomy .icon svg' => 'width: {{SIZE}}{{UNIT}};',
				  '{{WRAPPER}} .gowilds-single-taxonomy.style-2 .content-inner .box-content .term-item i' => 'font-size: {{SIZE}}{{UNIT}};',
				  '{{WRAPPER}} .gowilds-single-taxonomy.style-2 .content-inner .box-content .term-item svg' => 'width: {{SIZE}}{{UNIT}};'

				],
			]
		);

		$this->add_responsive_control(
			'icon_space',
			[
				'label' => __('Spacing', 'gowilds-themer'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
				  'size' => 12,
				],
				'range' => [
				  'px' => [
					 'min' => 0,
					 'max' => 50,
				  ],
				],
				'selectors' => [
				  '{{WRAPPER}} .gowilds-single-taxonomy .icon' => 'padding-right: {{SIZE}}{{UNIT}};',
				  '{{WRAPPER}} .gowilds-single-taxonomy.style-2 .content-inner .box-content .term-item i' => 'margin-right: {{SIZE}}{{UNIT}};',
				  '{{WRAPPER}} .gowilds-single-taxonomy.style-2 .content-inner .box-content .term-item svg' => 'margin-right: {{SIZE}}{{UNIT}};'
				],
			]
		);


		$this->end_controls_section();

	}

	protected function render(){
		parent::render();

		$settings = $this->get_settings_for_display();
		printf('<div class="gowilds-%s gowilds-element">', $this->get_name() );
			include $this->get_template(self::TEMPLATE . '.php');
		print '</div>';
	}
}

$widgets_manager->register(new GVAElement_BA_Item_Taxonomy());
