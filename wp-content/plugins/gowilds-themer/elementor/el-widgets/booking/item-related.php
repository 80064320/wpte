<?php
if (!defined('ABSPATH')) { exit; }

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

class GVAElement_BA_Item_Related extends GVAElement_Base{
    
   const NAME = 'gva_ba_item_related';
   const TEMPLATE = 'booking/item-related';
   const CATEGORY = 'gowilds_ba_booking';

   public function get_categories() {
      return array(self::CATEGORY);
   }

   public function get_name() {
      return self::NAME;
   }

   public function get_title() {
      return __('BA Item Related', 'gowilds-themer');
   }

   public function get_keywords() {
      return [ 'booking', 'ba', 'item', 'book everthing', 'related' ];
   }

   public function get_script_depends() {
      return [
         'swiper',
         'gavias.elements',
      ];
   }

   public function get_style_depends() {
      return array('swiper');
   }


   protected function register_controls() {
      //--
      $this->start_controls_section(
         self::NAME . '_content',
         [
            'label' => esc_html__('Content Settings', 'gowilds-themer'),
         ]
      );

      $this->add_control(
         'layout_heading',
         array(
            'label'   => esc_html__( 'Layout Settings', 'gowilds-themer' ),
            'type'    => 'heading',
         )
      );

      $this->add_control(
         'style',
         [
            'label'     => __('Style', 'gowilds-themer'),
            'type'      => \Elementor\Controls_Manager::SELECT,
            'default' => 'style-1',
            'options' => [
               'style-1'      => __( 'Item Block Style I', 'gowilds-themer' ),
               'style-2'      => __( 'Item Block Style II', 'gowilds-themer' ),
            ],
         ]
      );

      $this->add_group_control(
         Elementor\Group_Control_Image_Size::get_type(),
         [
            'name'      => 'image', 
            'default'   => 'full',
            'separator' => 'none',
         ]
      );

      $this->end_controls_section();

      $this->add_control_carousel(false, array());

   }

   protected function render(){
      parent::render();

      $settings = $this->get_settings_for_display();
      printf( '<div class="gowilds-%s gowilds-element">', $this->get_name() );
         include $this->get_template(self::TEMPLATE . '.php');
      print '</div>';
   }
}

$widgets_manager->register(new GVAElement_BA_Item_Related());
