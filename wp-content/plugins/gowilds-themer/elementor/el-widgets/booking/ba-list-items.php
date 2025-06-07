<?php
if (!defined('ABSPATH')) { exit; }

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

class GVAElement_BA_List_Items extends GVAElement_Base{
    
   const NAME = 'gva_ba_list_items';
   const TEMPLATE = 'booking/list-items';
   const CATEGORY = 'gowilds_ba_booking';

   public function get_categories() {
      return array(self::CATEGORY);
   }

   public function get_name() {
      return self::NAME;
   }

   public function get_title() {
      return __('BA List Items', 'gowilds-themer');
   }

   public function get_keywords() {
      return [ 'booking', 'ba', 'items', 'book everthing', 'list' ];
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
            'type'         => Controls_Manager::TEXTAREA,
            'placeholder'  => esc_html__( 'Enter your title', 'gowilds-themer' ),
            'default'      => esc_html__( 'Last Minute Deals', 'gowilds-themer' ),
            'label_block'  => true
         ]
      );

      $this->add_control(
         'posts_per_page',
         [
            'label'   => esc_html__('Posts Per Page', 'gowilds-themer'),
            'type'    => Controls_Manager::NUMBER,
            'default' => 6,
         ]
      );

      $this->add_control(
         'orderby',
         [
            'label'   => esc_html__('Order By', 'gowilds-themer'),
            'type'    => Controls_Manager::SELECT,
            'default' => 'post_date',
            'options' => [
               'post_date'  => esc_html__('Date', 'gowilds-themer'),
               'post_title' => esc_html__('Title', 'gowilds-themer'),
               'rand'       => esc_html__('Random', 'gowilds-themer')
            ],
         ]
      );

      $this->add_control(
         'order',
         [
            'label'   => esc_html__('Order', 'gowilds-themer'),
            'type'    => Controls_Manager::SELECT,
            'default' => 'desc',
            'options' => [
               'asc'  => esc_html__('ASC', 'gowilds-themer'),
               'desc' => esc_html__('DESC', 'gowilds-themer'),
            ],
         ]
      );

      $this->add_control(
         'ids_not_in',
         [
            'label'        => esc_html__('IDs Content Not In', 'gowilds-themer'),
            'type'         => Controls_Manager::TEXT,
            'placeholder'  => esc_html__( 'e.g: 1,2,3,4,5', 'gowilds-themer' ),
            'default' => '',
         ]
      );

      $this->add_responsive_control(
         'column',
         [
            'label'   => esc_html__('Columns', 'gowilds-themer'),
            'type'    => \Elementor\Controls_Manager::SELECT,
            'default' => 3,
            'options' => [1 => 1, 2 => 2, 3 => 3, 4 => 4, 6 => 6],
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
               '{{WRAPPER}} .gowilds-ba-list-items .ba-meta-title' => 'color: {{VALUE}};',
            ],
         ]
      );

      $this->add_group_control(
         Group_Control_Typography::get_type(),
         [
            'name' => 'title_typography',
            'selector' => '{{WRAPPER}} .gowilds-ba-list-items .ba-meta-title',
         ]
      );

      $this->end_controls_section();

   }

   public function query_posts($settings){
      $ids_not_in = $settings['ids_not_in'];
      $ids_not_in_array = !empty($ids_not_in) ? explode(',', $ids_not_in) : array();
      $ids_not_in_array[] = get_the_ID();
      $query_args = [
         'post_type'           => 'to_book',
         'orderby'             => $settings['orderby'],
         'order'               => $settings['order'],
         'ignore_sticky_posts' => 1,
         'post_status'         => 'publish', 
         'post__not_in'        => $ids_not_in_array,
         'numberposts'         => $settings['posts_per_page'],
         'posts_per_page'      => $settings['posts_per_page'], 
         'paged'               => 1
      ];

      return get_posts($query_args);
   }

   protected function render(){
      parent::render();

      $settings = $this->get_settings_for_display();
      $posts = $this->query_posts($settings);
      if (!$posts){
         return;
      }
      printf( '<div class="gowilds-%s gowilds-element">', $this->get_name());
         include $this->get_template(self::TEMPLATE . '.php');
      print '</div>';
   }
}

$widgets_manager->register(new GVAElement_BA_List_Items());
