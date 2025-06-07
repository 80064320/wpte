<?php
if (!defined('ABSPATH')) { exit; }

use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Repeater;

class GVAElement_Product_Item_Category extends GVAElement_Base{
    
   const NAME = 'gva-product-item-meta';
   const TEMPLATE = 'product/item-meta';
   const CATEGORY = 'gowilds_woocommerce';

   public function get_categories() {
      return array(self::CATEGORY);
   }

   public function get_name() {
      return self::NAME;
   }

   public function get_title() {
      return __('CF Item Meta', 'gowilds-themer');
   }

   public function get_keywords() {
      return [ 'product', 'item', 'meta', 'category' ];
   }

   public function get_script_depends() {
      return array();
    }

    public function get_style_depends() {
      return array();
    }

   protected function register_controls() {
     
      $this->start_controls_section(
         self::NAME . '_content',
         [
            'label' => __('Content', 'gowilds-themer'),
         ]
      );

      $this->add_control(
         'label_style',
         [
            'label' => __( 'Label Style', 'gowilds-themer' ),
            'type' => Controls_Manager::HEADING,
         ]
      );

      $this->add_control(
         'label_color',
         [
            'label' => __( 'Label Color', 'gowilds-themer' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
               '{{WRAPPER}} .cf-item-category .campaign-categories' => 'background-color: {{VALUE}};',
            ]
         ]
      );

     $this->add_group_control(
         Group_Control_Typography::get_type(),
         [
            'name' => 'label_typography',
            'selector' => '{{WRAPPER}} .cf-item-category .campaign-categories a'
         ]
     );

     $this->add_control(
         'content_style',
         [
            'label' => __( 'Content Style', 'gowilds-themer' ),
            'type' => Controls_Manager::HEADING,
         ]
      );

      $this->add_control(
         'content_color',
         [
            'label' => __( 'Content Color', 'gowilds-themer' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
               '{{WRAPPER}} .cf-item-category .campaign-categories' => 'background-color: {{VALUE}};',
            ]
         ]
      );

     $this->add_group_control(
         Group_Control_Typography::get_type(),
         [
            'name' => 'content_typography',
            'selector' => '{{WRAPPER}} .cf-item-category .campaign-categories a'
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

$widgets_manager->register(new GVAElement_Product_Item_Category());
