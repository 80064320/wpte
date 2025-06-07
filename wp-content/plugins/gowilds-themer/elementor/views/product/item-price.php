<?php
	if (!defined('ABSPATH')){ exit; }

	global $gowilds_post, $post;
	if( !$gowilds_post ){ return; }
	if( $gowilds_post->post_type != 'product' ){ return; }
   $post_id = $gowilds_post->ID;
	if(\Elementor\Plugin::$instance->editor->is_edit_mode() || $post->post_type == 'gva__template'){
      global $product;
      $product = wc_get_product($post_id);
   }
?>

<div class="product-item-price">
	<?php woocommerce_template_single_price() ?>
</div>