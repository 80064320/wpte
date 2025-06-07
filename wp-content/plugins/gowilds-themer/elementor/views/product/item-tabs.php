<?php
	if (!defined('ABSPATH')){ exit; }

	global $post, $product, $gowilds_post;
	if( !$gowilds_post ){ return; }
	if( $gowilds_post->post_type != 'product' ){ return; }
	$post_id = $gowilds_post->ID;

	$this->add_render_attribute('block', 'class', [ 'product-item-tabs' ]);

?>
<div <?php echo $this->get_render_attribute_string( 'block' ) ?>>
	<?php if(\Elementor\Plugin::$instance->editor->is_edit_mode() || $post->post_type == 'gva__template'){ ?>
		<div class="woocommerce-tabs clearfix tabs-left">
			<div class="woocommerce-tabs-inner clear fix">
				<div class="woocommerce-tab-product-nav">
					<ul class="woocommerce-tab-product-info nav nav-tabs default clear-list">
						<li class="description_tab">
							<a class="active" data-bs-toggle="tab" href="#tab-description">Description</a>
						</li>
						<li class="reviews_tab">
							<a class="" data-bs-toggle="tab" href="#tab-reviews">Reviews (0)</a>
						</li>
					</ul>
				</div>
				<div class="tab-content col-xs-12">
					<div class="tab-pane active" id="tab-description">
						<?php echo $gowilds_post->post_content ?>
					</div>
				</div>
			</div>	
		</div>
	<?php }else{
		setup_postdata( $product->get_id() );
      wc_get_template( 'single-product/tabs/tabs.php' );
	} ?>	
</div>