<?php
if (!defined('ABSPATH')) { exit; }

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

class GVAElement_BA_Item_Min_Guests extends GVAElement_Base{
    
   const NAME = 'gva_ba_item_min_guests';
   const TEMPLATE = 'booking/item-min-guests';
   const CATEGORY = 'gowilds_ba_booking';

   public function get_categories() {
      return array(self::CATEGORY);
   }

   public function get_name() {
      return self::NAME;
   }

   public function get_title() {
      return __('BA Item Min Guests', 'gowilds-themer');
   }

   public function get_keywords() {
      return [ 'booking', 'ba', 'item', 'book everthing', 'min', 'guests' ];
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
         'title_text',
         [
            'label'        => esc_html__( 'Title', 'gowilds-themer' ),
            'type'         => Controls_Manager::TEXT,
            'placeholder'  => esc_html__( 'Enter your title', 'gowilds-themer' ),
            'default'      => esc_html__( 'Min Guests', 'gowilds-themer' ),
            'label_block'  => true
         ]
      );

      $this->add_control(
         'selected_icon',
         [
            'label'      => esc_html__('Choose Icon', 'gowilds-themer'),
            'type'       => Controls_Manager::ICONS,
            'default' => [
              'value' => 'las la-user-friends'
            ]
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
               '{{WRAPPER}} .gowilds-single-max_guests .ba-meta-title' => 'color: {{VALUE}};',
            ],
         ]
      );

      $this->add_group_control(
         Group_Control_Typography::get_type(),
         [
            'name' => 'title_typography',
            'selector' => '{{WRAPPER}} .gowilds-single-max_guests .ba-meta-title',
         ]
      );

      $this->add_control(
         'heading_style_value',
         [
            'label' => esc_html__( 'Style Value Text', 'gowilds-themer' ),
            'type' => Controls_Manager::HEADING
         ]
      );
      $this->add_control(
         'value_color',
         [
            'label' => esc_html__( 'Text Color', 'gowilds-themer' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
               '{{WRAPPER}} .gowilds-single-max_guests .item-value' => 'color: {{VALUE}};',
            ],
         ]
      );

      $this->add_group_control(
         Group_Control_Typography::get_type(),
         [
            'name' => 'value_typography',
            'selector' => '{{WRAPPER}} .gowilds-single-max_guests .item-value',
         ]
      );

      // --- Style Icon ---
      $this->add_control(
         'heading_style_icon',
         [
            'label' => esc_html__( 'Style Icon', 'gowilds-themer' ),
            'type' => Controls_Manager::HEADING
         ]
      );
      $this->add_control(
         'icon_color',
         [
            'label' => esc_html__( 'Icon Color', 'gowilds-themer' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
               '{{WRAPPER}} .gowilds-single-max_guests .icon i' => 'color: {{VALUE}};',
               '{{WRAPPER}} .gowilds-single-max_guests .icon svg' => 'fill: {{VALUE}};',
            ],
         ]
      );
      $this->add_responsive_control(
         'icon_size',
         [
            'label' => __( 'Size', 'gowilds-themer' ),
            'type' => Controls_Manager::SLIDER,
            'default' => [
              'size' => 32
            ],
            'range' => [
              'px' => [
                'min' => 20,
                'min' => 80,
              ],
            ],
            'selectors' => [
              '{{WRAPPER}} .gowilds-single-max_guests .icon i' => 'font-size: {{SIZE}}{{UNIT}};',
              '{{WRAPPER}} .gowilds-single-max_guests .icon svg' => 'width: {{SIZE}}{{UNIT}};'
            ],
         ]
      );

      $this->add_responsive_control(
         'icon_space',
         [
            'label' => __( 'Spacing', 'gowilds-themer' ),
            'type' => Controls_Manager::SLIDER,
            'default' => [
              'size' => 12,
            ],
            'range' => [
              'px' => [
                'min' => 0,
                'min' => 50,
              ],
            ],
            'selectors' => [
              '{{WRAPPER}} .gowilds-single-max_guests .icon' => 'padding-right: {{SIZE}}{{UNIT}};',
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

$widgets_manager->register(new GVAElement_BA_Item_Min_Guests());
