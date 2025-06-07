<?php
if(!defined('ABSPATH')){ exit; }

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;

class GVAElement_Pricing_Block extends GVAElement_Base {
	const NAME = 'gva-pricing-block';
   const TEMPLATE = 'general/pricing-block';
   const CATEGORY = 'gowilds_general';

   public function get_name() {
      return self::NAME;
   }

   public function get_categories() {
      return array(self::CATEGORY);
   }

	public function get_title() {
		return __( 'Pricing Block', 'gowilds-themer' );
	}

	public function get_keywords() {
		return [ 'pricing', 'block' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'gowilds-themer' ),
			]
		);
		$this->add_control(
			'style',
			[
				'label' => __( 'Style', 'gowilds-themer' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'style-1' 		=> __( 'Style I: Default', 'gowilds-themer' )
				],
				'default' => 'style-1',
			]
		);
		$this->add_control(
			'title_text',
			[
				'label' => __( 'Title', 'gowilds-themer' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your title', 'gowilds-themer' ),
				'default' => __( 'Basic Plan', 'gowilds-themer' ),
				'label_block' => true
			]
		);
		$this->add_control(
			'subtitle_text',
			[
				'label' => __( 'Sub Title', 'gowilds-themer' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Save 45%', 'gowilds-themer' ),
				'default' => __( 'Save 45%', 'gowilds-themer' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'desc_text',
			[
				'label' => __( 'Description', 'gowilds-themer' ),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => __( 'Your Description', 'gowilds-themer' ),
				'default' => __( 'Suitable For Any IT Solutions.', 'gowilds-themer' ),
			]
		);
		$this->add_control(
			'price',
			[
				'label' => __( 'Price', 'gowilds-themer' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( '29.68', 'gowilds-themer' ),
				'default' => __( '29.68', 'gowilds-themer' ),
			]
		);
		$this->add_control(
			'currency',
			[
				'label' => __( 'Currency', 'gowilds-themer' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Currency', 'gowilds-themer' ),
				'default' => __( '$', 'gowilds-themer' ),
			]
		);
		$this->add_control(
			'period',
			[
				'label' => __( 'Period', 'gowilds-themer' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Monthly', 'gowilds-themer' ),
				'default' => __( 'Monthly', 'gowilds-themer' ),
			]
		);

		$repeater = new Repeater();
      $repeater->add_control(
         'pricing_features',
			[
	         'label'       => __('Pricing Features', 'gowilds-themer'),
	         'type'        => Controls_Manager::TEXT,
	         'default'     => 'Free text goes here',
	         'label_block' => true,
	     	]
	   );
	   $repeater->add_control(
         'feature_active',
			[
	         'label'       => __('Pricing Features', 'gowilds-themer'),
	         'type'        => Controls_Manager::SWITCHER,
	         'default'	  => 'yes'
	     	]
	   );
		$this->add_control(
         'pricing_content',
         [
            'label'       => __('Pricing Features', 'gowilds-themer'),
            'type'        => Controls_Manager::REPEATER,
            'fields'      => $repeater->get_controls(),
            'title_field' => '{{{ pricing_features }}}',
            'default'     => array(
               array(
                  'pricing_features'  => esc_html__( 'Resposive Design', 'gowilds-themer' )
               ),
               array(
                  'pricing_features'  => esc_html__( 'Unlimited Entities', 'gowilds-themer' )
               ),
               array(
                  'pricing_features'  => esc_html__( 'Premium Quality Support', 'gowilds-themer' ),
                  'feature_active'	=> 'no'
               ),
               array(
                  'pricing_features'  => esc_html__( 'Hosted In The Cloud', 'gowilds-themer' ),
                  'feature_active'	=> 'no'
               )
            ),
         ]
      );

      $this->add_control(
			'pricing_active',
			[
	         'label'       => __('Pricing Active', 'gowilds-themer'),
	         'type'        => Controls_Manager::SWITCHER,
	         'default'	  => 'no'
	     	]
		);

		$this->end_controls_section();

		$this->start_controls_section( //** Section Icon
			'section_Button',
			[
				'label' => __( 'Button', 'gowilds-themer' ),
			]
		);

		$this->add_control(
			'button_url',
			[
				'label' => __( 'Button URL', 'gowilds-themer' ),
				'type' => Controls_Manager::URL,
			]
		);

		$this->add_control(
			'button_text',
			[
				'label' => __( 'Button Text', 'gowilds-themer' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'Select Plan'
			]
		);

		$this->add_control(
			'button_style',
			[
				'label' => __( 'Button Style', 'gowilds-themer' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'btn-theme' 		=> esc_html__('Button Theme', 'gowilds-themer'),
					'btn-theme-2' 		=> esc_html__('Button Theme Second', 'gowilds-themer'),
					'btn-white' 		=> esc_html__('Button White', 'gowilds-themer'),
					'btn-black' 		=> esc_html__('Button Black', 'gowilds-themer')
				],
				'default' => 'btn-theme',
			]
		);

		
		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			[
				'label' => __( 'Title', 'gowilds-themer' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Text Color', 'gowilds-themer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-pricing .title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'selector' => '{{WRAPPER}} .gsc-pricing .title',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_price_style',
			[
				'label' => __( 'Price Text', 'gowilds-themer' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
 
		$this->add_control(
			'sub_title_color',
			[
				'label' => __( 'Text Color', 'gowilds-themer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-pricing .content-inner .plan-price .price-value' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_price_text',
				'selector' => '{{WRAPPER}} .gsc-pricing .content-inner .plan-price .price-value',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_style',
			[
				'label' => __( 'Content', 'gowilds-themer' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
 
		$this->add_control(
			'content_color',
			[
				'label' => __( 'Text Color', 'gowilds-themer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-pricing .content-inner .plan-list li .text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_content',
				'selector' => '{{WRAPPER}} .gsc-pricing .content-inner .plan-list li .text',
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Icon Color', 'gowilds-themer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-pricing .content-inner .plan-list li .icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		printf( '<div class="gva-element-%s gva-element">', $this->get_name() );
         include $this->get_template(self::TEMPLATE . '.php');
      print '</div>';
	}
}

$widgets_manager->register(new GVAElement_Pricing_Block());
