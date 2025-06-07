<?php
   if (!defined('ABSPATH')) {
      exit; 
   }
   global $gowilds_post;

   $post_id = 0;
   if($gowilds_post){
      $post_id = $gowilds_post->ID;
   }

   $classes = array();
   $styles = array();
   $styles_overlay = '';
   //Breadcrumb by post
   if(get_post_meta($post_id, 'gowilds_breadcrumb_layout', true) == 'page_options'){
      $breadcrumb_disable = get_post_meta($post_id, 'gowilds_no_breadcrumbs', true);

      //Breacrumb Image Color
      $breadcrumb_bg_color = get_post_meta($post_id, 'gowilds_breacrumb_bg_color', true);
      $breadcrumb_bg_color_opacity = get_post_meta($post_id, 'gowilds_breacrumb_bg_opacity', true);
      $rgba_color = $this->convert_hextorgb($breadcrumb_bg_color);
      if($breadcrumb_bg_color_opacity){
         $styles_overlay = 'background-color: rgba(' . esc_attr($rgba_color['r']) . ',' . esc_attr($rgba_color['g']) . ',' . esc_attr($rgba_color['b']) . ', ' . ($breadcrumb_bg_color_opacity/100) . ')';
      }
      // Breadcrumb Image
      $breadcrumb_image_page = get_post_meta($post_id, 'gowilds_gowilds_breacrumb_image', true);
      if(is_numeric($breadcrumb_image_page)){
         $breadcrumb_image_tmp = wp_get_attachment_image_src( $breadcrumb_image_page, 'full');
         if(isset($breadcrumb_image_tmp[0])){
            $breadcrumb_image_url = $breadcrumb_image_tmp[0];
         }
      }else{
         $breadcrumb_image_url = $breadcrumb_image_page;
      }
      if($breadcrumb_image_url){
         $styles[] = 'background-image: url(\'' . $breadcrumb_image_url . '\')';
      }
   }

   $title = get_the_title();
   if(is_archive()) $title = single_cat_title('', false);
   if(class_exists('WooCommerce') && is_shop()){
      $title = woocommerce_page_title(false);
   }

   if(is_search()){
      $title = esc_html__('Search', 'zilom');
   }

   if( empty($title) && is_archive() ){
      $title = get_the_archive_title();
   }

   // Classes
   //$classes[] = $breadcrumb_text_align;

   $css = '';
   if(count($styles) > 0){
      $css= 'style="' . implode(';', $styles) . '"';
   }
   $align = !empty($settings['align']) ? ' align-' . $settings['align'] : '';
?>
   
<div class="post-breadcrumb">
   <div class="custom-breadcrumb <?php echo implode(' ', $classes); ?>" <?php echo $css; ?>>
      <?php if( $styles_overlay || !empty($settings['bg_overlay_color']) ){ ?>
         <div class="breadcrumb-overlay" style="<?php echo esc_attr($styles_overlay); ?>"></div>
      <?php } ?>
      <div class="breadcrumb-main">
        <div class="container">
          <div class="breadcrumb-container-inner<?php echo esc_attr($align) ?>">
            <?php 
               if($title && $settings['show_title'] == 'yes'){ 
                 echo '<h2 class="heading-title">' . html_entity_decode($title) . '</h2>';
               } 
               if($settings['show_links']){
                  $this->breadcrumbs(); 
               }
            ?>
          </div>  
        </div>   
      </div>  
   </div>
</div>      

