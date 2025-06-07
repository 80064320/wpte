<?php
if (!defined('ABSPATH')) { exit; }

use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;

class GVAElement_BA_Item_Address_Map extends GVAElement_Base{
    
   const NAME = 'gva_ba_item_address_map';
   const TEMPLATE = 'booking/item-address-map';
   const CATEGORY = 'gowilds_ba_booking';

   public function get_categories() {
      return array(self::CATEGORY);
   }

   public function get_name() {
      return self::NAME;
   }

   public function get_title() {
      return __('BA Item Address Map', 'gowilds-themer');
   }

   public function get_keywords() {
      return [ 'booking', 'ba', 'item', 'book everthing', 'address', 'map' ];
   }


   protected function register_controls() {
      //--
      $this->start_controls_section(
         self::NAME . '_content',
         [
            'label' => __('Content', 'gowilds-themer'),
         ]
      );

      $this->add_control(
         'title_text',
         [
            'label' => __( 'Title Text', 'gowilds-themer' ),
            'type' => Controls_Manager::TEXT
         ]
      );

      $this->add_control(
         'title_color',
         [
            'label' => __( 'Text Color', 'gowilds-themer' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
               '{{WRAPPER}} .gowilds-single-address-map .title' => 'color: {{VALUE}};',
            ],
         ]
      );

      $this->add_group_control(
         Group_Control_Typography::get_type(),
         [
            'name' => 'title_typography',
            'selector' => '{{WRAPPER}} .gowilds-single-address .title',
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

$widgets_manager->register(new GVAElement_BA_Item_Address_Map());
