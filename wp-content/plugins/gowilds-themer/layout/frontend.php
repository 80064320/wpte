<?php
/*
  
   config_type: post, page, tour, product
*/
class GVA_Layout_Frontend extends GVA_Layout_Model{

   public static $instance;
   public static function getInstance() {
      if (!isset(self::$instance) && !(self::$instance instanceof GVA_Layout_Frontend)) {
         self::$instance = new GVA_Layout_Frontend();
      }
      return self::$instance;
   }


   //meta_key of config: template_page, post_single, archive ....
   public function template_default_active_id($layout_type = ''){
      global $post;
      
      $template_id = 0;

      //get template_id by type
      if( !empty($layout_type) ){
         $template_id = $this->get_template_default($layout_type);
         return $template_id;
      }
      
      //get template_id by post
      if($post && is_singular('gva__template') &&  $post->post_type == 'gva__template'){
         return $post->ID;
      }

      if($post && is_singular('page') && $post->post_type == 'page'){
         $template_id = $this->get_template_default('page_layout');
         return $template_id;
      }

      if(is_single()){
         $template_id = $this->get_template_default('layout_single_post');
         return $template_id;
      }

      if(is_archive()){
         $template_id = $this->get_template_default('layout_archive_post');
         return $template_id;
      }

      return $template_id;
   }

   public function get_template_active(){
      $template_id = $this->template_default_active_id();
      $results = array(
         'header_layout' => get_post_meta($template_id, 'header_layout', true),
         'footer_layout' => get_post_meta($template_id, 'footer_layout', true)
      );
      return $results;
   }

   public function element_display($id) {
      $content = '';
      if ($id){
         $content = \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $id );
      }
      return $content;
   }
  
}

new GVA_Layout_Frontend();