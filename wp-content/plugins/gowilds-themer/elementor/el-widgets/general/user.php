<?php
if(!defined('ABSPATH')){ exit; }

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;

class GVAElement_User extends GVAElement_Base {
   
   const NAME = 'gva_user';
   const TEMPLATE = 'general/user';
   const CATEGORY = 'gowilds_general';

	public function get_categories(){
      return array(self::CATEGORY);
   }
    
   public function get_name(){
      return self::NAME;
   }

	public function get_title() {
		return __( 'GVA User', 'gowilds-themer' );
	}

	public function get_keywords() {
		return [ 'menu', 'user', 'block' ];
	}

	public function get_all_menus(){
	   $menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) ); 
	   $results = array();
	   foreach ($menus as $key => $menu) {
	   	$results[$menu->slug] = $menu->name;
	   }
	   return $results;
	}


	protected function register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'gowilds-themer' ),
			]
		);
      $this->add_control(
         'align',
         [
            'label' => __( 'Alignment', 'gowilds-themer' ),
            'type' => Controls_Manager::CHOOSE,
            'options' => [
               'left' => [
                  'title' => __( 'Left', 'gowilds-themer' ),
                  'icon' => 'fa fa-align-left',
               ],
               'center' => [
                  'title' => __( 'Center', 'gowilds-themer' ),
                  'icon' => 'fa fa-align-center',
               ],
               'right' => [
                  'title' => __( 'Right', 'gowilds-themer' ),
                  'icon' => 'fa fa-align-right',
               ],
            ],
            'default' => 'center',
         ]
      );

      $this->add_control(
         'register_text',
         [
            'label'        => __('Register Text', 'gowilds-themer'),
            'type'         => Controls_Manager::TEXT,
            'default'      => __('Register', 'gowilds-themer')
         ]
      );
    
      $this->add_control(
         'hi_text',
         [
            'label'        => __('Hi Text', 'gowilds-themer'),
            'type'         => Controls_Manager::TEXT,
            'default'      => __('Hi', 'gowilds-themer')
         ]
      );

      $this->add_control(
         'selected_icon',
         [
            'label' => __( 'Icon', 'gowilds-themer' ),
            'type' => Controls_Manager::ICONS,
            'fa4compatibility' => 'icon',
            'default' => [
               'value' => 'fas fa-user',
               'library' => 'fa-solid',
            ],
         ]
      );

      $this->add_control(
         'login_link',
         [
            'label'        => __('Custom Link Login', 'gowilds-themer'),
            'type'         => Controls_Manager::TEXT,
            'label_block'  => true,
            'description'  => esc_html__('Empty = default link', 'gowilds-themer'),
         ]
      );
      $this->add_control(
         'register_link',
         [
            'label'        => __('Custom Link Register', 'gowilds-themer'),
            'type'         => Controls_Manager::TEXT,
            'label_block'  => true,
            'description'  => esc_html__('Empty = default link', 'gowilds-themer'),
         ]
      );

      $this->add_control(
         'source',
         [
            'label'   => esc_html__('Source Menu', 'gowilds-themer'),
            'type'    => Controls_Manager::SELECT,
            'default' => 'babe',
            'options' => [
               'wte'     => esc_html__('WP Travel Engine', 'gowilds-themer'),
               'babe'     => esc_html__('BA Book Everything', 'gowilds-themer'),
            ]
         ]
      );

      $this->add_control(
         'menu',
         [
            'label'        => __( 'Menu', 'gowilds-themer' ),
            'type'         => Controls_Manager::SELECT,
            'options'      => $this->get_all_menus(),
            'label_block'  => true,
            'default'      => 'my-account',
            'condition' => [
               'source' => 'wte'
            ]
         ]
      );

		$this->add_control(
			'menu_width',
			[
				'label' => __( 'Menu Width (px)', 'gowilds-themer' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 250,
				],
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .user-one__user-account' => 'min-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_section();

      $this->start_controls_section(
         'section_content_style',
         [
            'label' => __( 'Text & Icon', 'gowilds-themer' ),
            'tab' => Controls_Manager::TAB_STYLE,
         ]
      );

      $this->add_control(
         'icon_style',
         [
            'label' => __( 'Icon Style', 'gowilds-themer' ),
            'type'      => Controls_Manager::HEADING,
         ]
      );

      $this->add_responsive_control(
         'icon_size',
         [
            'label' => __( 'Icon Size', 'gowilds-themer' ),
            'type' => Controls_Manager::SLIDER,
            'range' => [
               'px' => [
                  'min' => 10,
                  'max' => 100,
               ],
            ],
            'selectors' => [
               '{{WRAPPER}} .user-one__avata-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
               '{{WRAPPER}} .user-one__avata-icon svg' => 'width: {{SIZE}}{{UNIT}};',
            ],
         ]
      );
      $this->add_control(
         'icon_bg_color',
         [
            'label' => __( 'Icon Background Color', 'gowilds-themer' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
               '{{WRAPPER}} .user-one__avata-icon' => 'background-color: {{VALUE}}', 
            ],
         ]
      );
      $this->add_control(
         'icon_color',
         [
            'label' => __( 'Icon Color', 'gowilds-themer' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
               '{{WRAPPER}} .user-one__avata-icon i' => 'color: {{VALUE}}', 
               '{{WRAPPER}} .user-one__avata-icon svg' => 'fill: {{VALUE}}'
            ],
         ]
      );

      $this->add_control(
         'icon_bg_hover',
         [
            'label' => __( 'Hover - Background Color', 'gowilds-themer' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
               '{{WRAPPER}} .user-one__single:hover .user-one__avata-icon' => 'background-color: {{VALUE}}', 
            ],
         ]
      );
      $this->add_control(
         'icon_color_hover',
         [
            'label' => __( 'Hover - Icon Color', 'gowilds-themer' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
               '{{WRAPPER}} .user-one__single:hover .user-one__avata-icon i' => 'color: {{VALUE}}', 
               '{{WRAPPER}} .user-one__single:hover .user-one__avata-icon svg' => 'fill: {{VALUE}}'
            ],
         ]
      );

      $this->add_responsive_control(
         'icon_padding',
         [
            'label' => __( 'Padding', 'gowilds-themer' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors' => [
               '{{WRAPPER}} .user-one__single .user-one__avata-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
         ]
      );
      $this->end_controls_section();

		$this->start_controls_section(
			'section_account_menu_style',
			[
				'label' => __( 'Menu Box', 'gowilds-themer' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
      $this->add_control(
         'account_menu_color',
         [
            'label'     => __('Color', 'gowilds-themer'),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .user-one__single .my_account_nav_list > li > a' => 'color: {{VALUE}}',
            ],
         ]
      );
      $this->add_control(
         'account_menu_color_hover',
         [
            'label'     => __('Color Hover', 'gowilds-themer'),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .user-one__single .my_account_nav_list > li > a:hover' => 'color: {{VALUE}}',
            ],
         ]
      );

      $this->add_group_control(
         Group_Control_Typography::get_type(),
         [
            'name' => 'typography',
            'selector' => '{{WRAPPER}} .user-one__single .my_account_nav_list > li > a',
         ]
      );

      $this->add_responsive_control(
         'main_menu_padding',
         [
            'label' => __( 'Menu Item Padding', 'gowilds-themer' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors' => [
               '{{WRAPPER}} .user-one__single .my_account_nav_list > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
         ]
      );
  
      $this->end_controls_tab();

      $this->end_controls_tabs();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		printf( '<div class="gva-element-%s gva-element">', $this->get_name() );
        include $this->get_template(self::TEMPLATE . '.php');
      print '</div>';
	}
}

$widgets_manager->register(new GVAElement_User());
