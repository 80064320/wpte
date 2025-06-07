<?php
class Gowilds_Booking_Hook{
   function __construct(){
      add_filter('babe_shortcode_all_items_item_html', array($this, 'shortcode_all_items_item_html'), 10, 3);
      add_filter('babe_shortcode_all_items_html', array($this, 'shortcode_all_items_html'), 10, 3);
      add_filter('babe_price_trim_zeros', array($this, 'babe_price_trim_zeros'), 10, 3);
      add_filter('babe_search_result_html', array($this, 'remove_babe_search_result_html'), 10, 3);
       
      add_filter('babe_myaccount_validate_role', array($this, 'role_author'), 1, 2 );

      add_filter('babe_pager_args', array($this, 'babe_pager_args'));

      add_filter('babe_shortcode_all_items_post_args', array($this, 'babe_shortcode_all_items_post_args'));

      add_filter('babe_search_form_fields_order', array($this, 'babe_search_order'), 10, 1);

   }

   public function role_author($check_role, $user_info){
      if(empty($check_role)){
         $check_role = in_array('user', $user_info->roles) || in_array('administrator', $user_info->roles) ? 'customer' : '';
      }
      return $check_role;
   }

   public function shortcode_all_items_item_html($content, $post, $babe_post){
      ob_start();
      include get_theme_file_path('templates/booking/block/item-style-1.php');
      return ob_get_clean();
   }

   public function shortcode_all_items_html($output, $args, $post_args){
      $classes = $args['classes'] ? $args['classes'] : '';
      $output  = '
         <div class="babe_shortcode_block sc_all_items ' . $classes . '">
            <div class="babe_shortcode_block_bg_inner">
               <div class="babe_shortcode_block_inner">
                  ' . BABE_shortcodes::get_posts_tile_view($post_args) . '
               </div>
            </div>
         </div>
      ';
      return $output;
   }

   public function babe_price_trim_zeros(){
      return false;
   }

   public function remove_babe_search_result_html($output, $posts, $posts_pages){
      return '';
   }

   public function babe_pager_args($args){
      if(is_front_page()){
         $page = (get_query_var('page')) ? get_query_var('page') : 1;
      }else{
         $page = (get_query_var('paged')) ? get_query_var('paged') : 1;
      }
      $args['current']  = max(1, $page);
      return $args;
   }

   public function babe_shortcode_all_items_post_args($args){
     if(is_front_page()){
         $page = (get_query_var('page')) ? get_query_var('page') : 1;
      }else{
         $page = (get_query_var('paged')) ? get_query_var('paged') : 1;
      }
      $args['paged']  =  $page;
      return $args;
   }

   public function babe_search_order($fields){
      $fields['keyword'] = 1;
      $fields['ba_location'] = 2;
      $fields['ba_type'] = 3;
      $fields['date_from'] = 4;
      $fields['date_to'] = 5;
      $fields['guests'] = 6;
      $fields['ba_languages'] = 7;
      $fields['ba_amenities'] = 8;
      asort($fields);
      return $fields;
   }

}

return new Gowilds_Booking_Hook();

