<?php
   if (!defined('ABSPATH')){ exit; }

   global $gowilds_post, $post;
   if( !$gowilds_post ){ return; }
   if( $gowilds_post->post_type != 'product' ){ return; }
   $post_id = $gowilds_post->ID;
   
   $this->add_render_attribute('block', 'class', [ 'product-item-add-to-cart' ]);

?>

<div <?php echo $this->get_render_attribute_string( 'block' ) ?>>
   <?php 
      if(\Elementor\Plugin::$instance->editor->is_edit_mode() || $post->post_type == 'gva__template'){
         global $product;
         $product = wc_get_product($post_id);
         echo '<form class="add-cart" action="" method="post" enctype="multipart/form-data">';
            echo '<div class="quantity">';
               echo '<input type="number" step="1" min="1" name="quantity" value="1" title="" class="input-text qty text" size="4">';
            echo '</div>';
            echo '<button type="submit" name="add-to-cart" value="531" class="single_add_to_cart_button button alt">Add to cart</button>';
         echo '</form>';
      }else{
         woocommerce_template_single_add_to_cart();
      }
   ?>
</div>