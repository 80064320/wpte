<?php
class Gavias_Themer_To_Book{

   public function __construct(){ 
      $gowilds_register_taxonomy = get_option('gowilds_register_taxonomy', 'enable');
      if($gowilds_register_taxonomy == 'enable'){
         add_action('init', array($this, 'register_locations'));
         add_action('init', array($this, 'register_type'));
         add_action('init', array($this, 'register_amenities'));
         add_action('init', array($this, 'register_language'));
      }
   }

   public function register_locations(){
      $slug = BABE_Post_types::$attr_tax_pref . 'location';
      $name = esc_html__('Booking Locations', 'gowilds-themer');

      if(!taxonomy_exists($slug)){
         $inserted_term = wp_insert_term($name,   
            BABE_Post_types::$taxonomies_list_tax, 
            array(
               'description' => $name,
               'slug'        => 'location'
            )
         );

         if (!is_wp_error($inserted_term)){
            BABE_Post_types::init_taxonomies_list();
            update_term_meta($inserted_term['term_id'], 'gmap_active', 0);
            update_term_meta($inserted_term['term_id'], 'select_mode', 'multi_checkbox');
            update_term_meta($inserted_term['term_id'], 'frontend_style', 'col_3');
         }
      }
   }

   public function register_type(){
      $slug = BABE_Post_types::$attr_tax_pref . 'type';
      $name = esc_html__('Booking Type', 'gowilds-themer');

      if(!taxonomy_exists($slug)){
         $inserted_term = wp_insert_term($name,   
            BABE_Post_types::$taxonomies_list_tax, 
            array(
               'description' => $name,
               'slug'        => 'type'
            )
         );

         if (!is_wp_error($inserted_term)){
            BABE_Post_types::init_taxonomies_list();
            update_term_meta($inserted_term['term_id'], 'gmap_active', 0);
            update_term_meta($inserted_term['term_id'], 'select_mode', 'multi_checkbox');
            update_term_meta($inserted_term['term_id'], 'frontend_style', 'col_3');
         }
      }
   }

   public function register_amenities(){
     $slug = BABE_Post_types::$attr_tax_pref . 'amenities';
     $name = esc_html__('Amenities', 'gowilds-themer');

     if(!taxonomy_exists($slug)){
         $inserted_term = wp_insert_term($name,   
            BABE_Post_types::$taxonomies_list_tax, 
            array(
               'description' => $name,
               'slug'        => 'amenities'
            )
         );

         if (!is_wp_error($inserted_term)){
            BABE_Post_types::init_taxonomies_list();
            update_term_meta($inserted_term['term_id'], 'gmap_active', 0);
            update_term_meta($inserted_term['term_id'], 'select_mode', 'multi_checkbox');
            update_term_meta($inserted_term['term_id'], 'frontend_style', 'col_3');
         }
      }
   }

   public function register_language(){
     $slug = BABE_Post_types::$attr_tax_pref . 'languages';
     $name = esc_html__('Languages', 'gowilds-themer');

     if(!taxonomy_exists($slug)){
         $inserted_term = wp_insert_term($name,   
            BABE_Post_types::$taxonomies_list_tax, 
            array(
               'description' => $name,
               'slug'        => 'language'
            )
         );

         if (!is_wp_error($inserted_term)){
            BABE_Post_types::init_taxonomies_list();
            update_term_meta($inserted_term['term_id'], 'gmap_active', 0);
            update_term_meta($inserted_term['term_id'], 'select_mode', 'multi_checkbox');
            update_term_meta($inserted_term['term_id'], 'frontend_style', 'col_3');
         }
      }
   }
}

new Gavias_Themer_To_Book();
