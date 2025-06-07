<?php
   global $wp_query;
   $this->add_render_attribute('wrapper', 'class', ['clearfix woo-product-archive']);
   $this->get_grid_settings();

   $style = $settings['style'];
?>

<div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
   <div class="gva-content-items"> 

      <?php if ( have_posts() ) : ?>
         <div class="shop-loop-container">
            <div class="gvawooaf-before-products layout-grid">
               
               <div class="woocommerce-filter clearfix">
                  <?php do_action( 'woocommerce_before_shop_loop' ); ?>
               </div> 

               <?php do_action('gowilds_woocommerce_active_filter' );  ?>
               
               <div <?php echo $this->get_render_attribute_string('grid') ?>>
                  <?php 
                     while ( have_posts() ) : the_post();
                        echo '<div class="item-columns">';
                           wc_get_template_part('content', 'product');
                        echo '</div>';
                     endwhile; 
                  ?>
               </div>   
                     
               <?php do_action( 'woocommerce_after_shop_loop' ); ?> 
            </div>
         </div>
      <?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>
         <?php wc_get_template( 'loop/no-products-found.php' ); ?>
      <?php endif; ?>

   </div>

   <div class="pagination">
      <?php echo $this->pagination($wp_query); ?>
   </div>
</div>
