<?php
if (!defined('ABSPATH')) { exit; }

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

class GVAElement_BA_Item_Booking_Form extends GVAElement_Base{
    
   const NAME = 'gva_ba_item_booking_form';
   const TEMPLATE = 'booking/item-booking-form';
   const CATEGORY = 'gowilds_ba_booking';

   public function get_categories() {
      return array(self::CATEGORY);
   }

   public function get_name() {
      return self::NAME;
   }

   public function get_title() {
      return __('BA Item Booking Form', 'gowilds-themer');
   }

   public function get_keywords() {
      return [ 'booking', 'ba', 'item', 'book everthing', 'booking', 'form' ];
   }

   protected function register_controls() {
      //--
      $this->start_controls_section(
         self::NAME . '_content',
         [
            'label' => esc_html__('Content', 'gowilds-themer'),
         ]
      );
      $this->add_control(
         'style',
         array(
            'label'       => esc_html__('Style', 'gowilds-themer'),
            'type'        => \Elementor\Controls_Manager::SELECT,
            'options'     => array(
               'style-1'   => esc_html__('Style I','gowilds-themer'),
               'style-2'   => esc_html__('Style II','gowilds-themer')
            ),
            'default'     => 'style-1'
         )
      );
      $this->add_control(
         'title_text',
         [
            'label'        => esc_html__( 'Title', 'gowilds-themer' ),
            'type'         => Controls_Manager::TEXT,
            'placeholder'  => esc_html__( 'Enter your title', 'gowilds-themer' ),
            'default'      => esc_html__( 'Booking Tour', 'gowilds-themer' ),
            'label_block'  => true
         ]
      );

      $this->add_control(
         'heading_style_title',
         [
            'label' => esc_html__( 'Style Title Text', 'gowilds-themer' ),
            'type' => Controls_Manager::HEADING
         ]
      );
      $this->add_control(
         'title_color',
         [
            'label' => esc_html__( 'Text Color', 'gowilds-themer' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
               '{{WRAPPER}} .gowilds-single-duration .ba-meta-title' => 'color: {{VALUE}};',
            ],
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

$widgets_manager->register(new GVAElement_BA_Item_Booking_Form());
