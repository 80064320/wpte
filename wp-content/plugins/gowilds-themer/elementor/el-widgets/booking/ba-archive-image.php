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

class GVAElement_BA_Archive_Image extends GVAElement_Base{
    
   const NAME = 'gva_ba_archive_image';
   const TEMPLATE = 'booking/ba-archive-image';
   const CATEGORY = 'gowilds_ba_booking';

   public function get_categories() {
      return array(self::CATEGORY);
   }

   public function get_name() {
      return self::NAME;
   }

   public function get_title() {
      return __('BA Archive Image', 'gowilds-themer');
   }

   public function get_keywords() {
      return [ 'booking', 'ba', 'tour', 'book everthing', 'archive', 'image' ];
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
      $term_data = get_term_meta($gowilds_term_id, 'gowilds_location_image', true);
      
      printf( '<div class="gva-element-%s gva-element">', $this->get_name() );

         if($term_data && !empty($term_data)){
            $settings['image']['id'] =  attachment_url_to_postid($term_data);

            echo '<div class="ba-archive-image">';
               echo '<img src="' . esc_url($term_data) . '" />';
            echo '</div>';

         }

      print '</div>';
   }



}
$widgets_manager->register(new GVAElement_BA_Archive_Image());
