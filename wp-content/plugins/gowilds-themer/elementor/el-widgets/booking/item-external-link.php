<?php
if (!defined('ABSPATH')) { exit; }

use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;

class GVAElement_BA_Item_External_Link extends GVAElement_Base{
    
   const NAME = 'gva_ba_item_external_link';
   const TEMPLATE = 'booking/item-external-link';
   const CATEGORY = 'gowilds_ba_booking';

   public function get_categories() {
      return array(self::CATEGORY);
   }

   public function get_name() {
      return self::NAME;
   }

   public function get_title() {
      return __('BA Item External Link', 'gowilds-themer');
   }

   public function get_keywords() {
      return [ 'booking', 'ba', 'item', 'external', 'link' ];
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
            'label'     => __( 'Title Text', 'gowilds-themer' ),
            'type'      => Controls_Manager::TEXT,
            'default'   => 'Booking Tour'
         ]
      );

      $this->add_control(
         'link_title',
         [
            'label'     => __( 'Title Button', 'gowilds-themer' ),
            'type'      => Controls_Manager::TEXT,
            'default'   => 'Book Now'
         ]
      );

      $this->add_control(
         'link_desc_color',
         [
            'label' => __( 'Text Color', 'gowilds-themer' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
               '{{WRAPPER}} .gowilds-ba-external-link .desc' => 'color: {{VALUE}};',
            ],
         ]
      );

      $this->add_group_control(
         Group_Control_Typography::get_type(),
         [
            'name' => 'title_typography',
            'selector' => '{{WRAPPER}} .gowilds-ba-external-link .desc',
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

$widgets_manager->register(new GVAElement_BA_Item_External_Link());
