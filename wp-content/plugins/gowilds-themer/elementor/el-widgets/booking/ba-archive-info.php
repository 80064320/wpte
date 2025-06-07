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

class GVAElement_BA_Archive_Info extends GVAElement_Base{
    
   const NAME = 'gva_ba_archive_info';
   const TEMPLATE = 'booking/ba-archive';
   const CATEGORY = 'gowilds_ba_booking';

   public function get_categories() {
      return array(self::CATEGORY);
   }

   public function get_name() {
      return self::NAME;
   }

   public function get_title() {
      return __('BA Archive Info', 'gowilds-themer');
   }

   public function get_keywords() {
      return [ 'booking', 'ba', 'tour', 'book everthing', 'archive', 'info' ];
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
      $term_data_info = get_term_meta($gowilds_term_id, 'taxonomy_info', true);

      printf( '<div class="gva-element-%s gva-element">', $this->get_name() );

         echo '<div class="ba-archive-info">';
            echo '<h1 class="term-name">' . esc_html($term->name) . '</h1>';
            if( isset($term->description) && $term->description ){
               echo '<div class="term-desc">' . apply_filters('the_content', $term->description) . '</div>';
            }
            if($term_data_info){
               echo '<div class="term-info">';
                  foreach ($term_data_info as $data) {
                    echo '<div class="info-item">';
                        echo '<div class="item-label">' . esc_html($data['gowilds_title']) . '</div>';
                        echo '<div class="item-content">' . trim($data['gowilds_description']) . '</div>';
                    echo '</div>';
                  }
               echo '</div>';
            }
         echo '</div>';

      echo '</div>';
   }

}
$widgets_manager->register(new GVAElement_BA_Archive_Info());
