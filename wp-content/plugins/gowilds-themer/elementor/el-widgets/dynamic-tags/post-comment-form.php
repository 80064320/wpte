<?php
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class GVAElement_Post_Comment extends GVAElement_Base{
     const NAME = 'gva_post_comment';
     const TEMPLATE = 'dynamic-tags/post-comment';
     const CATEGORY = 'gowilds_post';

     public function get_categories(){
          return array(self::CATEGORY);
     }
     
     public function get_name(){
          return self::NAME;
     }

     public function get_title(){
          return esc_html__('Post Comment', 'gowilds-themer');
     }

     public function get_keywords() {
          return [ 'post', 'comment', 'form'];
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
            'heading_style_title',
            [
                'label' => esc_html__( 'No Settings', 'gowilds-themer' ),
                'type' => Controls_Manager::HEADING
            ]
        );

        $this->end_controls_section();
     }


     protected function render(){
          parent::render();

          $settings = $this->get_settings_for_display();
          printf( '<div class="gva-element-%s gva-element">', $this->get_name() );
                include $this->get_template(self::TEMPLATE . '.php');
          print '</div>';
     }
}

$widgets_manager->register(new GVAElement_Post_Comment());
