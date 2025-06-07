<?php
if (!defined('ABSPATH')) { exit; }

use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

class GVAElement_BA_Item_Gallery extends GVAElement_Base{
    
   const NAME = 'gva_ba_item_gallery';
   const TEMPLATE = 'booking/item-gallery';
   const CATEGORY = 'gowilds_ba_booking';

   public function get_categories() {
      return array(self::CATEGORY);
   }

   public function get_name() {
      return self::NAME;
   }

   public function get_title() {
      return __('BA Item Gallery & Image', 'gowilds-themer');
   }

   public function get_keywords() {
      return [ 'booking', 'ba', 'item', 'book everthing', 'gallery' ];
   }

   public function get_script_depends() {
      return [
         'swiper',
         'gavias.elements'
      ];
    }

    public function get_style_depends() {
        return array('swiper');
    }

   protected function register_controls() {
     
      $this->start_controls_section(
         self::NAME . '_content',
         [
            'label' => __('Content', 'gowilds-themer'),
         ]
      );

      $this->add_control(
         'style',
         [
            'label' => __( 'Style', 'gowilds-themer' ),
            'type' => Controls_Manager::SELECT,
            'options' => [
               'style-1'      => __( 'Style I: Gallery I', 'gowilds-themer' ),
               'style-2'      => __( 'Style I: Gallery II', 'gowilds-themer' ),
               'style-3'      => __( 'Style III: Background Image Featured', 'gowilds-themer' ),
            ],
            'default' => 'style-1',
         ]
      );

      $this->add_responsive_control(
         'background_height',
         [
            'label' => __( 'style', 'gowilds-themer' ),
            'type' => Controls_Manager::SLIDER,
            'default' => [
              'size' => 600,
            ],
            'range' => [
              'px' => [
                'min' => 100,
                'max' => 1000,
              ],
            ],
            'selectors' => [
              '{{WRAPPER}} .gowilds-ba-single-gallery .background-image' => 'min-height: {{SIZE}}{{UNIT}};background-size: cover;background-position:center center;',
            ],
            'condition' => [
               'style' => array('style-3')
            ]
         ]
      );


      $this->add_group_control(
         Elementor\Group_Control_Image_Size::get_type(),
         [
            'name'      => 'image', 
            'default'   => 'gowilds_medium',
            'separator' => 'none',
         ]
      );

      $this->add_control(
         'show_media',
         [
            'label' => __( 'Show Media', 'gowilds-themer' ),
            'type' => Controls_Manager::SWITCHER,
            'default' => 'yes'
         ]
      );

      $this->end_controls_section();

      $this->add_control_carousel( false, array('style' => ['style-1', 'style-2']) );


   }

   protected function render(){
      parent::render();

      $settings = $this->get_settings_for_display();
      printf( '<div class="gowilds-%s gowilds-element">', $this->get_name() );
         include $this->get_template(self::TEMPLATE . '.php');
      print '</div>';
   }
}

$widgets_manager->register(new GVAElement_BA_Item_Gallery());
