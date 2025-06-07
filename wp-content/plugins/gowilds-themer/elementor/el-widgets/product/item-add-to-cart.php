<?php
if (!defined('ABSPATH')) { exit; }

use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

class GVAElement_Product_Add_To_Cart extends GVAElement_Base{
    
   const NAME = 'gva-product-item-add-to-cart';
   const TEMPLATE = 'product/item-add-to-cart';
   const CATEGORY = 'gowilds_woocommerce';

   public function get_categories() {
      return array(self::CATEGORY);
   }

   public function get_name() {
      return self::NAME;
   }

   public function get_title() {
      return __('Product Item Add To Cart', 'gowilds-themer');
   }

   public function get_keywords() {
      return [ 'product', 'item', 'add to cart', 'cart' ];
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
         'heading',
         [
            'label'       => __('No Settings', 'gowilds-themer'),
            'type'        => Controls_Manager::HEADING
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

$widgets_manager->register(new GVAElement_Product_Add_To_Cart());
