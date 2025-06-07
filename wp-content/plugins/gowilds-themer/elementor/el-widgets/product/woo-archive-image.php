<?php

if (!defined('ABSPATH')) {
   exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;

class GVAElement_Woo_Archive_Image extends GVAElement_Base{
    
   const NAME = 'gva_woo_archive_image';
   const TEMPLATE = 'booking/woo-archive-image';
   const CATEGORY = 'gowilds_woocommerce';

   public function get_categories() {
      return array(self::CATEGORY);
   }

   public function get_name() {
      return self::NAME;
   }

   public function get_title() {
      return __('Project Archive Image', 'gowilds-themer');
   }

   public function get_keywords() {
      return [ 'products', 'projects', 'woocommerce', 'archive', 'image', 'category'];
   }

   public function get_script_depends() {
      return array();
   }

   public function get_style_depends() {
      return array();
   }

   protected function register_controls(){
  
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
      $term_data = get_term_meta($gowilds_term_id, 'thumbnail_id', true);
      
      printf( '<div class="gva-element-%s gva-element">', $this->get_name() );
         if($term_data && !empty($term_data)){
            $image =  wp_get_attachment_image($term_data, 'full');
            echo '<div class="woo-archive-image">';
               echo $image;
            echo '</div>';
         }
      print '</div>';
   }



}
$widgets_manager->register(new GVAElement_Woo_Archive_Image());
