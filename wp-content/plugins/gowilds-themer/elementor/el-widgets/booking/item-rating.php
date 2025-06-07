<?php
if (!defined('ABSPATH')) { exit; }

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

class GVAElement_BA_Item_Rating extends GVAElement_Base{
    
   const NAME = 'gva_ba_item_rating';
   const TEMPLATE = 'booking/item-rating';
   const CATEGORY = 'gowilds_ba_booking';

   public function get_categories() {
      return array(self::CATEGORY);
   }

   public function get_name() {
      return self::NAME;
   }

   public function get_title() {
      return __('BA Item Rating', 'gowilds-themer');
   } 
 
   public function get_keywords() {
      return [ 'booking', 'ba', 'item', 'book everthing', 'rating' ];
   }

   protected function register_controls() {
      //--
      $this->start_controls_section(
         self::NAME . '_content',
         [
            'label' => esc_html__('Content', 'gowilds-themer'),
         ]
      );

      $this->add_responsive_control(
         'star_size',
         [
            'label' => __( 'Star Size', 'gowilds-themer' ),
            'type' => Controls_Manager::SLIDER,
            'default' => [
              'size' => 14
            ],
            'range' => [
              'px' => [
                'min' => 10,
                'max' => 80,
              ],
            ],
            'selectors' => [
              '{{WRAPPER}} .gowilds-single-rating .stars .star' => 'font-size: {{SIZE}}{{UNIT}};',
            ],
         ]
      );

      $this->add_control(
         'star_color',
         [
            'label' => esc_html__( 'Star Color', 'gowilds-themer' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
               '{{WRAPPER}} .gowilds-single-rating .stars .star' => 'color: {{VALUE}};',
            ],
         ]
      );

       $this->add_responsive_control(
         'star_space',
         [
            'label' => __( 'Star Size', 'gowilds-themer' ),
            'type' => Controls_Manager::SLIDER,
            'default' => [
              'size' => 5
            ],
            'range' => [
              'px' => [
                'min' => 0,
                'max' => 20
              ],
            ],
            'selectors' => [
              '{{WRAPPER}} .gowilds-single-rating .stars .star' => 'letter-spacing: {{SIZE}}{{UNIT}};'
            ],
         ]
      );

      $this->add_responsive_control(
         'text_size',
         [
            'label' => __( 'Text Size', 'gowilds-themer' ),
            'type' => Controls_Manager::SLIDER,
            'default' => [
              'size' => 14
            ],
            'range' => [
              'px' => [
                'min' => 10,
                'max' => 80,
              ],
            ],
            'selectors' => [
              '{{WRAPPER}} .gowilds-single-rating .stars .post-total-rating-value' => 'font-size: {{SIZE}}{{UNIT}};',
            ],
         ]
      );

      $this->add_responsive_control(
         'text_color',
         [
            'label' => __( 'Text Color', 'gowilds-themer' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
              '{{WRAPPER}} .gowilds-single-rating .stars .post-total-rating-value' => 'color: {{VALUE}};',
            ],
         ]
      );

      $this->add_group_control(
         Group_Control_Typography::get_type(),
         [
            'name' => 'text_typography',
            'selector' => '{{WRAPPER}} .gowilds-single-rating .stars .post-total-rating-value',
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

$widgets_manager->register(new GVAElement_BA_Item_Rating());
