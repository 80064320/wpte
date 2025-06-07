<?php
   if (!defined('ABSPATH')){ exit; }

   global $gowilds_post;

   $rand = wp_rand(6);

   if (!$gowilds_post){ return; }

   if ($gowilds_post->post_type != BABE_Post_types::$booking_obj_post_type){ return;}

   $post_id = $gowilds_post->ID;

   $ba_post = BABE_Post_types::get_post($gowilds_post->ID);

   $images = isset($ba_post['images']) ? $ba_post['images'] : array();

   $video = isset($ba_post['gowilds_booking_video']) ? $ba_post['gowilds_booking_video'] : false;

   $classes = array();
   $classes[] = 'swiper-slider-wrapper';
   $classes[] = $settings['space_between'] < 15 ? 'margin-disable': '';
   $this->add_render_attribute('wrapper', 'class', $classes);

   $style = $style_class = $settings['style'];
   $style_class = ($style == 'style-3' ? 'style-1 style-3' : $style_class);
?>

<div class="gowilds-ba-single-gallery <?php echo esc_attr($style_class) ?>">
   
   <?php if($style == 'style-1' || $style == 'style-2' ){ ?>
      <div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
         <div class="swiper-content-inner">
            <div class="init-carousel-swiper swiper swiper-3d" data-carousel="<?php echo $this->get_carousel_settings() ?>">
               <div class="swiper-wrapper">
                  <?php 
                  if(isset($images) && $images){ 
                     foreach ($images as $key => $image){ ?>
                        <div class="swiper-slide">
                           <?php echo wp_get_attachment_image($image['image_id'], $settings['image_size']); ?>
                        </div>
                     <?php }
                  } ?>
               </div>
            </div>
         </div>  
         <?php echo ($settings['ca_pagination'] ? '<div class="swiper-pagination"></div>' : '' ); ?>
         <?php echo ($settings['ca_navigation'] ? '<div class="swiper-nav-next"></div><div class="swiper-nav-prev"></div>' : '' ); ?> 
      </div>
   <?php } ?>   

   <?php if($style == 'style-3'){ 
      $image_url = get_the_post_thumbnail_url($post_id, 'full');
      echo ('<div class="background-image" style="background-image:url(' . esc_url($image_url) . ')">');

      echo '</div>';
   } ?>   

   <?php if($settings['show_media'] == 'yes' && ($video || $images)){ ?>
      <div class="ba-media">
         <?php if($images){
            $i = 1;
            foreach($images as $image){ 
               $classes = ($i>1) ? 'hidden' : 'ba-gallery';
               if( isset(wp_get_attachment_image_src($image['image_id'], 'full')[0]) ){ ?>
                  <a class="<?php echo esc_attr($classes) ?>" href="<?php echo esc_url(wp_get_attachment_image_src($image['image_id'], 'full')[0]) ?>" data-elementor-lightbox-slideshow="<?php echo $rand ?>">
                     <?php 
                        if($i == 1){
                           echo '<i class="las la-camera"></i>';
                           echo '<span>' . count($images) . '</span>';
                        }
                     ?>
                  </a>
               <?php }  
               $i = $i + 1;
            }
         } ?>

         <?php if($video){ ?>
            <a class="ba-video popup-video" href="<?php echo esc_url($video) ?>"><i class="las la-video"></i></a>
         <?php } ?>
      </div>
   <?php } ?>
</div>