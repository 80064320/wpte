<?php

if (!defined('ABSPATH')) {
   exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Image_Size;

class GVAElement_Woo_Archive_Info extends GVAElement_Base{
    
   const NAME = 'gva_woo_archive_info';
   const TEMPLATE = 'product/woo-archive-info';
   const CATEGORY = 'gowilds_woocommerce';

   public function get_categories() {
      return array(self::CATEGORY);
   }

   public function get_name() {
      return self::NAME;
   }

   public function get_title() {
      return __('Project Archive Info', 'gowilds-themer');
   }

   public function get_keywords() {
      return [ 'products', 'projects', 'woocommerce', 'archive', 'info', 'category'];
   }

   public function get_script_depends() {
      return array();
   }

   public function get_style_depends() {
      return array();
   }

   protected function register_controls(){
  
      //--
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
      
      global $gowilds_term_id;

      $term = get_term($gowilds_term_id);

      printf( '<div class="gva-element-%s gva-element">', $this->get_name() );

         echo '<div class="woo-archive-info">';
            echo '<h1 class="term-name">' . esc_html($term->name) . '</h1>';
            if( isset($term->description) && $term->description ){
               echo '<div class="term-desc">' . $term->description . '</div>';
            }
         echo '</div>';

      echo '</div>';
   }

}
$widgets_manager->register(new GVAElement_Woo_Archive_Info());
