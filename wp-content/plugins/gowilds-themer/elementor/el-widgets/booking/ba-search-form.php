<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;

class GVAElement_BA_Search_Form extends GVAElement_Base{
    
   const NAME = 'gva_ba_search_form';
   const TEMPLATE = 'booking/booking';
   const CATEGORY = 'gowilds_ba_booking';

   public function get_categories() {
      return array(self::CATEGORY);
   }

   public function get_name() {
      return self::NAME;
   }

   public function get_title() {
      return __('BA Search Form', 'gowilds-themer');
   }

   public function get_keywords() {
      return [ 'booking', 'ba', 'tour', 'book everthing', 'search', 'form' ];
   }

   public function get_script_depends() {
      return [
         'gavias.elements'
      ];
   }

   public function get_booking_taxonomies(){
      $taxonomies_list = array();
      $taxonomies = get_terms(array(
         'taxonomy' => BABE_Post_types::$taxonomies_list_tax,
         'hide_empty' => false
      ));

      if(!is_wp_error($taxonomies) && ! empty($taxonomies)){
         foreach ($taxonomies as $tax_term) {
            $taxonomies_list[$tax_term->slug] = apply_filters('translate_text', $tax_term->name);
         }
      }
      return $taxonomies_list;
   }

   protected function register_controls() {
      $taxonomies_list = $this->get_booking_taxonomies();

      $this->start_controls_section(
         self::NAME . '_content',
         [
            'label' => __('Content', 'gowilds-themer'),
         ]
      );

      $this->add_control(
         'layout_heading',
         array(
            'label'   => esc_html__( 'Layout Settings', 'gowilds-themer' ),
            'type'    => 'heading'
         )
      );

      $this->add_control(
         'layout',
         array(
            'label'   => esc_html__( 'Layout', 'gowilds-themer' ),
            'type'    => Controls_Manager::SELECT,
            'default' => 'layout-1',
            'options' => [
               'layout-1'     => esc_html__('Horizontal', 'gowilds-themer'),
               'layout-1-2'   => esc_html__('Horizontal II', 'gowilds-themer'),
               'layout-2'     => esc_html__('Vertical', 'gowilds-themer')
            ]
         )
      );
      
      $this->add_control(
         'title_search_box',
         [
            'label'     => __('Title <strong>Search Box</strong>', 'gowilds-themer'),
            'type'      => Controls_Manager::TEXT,
            'default'   => esc_html__('Where are you going?', 'gowilds-themer'),
            'label_block'  => true
         ]
      );

      $this->add_control(
         'title_date_from',
         [
            'label'     => __('Title <strong>Date From</strong>', 'gowilds-themer'),
            'type'      => Controls_Manager::TEXT,
            'default'   => esc_html__('Date From', 'gowilds-themer'),
            'label_block'  => true
         ]
      );

      $this->add_control(
         'title_date_to',
         [
            'label'     => __('Title <strong>Date To</strong>', 'gowilds-themer'),
            'type'      => Controls_Manager::TEXT,
            'default'   => esc_html__('Date To', 'gowilds-themer'),
            'label_block'  => true,
         ]
      );

      if($taxonomies_list){
         foreach ($taxonomies_list as $key => $name){
            $this->add_control(
               BABE_Post_types::$attr_tax_pref . $key . '_title',
               array(
                  'label'        => esc_html__('Title', 'gowilds-themer') . ' <strong>' . $name . '</strong>',
                  'type'         => \Elementor\Controls_Manager::TEXT,
                  'label_block'  => true,
                  'default'      => ucfirst($key)
               )
            );
         }
      }

      $this->add_control(
         'btn_search_title',
         array(
            'label'   => esc_html__( 'Title <strong>Search Button</strong>', 'gowilds-themer' ),
            'type'    => Controls_Manager::TEXT,
            'default' => esc_html__('Search', 'gowilds-themer'),
            'label_block'  => true
         )
      );

      $this->end_controls_section();

      // ============
      $this->start_controls_section(
         self::NAME . '_fields_hidden',
         [
            'label' => __('Override Settings Hidden Fields', 'gowilds-themer'),
         ]
      );
      $this->add_control(
         'hidden_tab',
         [
            'label'        => __('Hidden Tab', 'gowilds-themer'),
            'type'         => Controls_Manager::SWITCHER,
            'default'      => 'yes',
            'description'  => esc_html__('You should use only when have one item tab', 'gowilds-themer') 
         ]
      );

      $this->add_control(
         'search_field_hidden',
         [
            'label'        => __('Hidden Search Field', 'gowilds-themer'),
            'type'         => Controls_Manager::SWITCHER,
            'default'      => 'yes'
         ]
      );

      if($taxonomies_list){
         foreach ($taxonomies_list as $key => $name){
            $this->add_control(
               BABE_Post_types::$attr_tax_pref . $key . '_hidden',
               array(
                  'label'        => esc_html__('Hidden', 'gowilds-themer') . ' <strong>' . $name . '</strong>',
                  'type'         => \Elementor\Controls_Manager::SWITCHER,
                  'default'      => ucfirst($key)
               )
            );
         }
      }

      $this->end_controls_section();

      //=======================
      $this->start_controls_section(
         self::NAME . '_fields_width',
         [
            'label' => __('Override Settings Width Fields', 'gowilds-themer'),
         ]
      );
      $this->add_control(
         'width_field_1',
         [
            'label' => __( 'Field 1 (%)', 'gowilds-themer' ),
            'type' => Controls_Manager::SLIDER,
            'range' => [
              '%' => [
                'min' => 10,
                'max' => 100,
              ],
            ],
            'selectors' => [
               '{{WRAPPER}} #search_form .input-group > div:nth-child(1).is-active' => 'max-width: calc( (100% - 240px) * ({{SIZE}}/100) );-ms-flex: 0 0 calc( (100% - 240px) * ({{SIZE}}/100) );flex: 0 0 calc( (100% - 240px) * ({{SIZE}}/100) );',
            ],
         ]
      );

      $this->add_control(
         'width_field_2',
         [
            'label' => __( 'Field 2 (%)', 'gowilds-themer' ),
            'type' => Controls_Manager::SLIDER,
            'range' => [
              '%' => [
                'min' => 10,
                'max' => 100,
              ],
            ],
            'selectors' => [
               '{{WRAPPER}} #search_form .input-group > div:nth-child(2).is-active' => 'max-width: calc( (100% - 240px) * ({{SIZE}}/100) );-ms-flex: 0 0 calc( (100% - 240px) * ({{SIZE}}/100) );flex: 0 0 calc( (100% - 240px) * ({{SIZE}}/100) );'
            ]
         ]
      );

      $this->add_control(
         'width_field_3',
         [
            'label' => __( 'Field 3 (%)', 'gowilds-themer' ),
            'type' => Controls_Manager::SLIDER,
            'range' => [
              '%' => [
                'min' => 10,
                'max' => 100,
              ],
            ],
            'selectors' => [
               '{{WRAPPER}} #search_form .input-group > div:nth-child(3).is-active' => 'max-width: calc( (100% - 240px) * ({{SIZE}}/100) );-ms-flex: 0 0 calc( (100% - 240px) * ({{SIZE}}/100) );flex: 0 0 calc( (100% - 240px) * ({{SIZE}}/100) );'
            ],
         ]
      );

      $this->add_control(
         'width_field_4',
         [
            'label' => __( 'Field 4 (%)', 'gowilds-themer' ),
            'type' => Controls_Manager::SLIDER,
            'range' => [
              '%' => [
                'min' => 10,
                'max' => 100,
              ],
            ],
            'selectors' => [
               '{{WRAPPER}} #search_form .input-group > div:nth-child(4).is-active' => 'max-width: calc( (100% - 240px) * ({{SIZE}}/100) );-ms-flex: 0 0 calc( (100% - 240px) * ({{SIZE}}/100) );flex: 0 0 calc( (100% - 240px) * ({{SIZE}}/100) );'
            ],
         ]
      );

      $this->add_control(
         'width_field_5',
         [
            'label' => __( 'Field 5 (%)', 'gowilds-themer' ),
            'type' => Controls_Manager::SLIDER,
            'range' => [
              '%' => [
                'min' => 10,
                'max' => 100,
              ],
            ],
            'selectors' => [
               '{{WRAPPER}} #search_form .input-group > div:nth-child(5).is-active' => 'max-width: calc( (100% - 240px) * ({{SIZE}}/100) );-ms-flex: 0 0 calc( (100% - 240px) * ({{SIZE}}/100) );flex: 0 0 calc( (100% - 240px) * ({{SIZE}}/100) );'
            ],
         ]
      );

      $this->end_controls_section();

    }
    
