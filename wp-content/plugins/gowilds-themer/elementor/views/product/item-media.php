<?php
	if (!defined('ABSPATH')){ exit; }
	$_rand = wp_rand(6);
	
	global $gowilds_post, $post, $product;
	
	if( !$gowilds_post ){ return; }
	if( $gowilds_post->post_type != 'product' ){ return; }
	$post_id = $gowilds_post->ID;
?>
<div class="product-item-media style-default">
	<?php
		if(\Elementor\Plugin::$instance->editor->is_edit_mode() || $post->post_type == 'gva__template'){
			$product = wc_get_product($post_id);
			if ($product->get_image_id()){
				$thumbnail_id = $product->get_image_id();
				if(function_exists('wc_get_gallery_image_html' )){
            	$html_thumbnail = wc_get_gallery_image_html($thumbnail_id, true);
         		echo '<div class="product-image-preview">';
         		echo $html_thumbnail;
         		echo '<div class="product-thumbnail">';
	         		$attachment_ids = $product->get_gallery_image_ids();
	               if($attachment_ids && $product->get_image_id()){
	               	echo $html_thumbnail;
	               	$i = 0;
	                  foreach($attachment_ids as $attachment_id){
	                  	$i++;
	                  	if($i < 4){
	                     	echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', wc_get_gallery_image_html( $attachment_id ), $attachment_id ); 
	                  	}
	                  }
	               }
	            echo '</div>';   
         		echo'</div>';
            }
         }
		}else{
			if(empty($product)){ return; }
			echo '<div class="image_frame scale-with-grid">';
				do_action( 'woocommerce_before_single_product_summary' );
			echo '</div>';
		}
	?>
</div>
