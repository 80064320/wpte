<?php
if (!defined('ABSPATH')) { exit; }

use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

class GVAElement_Product_Item_Media extends GVAElement_Base{
    
   const NAME = 'gva-product-item-media';
   const TEMPLATE = 'product/item-media';
   const CATEGORY = 'gowilds_woocommerce';

   public function get_categories() {
      return array(self::CATEGORY);
   }

   public function get_name() {
      return self::NAME;
   }

   public function get_title() {
      return __('Product Item Media', 'gowilds-themer');
   }

   public function get_keywords() {
      return [ 'product', 'item', 'media', 'gallery', 'image' ];
   }

   public function get_script_depends() {
      return [
       'wc-single-product'
      ];
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

$widgets_manager->register(new GVAElement_Product_Item_Media());
