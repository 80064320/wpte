<?php
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Core\Base\Document;
class GVA_Elementor_Override{

   public function __construct() {
      $this->add_actions();
      $this->elementor_init_setup();
      add_action( 'elementor/editor/after_save', array($this, 'clear_cache_updating_elementor') );
   }

   public function clear_cache_updating_elementor() {
      \Elementor\Plugin::$instance->files_manager->clear_cache();
   }

   function elementor_init_setup(){
      if(empty(get_option('elementor_allow_svg', ''))) update_option( 'elementor_allow_svg', 1 );
      if(empty(get_option('elementor_load_fa4_shim', ''))) update_option( 'elementor_load_fa4_shim', 'yes' );
      if(empty(get_option('elementor_disable_color_schemes', ''))) update_option( 'elementor_disable_color_schemes', 'yes' );
      if(empty(get_option('elementor_disable_typography_schemes', ''))) update_option( 'elementor_disable_typography_schemes', 'yes' );
      if(empty(get_option('elementor_container_width', ''))) update_option( 'elementor_container_width', '1200' );
      $cpt_support = get_option('elementor_cpt_support');
      if(empty($cpt_support)){
         $cpt_support[] = 'page';
         $cpt_support[] = 'gva__template';
         $cpt_support[] = 'portfolio';
         update_option('elementor_cpt_support', $cpt_support);
      }else{
         if(!in_array('gva__template', $cpt_support) || !in_array('portfolio', $cpt_support)){
            $cpt_support[] = 'gva__template';
            $cpt_support[] = 'portfolio';
            update_option('elementor_cpt_support', $cpt_support);
         }
      }
   }

   public function add_actions() {
      //add_action( 'elementor/element/column/layout/after_section_end', [ $this, 'column_control' ], 10, 2 );
      //add_action( 'elementor/element/section/section_structure/after_section_end', [ $this, 'row_style' ], 10, 2 );
      add_action( 'elementor/element/section/section_layout/after_section_end', [ $this, 'after_row_end' ], 10, 2 );
   }

   private function get_current_post(Document $document){
      $post = $document->get_post();
      if(($postId = wp_is_post_revision($post)) !== false){
         $post = get_post($postId);
      }
      if(!$post instanceof WP_Post){
         return false;
      }
      return $post;
   }

   public function column_control($obj, $args){

      $obj->start_controls_section(
         'gva_column_control',
         array(
            'label' => esc_html__( 'Other Settings', 'gowilds-themer' ),
            'tab'   => Controls_Manager::TAB_LAYOUT,
         )
      );

      $obj->add_responsive_control(
         'gva_column_inner_width',
         [
            'label'     => __('Inner Width', 'gowilds-themer'),
            'type'      => Controls_Manager::NUMBER,
            'selectors' => [
               '{{WRAPPER}} > .elementor-column-wrap > .elementor-widget-wrap' => 'width: {{SIZE}}px;max-width: 100%;'
            ]
         ]
      );

      $obj->end_controls_section();  
   }



   public function after_row_end( $obj, $args ) {
      $obj->start_controls_section(
         'gva_section_row',
         array(
            'label' => esc_html__( 'Gavias Extra Settings Row for Header Builder', 'gowilds-themer' ),
            'tab'   => Controls_Manager::TAB_LAYOUT,
         )
      );

      // Header Sticky
      $obj->add_control(
         'row_header_sticky',
         [
            'label'  => esc_html__( 'Sticky Row Settings (Use only for row in header)', 'gowilds-themer' ),
            'type'      => Controls_Manager::HEADING
         ]
      );

      $obj->add_control(
         '_gva_sticky_menu',
         [
            'label'     => __( 'Sticky Menu Row', 'gowilds-themer' ),
            'type'      => Controls_Manager::SELECT,
            'options'   => [
               '' => __( '-- None --', 'gowilds-themer' ),
               'gv-sticky-menu' => __( 'Sticky Menu', 'gowilds-themer' ),
            ],
            'default'         => '',
            'prefix_class'    => '',
            'description'     => __('You can only enable sticky menu for one row, please make sure display all sticky menu for other rows')
         ]
      );

      $obj->add_control(
         '_gva_sticky_background',
         [
            'label'     => __('Sticky Background Color', 'gowilds-themer'),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [ 
               '.gv-sticky-wrapper.is-fixed > .elementor-section' => 'background: {{VALUE}}!important;', 
            ],
            'condition' => [
               '_gva_sticky_menu!' => ''
            ]
         ]
      );
      $obj->add_control(
         '_gva_sticky_menu_text_color',
         [
            'label'     => __('Sticky Text Color', 'gowilds-themer'),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
               '.gv-sticky-wrapper.is-fixed > .elementor-section' => 'color: {{VALUE}}', 
            ],
            'condition' => [
               '_gva_sticky_menu!' => ''
            ]
         ]
      );
      $obj->add_control(
         '_gva_sticky_menu_link_color',
         [
            'label'     => __('Sticky Link Menu Color', 'gowilds-themer'),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
               '.gv-sticky-wrapper.is-fixed > .elementor-section .gva-navigation-menu ul.gva-nav-menu > li > a' => 'color: {{VALUE}}',
            ],
            'condition' => [
               '_gva_sticky_menu!' => ''
            ]
         ]
      );
      $obj->add_control(
         '_gva_sticky_menu_link_hover_color',
         [
            'label'     => __('Sticky Link Menu Hover Color', 'gowilds-themer'),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
               '.gv-sticky-wrapper.is-fixed > .elementor-section .gva-navigation-menu ul.gva-nav-menu > li > a:hover' => 'color: {{VALUE}}',
            ],
            'condition' => [
               '_gva_sticky_menu!' => ''
            ]
         ]
      );
      $obj->end_controls_section();
   }

   public function row_style($obj, $args){

      // Settings for row
      $obj->start_controls_section(
         'gva_extra_settings_row',
         array(
            'label' => esc_html__( 'Gavias Style Settings', 'gowilds-themer' ),
            'tab'   => Controls_Manager::TAB_STYLE,
         )
      );
      $obj->add_control(
         '_gva_extra_row_style',
         [
            'label'     => __( 'Style Available', 'gowilds-themer' ),
            'type'      => Controls_Manager::SELECT,
            'options'   => [
               ''                 => __( '-- None --', 'gowilds-themer' ),
            ],
            'label_block'  => true,
            'default'      => '',
            'prefix_class' => 'row-',
         ]
      );
      $obj->add_control(
         'gva_row_color',
         [
            'label' => __( 'Background Color', 'gowilds-themer' ),
            'type' => Controls_Manager::SELECT,
            'label_block'  => true,
            'options' => [
               '' => __( '-- Default --', 'gowilds-themer' ),
               'theme'         => __( 'Background Color Theme', 'gowilds-themer' ),
               'theme-second'  => __( 'Background Color Theme Second', 'gowilds-themer' ),
            ],
            'default' => '',
            'prefix_class' => 'bg-row-',
         ]
      );

      $obj->end_controls_section();
   }

}

new GVA_Elementor_Override();

