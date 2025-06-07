<?php
   if (!defined('ABSPATH')){ exit; }

   global $gowilds_post, $post;
   if( !$gowilds_post ){ return; }
   if( $gowilds_post->post_type != 'product' ){ return; }

   $this->add_render_attribute('block', 'class', [ 'product-item-excerpt' ]);
?>

<div <?php echo $this->get_render_attribute_string( 'block' ) ?>>
   <div itemprop="description">
      <?php echo apply_filters( 'woocommerce_short_description', $gowilds_post->post_excerpt ) ?>
   </div>
</div>
