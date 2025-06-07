<?php
if(!defined('ABSPATH')){ exit; }

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;


class GVAElement_Career_Block extends GVAElement_Base {
	const NAME = 'gva-career-block';
   const TEMPLATE = 'general/career-block';
   const CATEGORY = 'gowilds_general';

	public function get_name() {
      return self::NAME;
   }

   public function get_categories() {
      return array(self::CATEGORY);
   }

	public function get_title() {
		return __( 'Career Block', 'gowilds-themer' );
	}

	public function get_keywords() {
		return [ 'career', 'block', 'text' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'gowilds-themer' ),
			]
		);
		$this->add_control(
			'title_text',
			[
				'label' => __( 'Title', 'gowilds-themer' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your title', 'gowilds-themer' ),
				'default' => __( 'Categories', 'gowilds-themer' ),
				'label_block' => true
			]
		);
		$this->add_control(
			'job_content',
			[
				'label' => __( 'Job Type', 'gowilds-themer' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => 'Sed ut perspiciatis unde omnis iste natus error voluptatem doloremque laudantium totam rem aperiam'
			]
		);
		$this->add_control(
			'header_tag',
			[
				'label' => __( 'HTML Tag', 'gowilds-themer' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
				],
				'default' => 'h2',
			]
		);
		$this->add_control(
			'link',
			[
				'label' => __( 'Link', 'gowilds-themer' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'gowilds-themer' ),
				'separator' => 'before',
			]
		);
		$this->end_controls_section();


		$this->start_controls_section( 
			'content',
			[
				'label' => __( 'Content', 'gowilds-themer' ),
			]
		);
		$this->add_control(
			'job_type',
			[
				'label' => __( 'Job Type', 'gowilds-themer' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'Full Time'
			]
		);
		$this->add_control(
			'company',
			[
				'label' => __( 'Company', 'gowilds-themer' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'Gaviasthemes'
			]
		);
		$this->add_control(
			'address',
			[
				'label' => __( 'Address', 'gowilds-themer' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'New South Wales, Australia'
			]
		);
		$this->end_controls_section();

		// Title Styling
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
					'{{WRAPPER}} .gsc-career .box-content .title, {{WRAPPER}} .gsc-career .box-content .title a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'selector' => '{{WRAPPER}} .gsc-career .box-content .title',
			]
		);
		$this->add_responsive_control(
			'title_padding',
			[
				'label' => __( 'Padding', 'gowilds-themer' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default'	=> [
					'top' 		=> 0,
					'bottom'		=> 0,
					'right' 		=> 0,
					'left'  		=> 0,
					'unit'		=> 'px'
				],
				'selectors' => [
					'{{WRAPPER}} .gsc-career .box-content .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// Job Type Styling
		$this->start_controls_section(
			'section_job_type_style',
			[
				'label' => __( 'Job Type', 'gowilds-themer' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'job_type_color',
			[
				'label' => __( 'Text Color', 'gowilds-themer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-career .box-content .job-type' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'job_type_background',
			[
				'label' => __( 'Background Color', 'gowilds-themer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-career .box-content .job-type' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'job_type_typography',
				'selector' => '{{WRAPPER}} .gsc-career .box-content .job-type',
			]
		);
		$this->add_responsive_control(
			'job_type_padding',
			[
				'label' => __( 'Padding', 'gowilds-themer' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default'	=> [
					'top' 		=> 2,
					'bottom'		=> 2,
					'right' 		=> 12,
					'left'  		=> 12,
					'unit'		=> 'px'
				],
				'selectors' => [
					'{{WRAPPER}} .gsc-career .box-content .job-type' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// Address & Company Styling
		$this->start_controls_section(
			'info_type_style',
			[
				'label' => __( 'Information (Address & Company)', 'gowilds-themer' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'info_color',
			[
				'label' => __( 'Text Color', 'gowilds-themer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-career .box-content .box-information' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'info_typography',
				'selector' => '{{WRAPPER}} .gsc-career .box-content .box-information',
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
      $widgets_manager->register(new GVAElement_Career_Block());