   protected function render() {
      $settings = $this->get_settings_for_display();
      $taxonomies_list = $this->get_booking_taxonomies();
      $data_tax_hidden = array();

      if($taxonomies_list){
         foreach ($taxonomies_list as $key => $name){
            $tax_key = BABE_Post_types::$attr_tax_pref . $key . '_hidden';
            if($settings[$tax_key] == 'yes'){
               $data_tax_hidden[] = BABE_Post_types::$attr_tax_pref . $key;
            }
         }
      }

      printf( '<div class="gva-element-%s gva-element">', $this->get_name());
         echo '<div class="gowilds-search-form-wrap" style="opacity: 0;filter: alpha(opacity=0);">';

            $title = '';
            $args = array(
               'wrapper_class'   => "gowilds-search-form {$settings['layout']} hidden-tab-{$settings['hidden_tab']}",
               'form_class'      => '',
               'button_title'    => $settings['btn_search_title'],
            );
            $html = BABE_Search_From::render_form($title, $args);
            $html = str_replace('tabindex="0"', '', $html);
            $html = str_replace('  data-active', ' data-active', $html);
            $html = str_replace('"">', '">', $html);

            echo $html;
            echo '<div class="data-hidden" data-hidden-tax="' . htmlspecialchars(json_encode($data_tax_hidden)) . '"></div>';

            echo '<div class="form-fields-title hidden">';
               if($taxonomies_list){
                  foreach ($taxonomies_list as $key => $name){
                     $name_title = BABE_Post_types::$attr_tax_pref . $key . '_title';
                     $title = $settings[$name_title] ? $settings[$name_title] : ucfirst($key);
                     echo '<span class="' . $name_title . '">' . $title . '</span>';
                  }
               }
               $search_box_title = !empty($settings['title_search_box']) ? $settings['title_search_box'] : esc_html__('Keyword', 'gowilds-themer');
               $date_from_title = !empty($settings['title_date_from']) ? $settings['title_date_from'] : esc_html__('Date From', 'gowilds-themer');
               $date_to_title = !empty($settings['title_date_to']) ? $settings['title_date_to'] : esc_html__('Date To', 'gowilds-themer');
               echo '<span class="search_box_title">' . $search_box_title . '</span>';
               echo '<span class="date_from_title">' . $date_from_title . '</span>';
               echo '<span class="date_to_title">' . $date_to_title . '</span>';
            echo '</div>';
         echo '</div>';   

      print '</div>';
   }

}

$widgets_manager->register(new GVAElement_BA_Search_Form());
