<?php
class GVA_Layout_Model{

   public $post_type = 'gva__template';
   public $meta_key = 'gva_template_type';

   public static $instance;
   public static function getInstance() {
      if (!isset(self::$instance) && !(self::$instance instanceof GVA_Layout_Model)) {
         self::$instance = new GVA_Layout_Model();
      }
      return self::$instance;
   }


   public function get_templates($template_type = 'page_layout'){
      $query = new WP_Query([
         'post_type'          => $this->post_type,
         'posts_per_page'     => 100,
         'numberposts'        => 100,
         'post_status'        => 'publish',
         'orderby'            => 'ID',
         'order'              => 'asc',
         'meta_query' => array(
            array(
               'key'       => $this->meta_key,
               'value'     => $template_type,
               'compare'   => '='
            )
         )
      ]);
      $templates = array();
       foreach ($query->posts as $post) {
         $templates[] = array(
            'id'     => $post->ID,
            'title'  => $post->post_title
         );
      }
      wp_reset_postdata();
      return $templates;
   }

   public function set_state_default($type = 'page_layout', $id = 0){
      $templates = $this->get_templates($type);
      foreach ($templates as $template){
         update_post_meta( $template['id'], '_gva_set_default', 'disabled');
      }
      if($id){
         update_post_meta( $id, '_gva_set_default', 'enabled');
      }
   }


   public function get_template_default($template_type = 'page_layout'){
      $template_id = 0;
      $query = new WP_Query([
         'post_type'          => $this->post_type,
         'posts_per_page'     => 1,
         'numberposts'        => 1,
         'post_status'        => 'publish',
         'orderby'            => 'ID',
         'order'              => 'desc',
         'meta_query' => array(
            'relation' => 'AND',
            array(
               'key'       => $this->meta_key,
               'value'     => $template_type,
               'compare'   => '='
            ),
            array(
               'key'       => '_gva_set_default',
               'value'     => 'enabled',
               'compare'   => '='
            )
         )
      ]);
      foreach ($query->posts as $post) {
         if($post->ID > 0){
            $template_id = $post->ID;
            break;
         }
      }
      wp_reset_postdata();
      return $template_id;
   }
}
