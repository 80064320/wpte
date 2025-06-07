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

class GVAElement_BA_Booking_Archive extends GVAElement_Base{
    
   const NAME = 'gva_ba_archive';
   const TEMPLATE = 'booking/ba-archive';
   const CATEGORY = 'gowilds_ba_booking';

   public function get_categories() {
      return array(self::CATEGORY);
   }

   public function get_name() {
      return self::NAME;
   }

   public function get_title() {
      return __('BA Booking Archive', 'gowilds-themer');
   }

   public function get_keywords() {
      return [ 'booking', 'ba', 'tour', 'book everthing', 'archive' ];
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
      $this->add_control(
         'layout',
         array(
            'label'   => esc_html__( 'Layout', 'gowilds-themer' ),
            'type'    => Controls_Manager::SELECT,
            'default' => 'grid',
            'options' => [
               'grid'         => esc_html__('Grid', 'gowilds-themer'),
               'list'         => esc_html__('List', 'gowilds-themer')
            ]
         )
      );
      $this->end_controls_section();

      $this->add_control_grid(array('layout' => 'grid'));

   }
  
   protected function render(){
      $settings = $this->get_settings_for_display();

      parent::render();

      global $gowilds_term_id;

      printf( '<div class="gva-element-%s gva-element">', $this->get_name() );

         if(\Elementor\Plugin::instance()->editor->is_edit_mode()){
            global $wp_query;
            $wp_query = new WP_Query(array(
               'post_type' => BABE_Post_types::$booking_obj_post_type,
               'tax_query' => array(
                  'relation' => 'OR',
                  array(
                     'taxonomy' => 'ba_location',
                     'field'    => 'term_id',
                     'terms'    => $gowilds_term_id,
                  ),
                  array(
                     'taxonomy' => 'ba_type',
                     'field'    => 'term_id',
                     'terms'    => $gowilds_term_id,
                  ),
               ),
            ));
            include $this->get_template(self::TEMPLATE . '.php');
         }else{
            $object = get_queried_object();
            if(!empty($object)) {
               include $this->get_template(self::TEMPLATE . '.php');
            }
         }

      print '</div>';
   }

}
$widgets_manager->register(new GVAElement_BA_Booking_Archive()); 
