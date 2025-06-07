<?php
if(!defined('ABSPATH')){ exit; }

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

class GVAElement_Events extends GVAElement_Base{

	const NAME = 'gva-events';
	const TEMPLATE = 'plugins/events/';
	const CATEGORY = 'gowilds_general';

	public function get_categories() {
		return array(self::CATEGORY);
	}

	public function get_name() {
		return self::NAME;
	}
	
	public function get_title() {
		return __('GVA Events', 'gowilds-themer');
	}

	public function get_keywords() {
		return [ 'event', 'content', 'carousel', 'grid' ];
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
		$taxonomy = 'tribe_events_cat';
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
			'post_type' => array('tribe_events'),
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

		$this->add_control(
			'category_ids',
			[
				'label' => __( 'Select By Category', 'gowilds-themer' ),
				'type' => Controls_Manager::SELECT2,
				'multiple'    => true,
				'default' => '',
				'options'   => $this->get_categories_list()
			]
		);

		$this->add_control(
			'post_ids',
			[
				'label' => __( 'Select Individually', 'gowilds-themer' ),
				'type' => Controls_Manager::SELECT2,
				'default' => '',
				'multiple'    => true,
				'label_block' => true,
				'options'   => $this->get_posts()
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
			'orderby',
			[
				'label'   => __( 'Order By', 'gowilds-themer' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'post_date',
				'options' => [
					'post_date'  => __( 'Date', 'gowilds-themer' ),
					'post_title' => __( 'Title', 'gowilds-themer' ),
					'event_start_date' => __( 'Event Start Date', 'gowilds-themer' ),
					'rand'       => __( 'Random', 'gowilds-themer' ),
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
			'event_display',
			[
				'label'   => __( 'Event Display', 'gowilds-themer' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'All', 'gowilds-themer' ),
					'upcoming'  => __( 'Upcoming', 'gowilds-themer' )
				],
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
				'default' => 'list',
				'options' => [
					'list'      => __( 'List', 'gowilds-themer' ),
					'carousel'  => __( 'Carousel', 'gowilds-themer' ),
					'grid'      => __( 'Grid', 'gowilds-themer' )
				]
			]
		);
		$this->add_control(
			'style',
			[
				'label'     => __('Style', 'gowilds-themer'),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'event-1'     => __( 'Event Item Style I', 'gowilds-themer' )
				],
				'default' => 'event-1',
				'condition' => [
					'layout' => ['carousel', 'grid']
				]
			]
		);
		$this->add_control(
			'image_size',
			[
			   'label'     => __('Image Size', 'gowilds-themer'),
			   'type'      => \Elementor\Controls_Manager::SELECT,
			   'options'   => $this->get_thumbnail_size(),
			   'default'   => 'gowilds_medium'
			]
		 );
		
		$this->add_control(
			'pagination',
			[
				'label'     => __('Pagination', 'gowilds-themer'),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'condition' => [
					'layout' => ['grid', 'list']
				],
			]
		);

		$this->end_controls_section();

		$this->add_control_carousel(false, array('layout' => 'carousel'));

		$this->add_control_grid(array('layout' => 'grid'));

	}

	public static function get_query_args(  $settings ) {
		$defaults = [
			'post_ids' => '',
			'category_ids' => '',
			'orderby' => 'date',
			'order' => 'desc',
			'posts_per_page' => 3,
			'offset' => 0,
		];

		$settings = wp_parse_args( $settings, $defaults );
		$cats = $settings['category_ids'];
		$ids = $settings['post_ids'];

		$query_args = [
			'post_type'=>array(Tribe__Events__Main::POSTTYPE),
			'posts_per_page' => $settings['posts_per_page'],
			'orderby' => $settings['orderby'],
			'order' => $settings['order'],
			'ignore_sticky_posts' => 1,
			'post_status' => 'publish', 
			'eventDisplay' => 'custom'
		];
		
		if($settings['event_display']){
			$query_args['eventDisplay'] = $settings['event_display'];
		}

		if($settings['orderby'] == 'event_start_date'){
			$query_args['meta_key'] = '_EventStartDate';
			$query_args['orderby'] = '_EventStartDate';
		}
	   
		if($cats){
			if( is_array($cats) && count($cats) > 0 ){
				$field_name = is_numeric($cats[0]) ? 'term_id':'slug';
				$query_args['tax_query'] = array(
					array(
					  'taxonomy' => 'tribe_events_cat',
					  'terms' => $cats,
					  'field' => $field_name,
					  'include_children' => false
					)
				);
			}
		}
		if( $ids ){
		  if( is_array($ids) && count($ids) > 0 ){
			$query_args['post__in'] = $ids;
		//	$query_args['orderby'] = 'post__in';
		  }
		}

		if(is_front_page()){
			$query_args['paged'] = (get_query_var('page')) ? get_query_var('page') : 1;
		}else{
			$query_args['paged'] = (get_query_var('paged')) ? get_query_var('paged') : 1;
		}
 
		return $query_args;
	}

	public function query_posts() {
		$query_args = $this->get_query_args( $this->get_settings() );
       return tribe_get_events( $query_args );
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		printf( '<div class="gva-element-%s gva-element">', $this->get_name() );
		if( !empty($settings['layout']) ){
			include $this->get_template(self::TEMPLATE . $settings['layout'] . '.php');
		}
		print '</div>'; 

	}
}

$widgets_manager->register(new GVAElement_Events());
