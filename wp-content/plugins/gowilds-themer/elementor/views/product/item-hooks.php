<?php
   if (!defined('ABSPATH')){ exit; }

   global $gowilds_post, $post, $gowilds_template_type;
   if( !$gowilds_post ){ return; }
   if( $gowilds_post->post_type != 'product' ){ return; }
   $hook_name = $settings['hook_name'];
   $post_id = $gowilds_post->ID;
   $this->add_render_attribute('block', 'class', [ 'product-item-hook' ]);
?>

<?php if(\Elementor\Plugin::$instance->editor->is_edit_mode() || $gowilds_template_type == 'gva__template'){ ?>
   <div class="woocommerce-notices-wrapper">
      <div class="alert alert-info">
         <div class="alert_wrapper"><?php echo $hook_name; ?></div>
      </div>
   </div>   
<?php } ?>

<div <?php echo $this->get_render_attribute_string( 'block' ) ?>>
   <?php do_action($hook_name); ?>
</div>
