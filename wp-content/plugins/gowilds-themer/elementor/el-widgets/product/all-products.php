<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

class GVAElement_AllProducts extends GVAElement_Base{
    const NAME = 'gva-products';
   const TEMPLATE = 'product/all-products/';
   const CATEGORY = 'gowilds_woocommerce';

    public function get_name() {
      return self::NAME;
    }

    public function get_categories() {
      return array(self::CATEGORY);
    }

    public function get_title() {
        return __('All Products', 'gowilds-themer');
    }

    public function get_keywords() {
        return [ 'product', 'content', 'carousel', 'grid' ];
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

    private function get_categories_list(){
        $categories = array();

        $categories['none'] = __( 'None', 'gowilds-themer' );
        $taxonomy = 'product_cat';
        $tax_terms = get_terms( $taxonomy );
        if ( ! empty( $tax_terms ) && ! is_wp_error( $tax_terms ) ){
            foreach( $tax_terms as $item ) {
                $categories[$item->term_id] = $item->name;
            }
        }
        return $categories;
    }

    private function get_posts() {
        $posts = array();

        $loop = new \WP_Query( array(
            'post_type' => array('product'),
            'posts_per_page' => -1,
            'post_status'=>array('publish'),
        ) );

        $posts['none'] = __('None', 'gowilds-themer');

        while ( $loop->have_posts() ) : $loop->the_post();
            $id = get_the_ID();
            $title = get_the_title();
            $posts[$id] = $title;
        endwhile;

        wp_reset_postdata();

        return $posts;
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_query',
            [
                'label' => __('Query & Layout', 'gowilds-themer'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control( // xx Layout
            'layout_heading',
            [
                'label'   => __( 'Layout', 'gowilds-themer' ),
                'type'    => Controls_Manager::HEADING,
            ]
        );
         $this->add_control(
            'layout',
            [
                'label'   => __( 'Layout Display', 'gowilds-themer' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'carousel',
                'options' => [
                    'grid'              => __( 'Grid', 'gowilds-themer' ),
                    'carousel'          => __( 'Carousel', 'gowilds-themer' )
                ]
            ]
        );

        $this->add_control(
            'style',
            [
                'label'     => __('Style', 'gowilds-themer'),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default' => 'style-1',
                'options' => [
                    'product'         => __( 'Item Style I', 'gowilds-themer' )
                ],
                'condition' => [
                    'layout' => array('grid', 'carousel')
                ]
            ]
        );

        $this->add_control(
            'image_size',
            [
               'label'     => __('Image Style', 'gowilds-themer'),
               'type'      => \Elementor\Controls_Manager::SELECT,
               'options'   => $this->get_thumbnail_size(),
               'default'   => 'gowilds_medium'
            ]
        );
        

        $this->add_control( // xx Layout
            'query_heading',
            [
                'label'   => __( 'Query', 'gowilds-themer' ),
                'type'    => Controls_Manager::HEADING,
            ]
        );
        $this->add_control(
            'category_ids',
            [
                'label' => __( 'Select By Category', 'gowilds-themer' ),
                'type' => Controls_Manager::SELECT2,
                'multiple'    => true,
                'default' => '',
                'label_block' => true,
                'options'   => $this->get_categories_list()
            ]
        );

        $this->add_control(
            'post_ids',
            [
                'label' => __( 'Product IDs', 'gowilds-themer' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'label_block' => true,
                'description' => esc_html__('Example: 1,2,3,4,5', 'gowilds-themer')
            ]  
        );

        $this->add_control(
            'posts_per_page',
            [
                'label' => __( 'Posts Per Page', 'gowilds-themer' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 6,
            ]
        );

        $this->add_control(
            'featured',
            [
                'label'     => __('Show Only Featured Campaign', 'gowilds-themer'),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'no'
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label'   => __( 'Order By', 'gowilds-themer' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'post_date',
                'options' => [
                    'post_date'  => __('Date', 'gowilds-themer'),
                    'post_title' => __('Title', 'gowilds-themer'),
                    'rand'       => __('Random', 'gowilds-themer')
                ],
            ]
        );

        $this->add_control(
            'order',
            [
                'label'   => __( 'Order', 'gowilds-themer' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'desc',
                'options' => [
                    'asc'  => __( 'ASC', 'gowilds-themer' ),
                    'desc' => __( 'DESC', 'gowilds-themer' ),
                ],
            ]
        );

        $this->add_control(
            'pagination',
            [
                'label'     => __('Pagination', 'gowilds-themer'),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'no',
                'condition' => [
                    'layout' => 'grid'
                ],
            ]
        );

        $this->end_controls_section();

        $this->add_control_carousel(false, array('layout' => ['carousel', 'carousel_center']));

        $this->add_control_grid(array('layout' => 'grid'));

        // Styling post title
        $this->start_controls_section(
            'section_styling_post_title',
            [
                'label' => __( 'Product Title', 'gowilds-themer' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'layout' => ['grid', 'carousel']
                ],
            ]
        );

        $this->add_control(
            'post_box_title_color',
            [
                'label' => __( 'Color Title', 'gowilds-themer' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .product-block .product-block-inner .product-meta .shop-loop-title a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'post_box_title_color_hover',
            [
                'label' => __( 'Color Title Hover', 'gowilds-themer' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .product-block .product-block-inner .product-meta .shop-loop-title a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'post_box_title_typography',
                'selector' => '{{WRAPPER}} .product-block .product-block-inner .product-meta .shop-loop-title a',
            ]
        );

        $this->add_control(
            'post_box_meta_color',
            [
                'label' => __( 'Category Color', 'gowilds-themer' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .product-block .product-block-inner .product-meta .shop-category a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

       

    }

    public static function get_query_args(  $settings ) {
        global $woocommerce;
        $defaults = [
            'post_ids'          => '',
            'category_ids'      => '',
            'orderby'           => 'date',
            'order'             => 'desc',
            'posts_per_page'    => 3,
            'offset'            => 0
        ];

        $settings = wp_parse_args( $settings, $defaults );
        $cats = $settings['category_ids'];
        $ids = $settings['post_ids'];

        $query_args = [
            'post_type' => 'product',
            'posts_per_page' => $settings['posts_per_page'],
            'orderby' => $settings['orderby'],
            'order' => $settings['order'],
            'ignore_sticky_posts' => 1,
            'post_status' => 'publish'
        ];
       
        if($cats){
            if( is_array($cats) && count($cats) > 0 ){
                $field_name = is_numeric($cats[0]) ? 'term_id':'slug';
                $taxquery['relation'] = 'AND';
                $taxquery[] = array(
                  'taxonomy' => 'product_cat',
                  'terms' => $cats,
                  'field' => $field_name,
                  'include_children' => false
                );
            }
        }
        if($ids){
            $_ids = explode(',', $ids);
            if( is_array($_ids) && count($_ids) > 0 ){
                $query_args['post__in'] = $_ids;
                $query_args['orderby'] = 'post__in';
            }
        }
        
        $taxquery[] = array(
            'taxonomy' => 'product_visibility',
            'field'    => 'name',
            'terms'    => 'exclude-from-catalog',
            'operator' => 'NOT IN',
        );

        if($settings['featured'] == 'yes'){
            $taxquery[] = array(
                'taxonomy' => 'product_visibility',
                'field'    => 'name',
                'terms'    => 'featured',
                'operator' => 'IN',
            );
        }

        $query_args['tax_query'] = $taxquery;

        if(is_front_page()){
            $query_args['paged'] = (get_query_var('page')) ? get_query_var('page') : 1;
        }else{
            $query_args['paged'] = (get_query_var('paged')) ? get_query_var('paged') : 1;
        }
 
        return $query_args;
    }

    public function query_posts() {
        $query_args = $this->get_query_args( $this->get_settings() );
        return new WP_Query($query_args);
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        printf('<div class="gva-element-%s gva-element">', $this->get_name());
        if( !empty($settings['layout']) ){
            include $this->get_template(self::TEMPLATE . $settings['layout'] . '.php');
        }
        print '</div>'; 
    }
}

$widgets_manager->register(new GVAElement_AllProducts());
