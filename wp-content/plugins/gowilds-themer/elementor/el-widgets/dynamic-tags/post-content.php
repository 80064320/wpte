<?php
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

if (!defined('ABSPATH')) {
   exit; // Exit if accessed directly.
}

class GVAElement_Post_Content extends GVAElement_Base{
    const NAME = 'gva_post_content';
    const TEMPLATE = 'dynamic-tags/';
    const CATEGORY = 'gowilds_post';

    public function get_categories(){
        return array(self::CATEGORY);
    }
    
    public function get_name(){
        return self::NAME;
    }

    public function get_title(){
        return esc_html__('Post Content', 'gowilds-themer');
    }

    public function get_keywords(){
        return [ 'post', 'content'];
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
            'color',
            [
                'label' => __( 'Color', 'gowilds-themer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography',
                'selector' => '{{WRAPPER}} .post-content',
            ]
        );

        $this->end_controls_section();
    }


    protected function render(){

        parent::render();

        $settings = $this->get_settings_for_display();
        printf( '<div class="gva-element-%s gva-element">', $this->get_name() );
            include $this->get_template(self::TEMPLATE . 'post-content.php');
        print '</div>'; 
    }
}

$widgets_manager->register(new GVAElement_Post_Content());
