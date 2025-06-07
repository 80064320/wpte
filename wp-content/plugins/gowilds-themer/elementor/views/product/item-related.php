<?php
   if (!defined('ABSPATH')){ exit; }

   global $gowilds_post, $post, $product;
   if( !$gowilds_post ){ return; }
   if( $gowilds_post->post_type != 'product' ){ return; }
   $post_id = $gowilds_post->ID;
   $product = wc_get_product($post_id);
   $this->add_render_attribute('block', 'class', [ 'product-item-related' ]);
?>

<div <?php echo $this->get_render_attribute_string( 'block' ) ?>>
   <?php 
      if(\Elementor\Plugin::$instance->editor->is_edit_mode() || $post->post_type == 'gva__template'){
         ob_start();
         $args = [
            'posts_per_page' => 4,
            'orderby' => $settings['orderby'],
            'order' => $settings['order'],
         ];
         if( ! empty( $settings['posts_per_page'] ) ){
            $args['posts_per_page'] = $settings['posts_per_page'];
         }
         if( ! empty( $settings['columns'] ) ){
            $args['columns'] = $settings['columns'];
         }

         $args['related_products'] = array_filter( array_map( 'wc_get_product', wc_get_related_products( $product->get_id(), 
         $args['posts_per_page'], $product->get_upsell_ids() ) ), 'wc_products_array_filter_visible' );

         $args['related_products'] = wc_products_array_orderby( $args['related_products'], $args['orderby'], $args['order'] );

         if( wc_get_related_products( $product->get_id(), $args['posts_per_page'], $product->get_upsell_ids() ) ){
            wc_get_template( 'single-product/related.php', $args );
         }else{
            echo '<p>'.esc_html__('No related products are available.','gowilds-themer').'</p>';
         }
         $html = ob_get_clean();
         echo $html;
      }else{
         $args = [
            'posts_per_page' => 4,
            'columns' => 4,
            'orderby' => $settings['orderby'],
            'order' => $settings['order'],
         ];
         if ( ! empty( $settings['posts_per_page'] ) ) {
             $args['posts_per_page'] = $settings['posts_per_page'];
         }
         if ( ! empty( $settings['columns'] ) ) {
             $args['columns'] = $settings['columns'];
         }

         // Get related Product
         $args['related_products'] = array_filter( array_map( 'wc_get_product', wc_get_related_products( $product->get_id(), 
         $args['posts_per_page'], $product->get_upsell_ids() ) ), 'wc_products_array_filter_visible' );
         $args['related_products'] = wc_products_array_orderby( $args['related_products'], $args['orderby'], $args['order'] );

         wc_get_template( 'single-product/related.php', $args );
      }
   ?>
</div>