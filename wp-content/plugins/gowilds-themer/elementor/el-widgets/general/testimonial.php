<?php
if(!defined('ABSPATH')){ exit; }

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;

class GVAElement_Testimonial extends GVAElement_Base{
    const NAME = 'gva-testimonials';
    const TEMPLATE = 'general/testimonials/';
    const CATEGORY = 'gowilds_general';

    public function get_name() {
        return self::NAME;
    }

    public function get_categories() {
        return array(self::CATEGORY);
    }

    public function get_title() {
        return __('Testimonials', 'gowilds-themer');
    }

    public function get_keywords() {
        return [ 'testimonial', 'content', 'carousel' ];
    }

    public function get_script_depends() {
        return [
            'swiper',
            'gavias.elements',
        ];
    }

    public function get_style_depends() {
        return array('swiper');
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_testimonial',
            [
                'label' => __('Testimonials', 'gowilds-themer'),
            ]
        );

        $this->add_control(
            'layout',
            [
                'label'   => esc_html__('Layout Display', 'gowilds-themer'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'carousel',
                'options' => [
                    'grid'      => esc_html__('Grid', 'gowilds-themer'),
                    'carousel'  => esc_html__('Carousel', 'gowilds-themer')
                ]
            ]
        );

        $this->add_control(
            'style',
            array(
                'label'   => esc_html__( 'Style', 'gowilds-themer' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'style-1',
                'options' => [
                  'style-1'  => esc_html__('Item Style 01', 'gowilds-themer'),
                  'style-2'  => esc_html__('Item Style 02', 'gowilds-themer'),
                  'style-3'  => esc_html__('Item Style 03', 'gowilds-themer'),
                  'style-4'  => esc_html__('Item Style 04', 'gowilds-themer')
                ]
            )
        );
        
        $repeater = new Repeater();
        
        $repeater->add_control(
            'testimonial_content',
            [
                'label'       => __('Content', 'gowilds-themer'),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => 'Duis rhoncus orci utedn metus rhoncus, non is dictum purus bibendum. Suspendisse id orci sit amet justo interdum hendrerit sagittis.',
                'label_block' => true,
                'rows'        => '10',
            ]
        );
        $repeater->add_control(
            'testimonial_image',
            [
                'label'      => __('Choose Image', 'gowilds-themer'),
                'default'    => [
                    'url' => GAVIAS_GOWILDS_PLUGIN_URL . 'elementor/assets/images/testimonial.jpg',
                ],
                'type'       => Controls_Manager::MEDIA,
                'show_label' => false,
            ]
        );

        $repeater->add_control(
            'testimonial_title',
            [
                'label'   => __('Title', 'gowilds-themer'),
                'default' => 'Quality Servies',
                'type'    => Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'testimonial_name',
            [
                'label'   => __('Name', 'gowilds-themer'),
                'default' => 'John Doe',
                'type'    => Controls_Manager::TEXT,
            ]
        );
        
        $repeater->add_control(
            'testimonial_job',
            [
                'label'   => __('Job', 'gowilds-themer'),
                'default' => 'Designer',
                'type'    => Controls_Manager::TEXT,
            ]
        );   

        $this->add_control(
            'testimonials',
            [
                'label'       => __('Testimonials Content Item', 'gowilds-themer'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ testimonial_name }}}',
                'default'     => array(
                    array(
                        'testimonial_name'     => esc_html__( 'Christine Eve', 'gowilds-themer' ),
                        'testimonial_job'      => esc_html__( 'Founder & CEO', 'gowilds-themer' ),
                    ),
                    array(
                        'testimonial_name'     => esc_html__( 'Kevin Smith', 'gowilds-themer' ),
                        'testimonial_job'      => esc_html__( 'Customer', 'gowilds-themer' ),
                    ),
                    array(
                        'testimonial_name'     => esc_html__( 'Jessica Brown', 'gowilds-themer' ),
                        'testimonial_job'      => esc_html__( 'Founder & CEO', 'gowilds-themer' ),
                    ),
                    array(
                        'testimonial_name'     => esc_html__( 'David Anderson', 'gowilds-themer' ),
                        'testimonial_job'      => esc_html__( 'Customer', 'gowilds-themer' ),
                    ),
                    array(
                        'testimonial_name'     => esc_html__( 'Susan Neill', 'gowilds-themer' ),
                        'testimonial_job'      => esc_html__( 'Founder & CEO', 'gowilds-themer' ),
                    ),
                ),
            ]
        );

        $this->add_group_control(
            Elementor\Group_Control_Image_Size::get_type(),
            [
                'name'      => 'testimonial_image', 
                'default'   => 'full',
                'separator' => 'none',
                'condition' => [
                    'style' => array('style-1', 'style-2')
                ]
            ]
        );

        $this->add_control(
            'view',
            [
                'label'   => __('View', 'gowilds-themer'),
                'type'    => Controls_Manager::HIDDEN,
                'default' => 'traditional',
            ]
        );
        $this->end_controls_section();

        $this->add_control_carousel(false, array('layout' => 'carousel'));

        $this->add_control_grid(array('layout' => 'grid'));

        // Style.
        $this->start_controls_section(
            'section_style_content',
            [
                'label' => __('Content', 'gowilds-themer'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
 
        $this->add_control(
            'content_content_color',
            [
                'label'     => __('Text Color', 'gowilds-themer'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .testimonial-one__quote' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .testimonial-two__quote' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .testimonial-three__quote' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'content_typography',
                'selector' => '{{WRAPPER}} .testimonial-one__quote, {{WRAPPER}} .testimonial-two__quote, {{WRAPPER}} .testimonial-three__quote',
            ]
        );

        $this->end_controls_section();

        // Image Styling
        $this->start_controls_section(
            'section_style_image',
            [
                'label'     => __('Image', 'gowilds-themer'),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'image_size',
            [
                'label'      => __('Image Size', 'gowilds-themer'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 20,
                        'max' => 200,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} {{WRAPPER}} testimonial-one__image img' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} {{WRAPPER}} testimonial-two__image img' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} {{WRAPPER}} testimonial-three__image img' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'image_border',
                'selector'  => '{{WRAPPER}} .gsc-testimonial .testimonial-image img',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'image_border_radius',
            [
                'label'      => __('Border Radius', 'gowilds-themer'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} testimonial-one__image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} testimonial-two__image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} testimonial-three__image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Name Styling
        $this->start_controls_section(
            'section_style_name',
            [
                'label' => __('Name', 'gowilds-themer'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'name_text_color',
            [
                'label'     => __('Text Color', 'gowilds-themer'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .testimonial-one__name'    => 'color: {{VALUE}}!important;',
                    '{{WRAPPER}} .testimonial-two__name'    => 'color: {{VALUE}}!important;',
                    '{{WRAPPER}} .testimonial-three__name'  => 'color: {{VALUE}}!important;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'name_typography',
                'selector' => '{{WRAPPER}} testimonial-one__name, {{WRAPPER}} testimonial-two__name, {{WRAPPER}} testimonial-three__name',
            ]
        );

        $this->end_controls_section();

        // Job Styling
        $this->start_controls_section(
            'section_style_job',
            [
                'label' => __('Job', 'gowilds-themer'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'job_text_color',
            [
                'label'     => __('Text Color', 'gowilds-themer'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .testimonial-one__job'    => 'color: {{VALUE}}!important;',
                    '{{WRAPPER}} .testimonial-two__job'    => 'color: {{VALUE}}!important;',
                    '{{WRAPPER}} .testimonial-three__job'  => 'color: {{VALUE}}!important;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'job_typography',
                'selector' => '{{WRAPPER}} .testimonial-one__job, {{WRAPPER}} .testimonial-two__job, {{WRAPPER}} .testimonial-three__job',
            ]
        );
        $this->end_controls_section();

    }

    protected function render() {
      $settings = $this->get_settings_for_display();
      printf( '<div class="gva-element-%s gva-element">', $this->get_name() );
      if($settings['layout']){
         include $this->get_template(self::TEMPLATE . $settings['layout'] . '.php');
      }
      print '</div>';
    }
}

$widgets_manager->register(new GVAElement_Testimonial());
