<?php
if(!defined('ABSPATH')){ exit; }

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;

class GVAElement_BA_Search_Results extends GVAElement_Base{
	 
	const NAME = 'gva_ba_search_results';
	const TEMPLATE = 'booking/booking';
	const CATEGORY = 'gowilds_ba_booking';

	public function get_categories() {
		return array(self::CATEGORY);
	}

	public function get_name() {
		return self::NAME;
	}

	public function get_title() {
		return __('BA Search Results', 'gowilds-themer');
	}

	public function get_keywords() {
		return [ 'booking', 'ba', 'tour', 'book everthing', 'search', 'results' ];
	}

	public function get_script_depends() {
		return [
			'babe-js'
		];
	}
	protected function register_controls() {

		$this->start_controls_section(
			self::NAME . '_content',
			[
				'label' => __('Content', 'gowilds-themer'),
			]
		);

		$this->add_control(
			'per_page',
			array(
				'label'   => esc_html__( 'Per Page', 'gowilds-themer' ),
				'type'    => Controls_Manager::NUMBER,
				'description'	=> esc_html__('How much items per page to show', 'gowilds-thmer'),
				'default' => '12',
			)
		);

		$this->add_control(
			'order',
			array(
				'label'   => esc_html__( 'Search Result Sort By', 'gowilds-themer' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'price',
				'options' => [
					'title'      			=> esc_html__('Title', 'gowilds-themer'),
					'price'  				=> esc_html__('Price', 'gowilds-themer'),
					'rating'  				=> esc_html__('Rating', 'gowilds-themer'),
					'avdatefrom'  			=> esc_html__('Date From', 'gowilds-themer'),
				]
			)
		);

		$this->add_control(
			'order_by',
			array(
				'label'   => esc_html__( 'Order', 'gowilds-themer' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'asc',
				'options' => [
					'asc'      	=> esc_html__('Ascending', 'gowilds-themer')
				]
			)
		);

		$this->add_control(
			'layout_heading',
			array(
				'label'   => esc_html__( 'Layout __________', 'gowilds-themer' ),
				'type'    => Controls_Manager::HEADING
			)
		);

		$this->add_control(
			'layout',
			array(
				'label'   => esc_html__( 'Layout', 'gowilds-themer' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'grid',
				'options' => [
					'grid'      => esc_html__('Grid', 'gowilds-themer'),
					'list'  		=> esc_html__('List', 'gowilds-themer'),
				]
			)
		);

		$this->add_control(
			'style',
			[
				'label'     => __('Style', 'gowilds-themer'),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => [
					'style-1'      	=> __( 'Item Block Style I', 'gowilds-themer' ),
					'style-2'      	=> __( 'Item Block Style II', 'gowilds-themer' )
				],
				'condition' => [
					'layout' => array('grid')
				]
			]
	  	);

		$this->add_group_control(
			Elementor\Group_Control_Image_Size::get_type(),
			[
				'name'      => 'image', 
				'default'   => 'full',
				'separator' => 'none',
			]
	  	);

		$this->add_control(
         'pagination',
         [
            'label'     => __('Pagination', 'gowilds-themer'),
            'type'      => Controls_Manager::SWITCHER,
            'default'   => 'yes'
         ]
     	);

      $this->end_controls_section();

      $this->add_control_grid(array('layout' => 'grid'));

	 }

	protected function render() {
		$settings = $this->get_settings_for_display();
		
		if($settings['layout'] == 'grid'){ 
			$this->get_grid_settings();
		}else{
			$this->add_render_attribute('grid', 'class', ['layout-list']);
		}

		$settings['show_count'] = 1;
		printf( '<div class="gva-element-%s gva-element">', $this->get_name() );
			$results = $this->get_search_result($settings);
			
			if ($results){ ?>
				<div class="babe_search_results">
	            <div class="babe_search_results_filters">
						<?php if(isset($results['posts_count']) && !empty($results['posts_count']) && $settings['show_count']){ ?>
	                  <div class="count-posts">
	                     <strong class="count"><?php echo esc_html($results['posts_count']); ?></strong>&nbsp;
									<?php echo (1 < $results['posts_count']) ? esc_html__('Tours', 'gowilds-themer') : esc_html__( 'Tour', 'gowilds-themer' ); ?>
	                     </div>
						<?php } ?>

						<?php if(isset($results['sort_by_filter']) && !empty($results['sort_by_filter'])){
								printf('<div class="filter-sort"><span>' . esc_html__('Sort by', 'gowilds-themer') . '</span>%s</div>', $results['sort_by_filter']);
						} ?>
	            </div>

               
               <div <?php echo $this->get_render_attribute_string('grid') ?>>

						<?php if(isset($results['output']) && ! empty($results['output'])) {
							printf('%s', $results['output']);
						} ?>
               </div>

					<?php if(isset($results['page']) && ! empty($results['page'])){
						printf( '%s', $results['page']);
					} ?>

		            <div id="babe_search_result_refresh">
		               <i class="fas fa-spinner fa-spin fa-3x"></i>
		            </div>

	         </div>

			<?php }else{
				echo '<h2 class="empty-list">' . esc_html__( 'No available tours', 'gowilds-themer' ) . '</h2>';
				echo '<p>' . esc_html__( 'It seems we can’t find what you’re looking for. ', 'gowilds-themer' ) . '</p>';
			}
		print '</div>';
	}

	public static function get_search_result($settings){
		  
		$output = '';
		$args = wp_parse_args($_GET, array(
			'request_search_results' 	=> '',
			'date_from' 				 	=> '', //// d/m/Y or m/d/Y format
			'date_to' 					 	=> '',
			'time_from' 				 	=> '00:00',
			'time_to' 					 	=> '00:00',
			'categories' 				 	=> [], //// term_taxonomy_ids from categories
			'terms' 						 	=> [], //// term_taxonomy_ids from custom taxonomies in $taxonomies_list
			'search_results_sort_by' 	=> 'title_asc',
			'keyword' 					 	=> '',
			'posts_per_page'         	=> $settings['per_page'],
			'sort'                   	=> $settings['order'],
			'sort_by'                	=> $settings['order_by'],
			'return_total_count'     	=> 1
		));
		if ( isset($_GET['search_results_sort_by']) ) {
			$args['search_results_sort_by'] = $_GET['search_results_sort_by'];
		} else {
			$args['search_results_sort_by'] = $args['sort'] . '_' . $args['sort_by'];
		}
		  
		if (isset($_GET['guests'])){
			$guests = array_map('absint', $_GET['guests']);
			$args['guests'] = array_sum($guests);
		}

		// sanitize args
		foreach ($args as $arg_key => $arg_value){
			$args[sanitize_title($arg_key)] = is_array($arg_value) ? array_map('absint', $arg_value) : sanitize_text_field($arg_value);
		}

		if( !isset($_GET['search_tab']) && isset(BABE_Search_From::$search_form_tabs['tour']['categories']) ){
			$args['categories'] = BABE_Search_From::$search_form_tabs['tour']['categories'];
		}

		///// categories
		if ( !empty(BABE_Search_From::$search_form_tabs) && is_array(BABE_Search_From::$search_form_tabs) && isset($_GET['search_tab']) && isset(BABE_Search_From::$search_form_tabs[$_GET['search_tab']]) ){
			$args['categories'] = BABE_Search_From::$search_form_tabs[$_GET['search_tab']]['categories'];
		}
		
		$args = apply_filters('babe_search_result_args', $args);

		$args = BABE_Post_types::search_filter_to_get_posts_args($args);

		$posts = BABE_Post_types::get_posts($args);
		$posts_pages = BABE_Post_types::$get_posts_pages;

		foreach($posts as $post){
			//customize by gavias
			ob_start();
			if($settings['layout'] == 'grid'){
				echo '<div class="item-columns">';
					include get_theme_file_path('templates/booking/block/item-' . $settings['style'] . '.php');
				echo '</div>';
			}
			if($settings['layout'] == 'list'){
				echo '<div class="item-list">';
					include get_theme_file_path('templates/booking/block/item-style-list.php');
				echo '</div>';
			}
			$output .= ob_get_clean();
		} /// end foreach $posts

		$results = array();
		if ($output){
			$results['output'] = $output;
			$results['sort_by_filter'] = $sort_by_filter = BABE_html::input_select_field_with_order('sr_sort_by', '', BABE_Post_types::get_search_filter_sort_by_args(), $args['search_results_sort_by']);
			$results['page']           = BABE_Functions::pager($posts_pages);
			$results['posts_count']    = BABE_Post_types::$get_posts_count;
		}
		//print BABE_html::input_select_field_with_order('sr_sort_by', '', BABE_Post_types::get_search_filter_sort_by_args(), 'title_desc');

		$output = apply_filters('babe_search_result_html', $output, $posts, $posts_pages);
		return $results;
	}
}

$widgets_manager->register(new GVAElement_BA_Search_Results());
