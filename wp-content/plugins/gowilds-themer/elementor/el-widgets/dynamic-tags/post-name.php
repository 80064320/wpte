<?php
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
if (!defined('ABSPATH')) {
	exit; 
}

class GVAElement_Post_Name extends GVAElement_Base{
	const NAME = 'gva_post_name';
	const TEMPLATE = 'dynamic-tags/';
	const CATEGORY = 'gowilds_post';
	
	public function get_categories(){
		return array(self::CATEGORY);
	}
	 
	public function get_name(){
		return self::NAME;
	}

	public function get_title(){
		return esc_html__('Post Title', 'gowilds-themer');
	}

	public function get_keywords() {
		return [ 'post', 'name', 'title'];
	}

	protected function register_controls(){
		$this->start_controls_section(
			self::NAME,
			[
				'label' => esc_html__('General', 'gowilds-themer'),
				'tab' => Controls_Manager::TAB_CONTENT
			]
		);

		$this->add_control(
			'html_tag',
			[
				'label' => esc_html__('Tag', 'gowilds-themer'),
				'type' => Controls_Manager::SELECT,
				'options' => [
				  	'div' => esc_html__('DIV', 'gowilds-themer'),
				  	'h1' => esc_html__('H1', 'gowilds-themer'),
				  	'h2' => esc_html__('H2', 'gowilds-themer'),
				  	'h3' => esc_html__('H3', 'gowilds-themer'),
				  	'h4' => esc_html__('H4', 'gowilds-themer'),
				  	'h5' => esc_html__('H5', 'gowilds-themer'),
				],
				'default' => 'h1',
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => __( 'Text Color', 'gowilds-themer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .post-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_text',
				'selector' => '{{WRAPPER}} .post-title',
			]
		);

		$this->end_controls_section();
	 }

	 protected function render(){

		  parent::render();

		  $settings = $this->get_settings_for_display();
		  printf( '<div class="gva-element-%s gva-element">', $this->get_name() );
				include $this->get_template(self::TEMPLATE . 'post-name.php');
		  print '</div>';
	 }
}

$widgets_manager->register(new GVAElement_Post_Name());
