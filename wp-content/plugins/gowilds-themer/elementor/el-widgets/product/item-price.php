<?php
if (!defined('ABSPATH')) { exit; }

use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Repeater;

class GVAElement_Product_Item_Price extends GVAElement_Base{
    
   const NAME = 'gva-product-item-price';
   const TEMPLATE = 'product/item-price';
   const CATEGORY = 'gowilds_woocommerce';

   public function get_categories() {
      return array(self::CATEGORY);
   }

   public function get_name() {
      return self::NAME;
   }

   public function get_title() {
      return __('Product Item price', 'gowilds-themer');
   }

   public function get_keywords() {
      return [ 'product', 'item', 'product', 'price' ];
   }

   public function get_script_depends() {
      return array();
    }

    public function get_style_depends() {
      return array();
    }

   protected function register_controls() {
     
      $this->start_controls_section(
         self::NAME . '_content',
         [
            'label' => __('Content', 'gowilds-themer'),
         ]
      );

      $repeater = new Repeater();
      $repeater->add_control(
         'title',
         [
            'label'       => __('Title', 'gowilds-themer'),
            'type'        => Controls_Manager::TEXT,
            'default'     => 'Pledged',
            'label_block' => true,
         ]
      );

      $this->end_controls_section();

      //Style
      $this->start_controls_section(
         'section_box_style',
         [
            'label' => __( 'Style', 'gowilds-themer' ),
            'tab' => Controls_Manager::TAB_STYLE,
         ]
      );
      $this->add_control(
         'title_style',
         [
            'label' => __( 'Title', 'gowilds-themer' ),
            'type' => Controls_Manager::HEADING,
            'separator' => 'before',
         ]
      );
      $this->add_control(
         'title_color',
         [
            'label' => __( 'Title Color', 'gowilds-themer' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
               '{{WRAPPER}} .cf-item-info .item-info .title' => 'color: {{VALUE}};',
            ],
         ]
      );
      $this->add_group_control(
         Group_Control_Typography::get_type(),
         [
            'name' => 'typography',
            'selector' => '{{WRAPPER}} .cf-item-info .item-info .title',
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

$widgets_manager->register(new GVAElement_Product_Item_Price());
