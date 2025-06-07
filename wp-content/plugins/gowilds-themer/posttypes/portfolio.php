<?php
if(!function_exists('gavias_post_type_portfolio')){
	function gavias_post_type_portfolio(){
		$labels = array(
			'name'               => __( 'Portfolios', "gaviasthemer" ),
			'singular_name'      => __( 'Portfolio', "gaviasthemer" ),
			'add_new'            => __( 'Add New Portfolio', "gaviasthemer" ),
			'add_new_item'       => __( 'Add New Portfolio', "gaviasthemer" ),
			'edit_item'          => __( 'Edit Portfolio', "gaviasthemer" ),
			'new_item'           => __( 'New Portfolio', "gaviasthemer" ),
			'view_item'          => __( 'View Portfolio', "gaviasthemer" ),
			'search_items'       => __( 'Search Portfolios', "gaviasthemer" ),
			'not_found'          => __( 'No Portfolios found', "gaviasthemer" ),
			'not_found_in_trash' => __( 'No Portfolios found in Trash', "gaviasthemer" ),
			'parent_item_colon'  => __( 'Parent Portfolio:', "gaviasthemer" ),
			'menu_name'          => __( 'Portfolios', "gaviasthemer" ),
		);

		$args = array(
			'labels'              => $labels,
			'hierarchical'        => true,
			'description'         => 'List Portfolio',
			'supports'            => array( 'title', 'editor', 'author', 'thumbnail','excerpt', 'post-formats'  ), 
			'taxonomies'          => array( 'portfolio_category','post_tag' ),
			'post-formats'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 5,
			'show_in_nav_menus'   => true,
			'publicly_queryable'  => true,
			'exclude_from_search' => false,
			'has_archive'         => true,
			'query_var'           => true,
			'can_export'          => true,
			'rewrite'             => array(
				'slug'  => 'case'
			),
			'capability_type'     => 'post'
		);

		$slug = apply_filters('gavias-post-type/slug-portfolio', '');
		if($slug){
		  $args['rewrite']['slug'] = $slug;
		}
		register_post_type( 'portfolio', $args );

		$labels = array(
		  'name'              => __( 'Categories', "gaviasthemer" ),
		  'singular_name'     => __( 'Category', "gaviasthemer" ),
		  'search_items'      => __( 'Search Category', "gaviasthemer" ),
		  'all_items'         => __( 'All Categories', "gaviasthemer" ),
		  'parent_item'       => __( 'Parent Category', "gaviasthemer" ),
		  'parent_item_colon' => __( 'Parent Category:', "gaviasthemer" ),
		  'edit_item'         => __( 'Edit Category', "gaviasthemer" ),
		  'update_item'       => __( 'Update Category', "gaviasthemer" ),
		  'add_new_item'      => __( 'Add New Category', "gaviasthemer" ),
		  'new_item_name'     => __( 'New Category Name', "gaviasthemer" ),
		  'menu_name'         => __( 'Categories', "gaviasthemer" ),
		);
		// Now register the taxonomy
		register_taxonomy('category_portfolio',array('portfolio'),
			array(
			  	'hierarchical'      => true,
			  	'labels'            => $labels,
			  	'show_ui'           => true,
			  	'show_admin_column' => true,
			  	'query_var'         => true,
			  	'show_in_nav_menus' => false,
			  	'rewrite'           => array( 'slug' => 'category-portfolio'
			),
		));
  	}
  add_action( 'init','gavias_post_type_portfolio' );

  	add_action( 'init', 'gavias_portfolio_remove_post_type_support', 10 );
  	function gavias_portfolio_remove_post_type_support() {
	 	remove_post_type_support( 'portfolio', 'post-formats' );
  	}
}

function gaviasthemer_portfolio_query( $args ){
 	$ds = array(
		'post_type'   => 'portfolio',
		'posts_per_page'  =>  12
 	);
 	$args = array_merge( $ds , $args );
 	$loop = new WP_Query($args);
 	return $loop;
	}

function gaviasthemer_profolio_terms(){
 	return get_terms( 'category_portfolio', array('orderby'=>'id') );
}

