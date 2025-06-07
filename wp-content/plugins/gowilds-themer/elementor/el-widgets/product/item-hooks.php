<?php
if (!defined('ABSPATH')) { exit; }

use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

class GVAElement_Product_Item_Hook extends GVAElement_Base{
    
   const NAME = 'gva-product-item-hooks';
   const TEMPLATE = 'product/item-hooks';
   const CATEGORY = 'gowilds_woocommerce';

   public function get_categories() {
      return array(self::CATEGORY);
   }

   public function get_name() {
      return self::NAME;
   }

   public function get_title() {
      return esc_html__('Product Item Hooks', 'gowilds-themer');
   }

   public function get_keywords() {
      return [ 'product', 'item', 'hook', 'notices' ];
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
            'label' => esc_html__('Content', 'gowilds-themer'),
         ]
      );
      $this->add_control(
         'hook_name',
         [
            'label' => esc_html__( 'Hook Name', 'gowilds-themer' ),
            'type' => Controls_Manager::SELECT,
            'options' => [
               '' => esc_html__('Select Hook Name', 'gowilds'),
               'woocommerce_before_main_content' => 'woocommerce_before_main_content',
               'woocommerce_after_main_content' => 'woocommerce_after_main_content',
               'woocommerce_single_product_summary' => 'woocommerce_single_product_summary',
               'woocommerce_after_single_product_summary' => 'woocommerce_after_single_product_summary',
               'woocommerce_before_single_product' => 'woocommerce_before_single_product',
               'woocommerce_after_single_product' => 'woocommerce_after_single_product',
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

$widgets_manager->register(new GVAElement_Product_Item_Hook());
