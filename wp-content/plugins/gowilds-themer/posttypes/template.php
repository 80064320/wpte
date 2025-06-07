<?php
class Gavias_Themer_Template{
	public static $post_type = 'gva__template';
  
	public static $instance;

	public static function getInstance() {
		if (!isset(self::$instance) && !(self::$instance instanceof Gavias_Themer_Template)) {
			self::$instance = new Gavias_Themer_Template();
		}
		return self::$instance;
	}

	public function __construct(){ 
		add_action('pre_get_posts', array($this, 'remove_post_type_from_search_results'));
	} 

	public function register_post_type_template(){
		add_action('init', array($this, 'args_post_type_template'), 10);
	}

	public function args_post_type_template(){
		$labels = array(
			'name'               => esc_html__( 'Template', 'gowilds-themer' ),
			'singular_name'      => esc_html__( 'Template', 'gowilds-themer' ),
			'add_new'            => esc_html__( 'Add Template', 'gowilds-themer' ),
			'add_new_item'       => esc_html__( 'Add Template', 'gowilds-themer' ),
			'edit_item'          => esc_html__( 'Edit Template', 'gowilds-themer' ),
			'new_item'           => esc_html__( 'New Template', 'gowilds-themer' ),
			'view_item'          => esc_html__( 'View Template', 'gowilds-themer' ),
			'search_items'       => esc_html__( 'Search Template Profiles', 'gowilds-themer' ),
			'not_found'          => esc_html__( 'No Template Profiles found', 'gowilds-themer' ),
			'not_found_in_trash' => esc_html__( 'No Template Profiles found in Trash', 'gowilds-themer' ),
			'parent_item_colon'  => esc_html__( 'Parent Template:', 'gowilds-themer' ),
			'menu_name'          => esc_html__( 'Templates & Layout', 'gowilds-themer' ),
		);

		$args = array(
		  'labels'              => $labels,
		  'hierarchical'        => false,
		  'description'         => __('List Template', "gaviasthemer"),
		  'public'              => true,
		  'show_ui'             => false,
		  'show_in_menu'        => false,
		  'menu_position'       => 3,
		  'show_in_nav_menus'   => false,
		  'publicly_queryable'  => true,
		  'exclude_from_search' => false, // to need
		  'has_archive'         => false, 
		  'query_var'           => true,
		  'can_export'          => true,
		  'rewrite'             => array( 'slug' => 'gva_template' ),
		  'capability_type'     => 'post'
		);
		register_post_type( self::$post_type, $args );
	}

	function remove_post_type_from_search_results($query){
    	if(is_admin() || !$query->is_main_query()) return;
    	if($query->is_search()){
        	$post_type_to_remove = 'gva__template';
        	$searchable_post_types = get_post_types(array('exclude_from_search' => false));
        	if(is_array($searchable_post_types) && in_array($post_type_to_remove, $searchable_post_types)){
            unset( $searchable_post_types[ $post_type_to_remove ] );
            $query->set('post_type', $searchable_post_types);
        	}
    	}
	}
}


Gavias_Themer_Template::getInstance()->register_post_type_template();