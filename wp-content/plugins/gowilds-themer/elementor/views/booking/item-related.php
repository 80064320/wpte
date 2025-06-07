<?php
   use Elementor\Icons_Manager;

   if (!defined('ABSPATH')){ exit; }

   global $gowilds_post;

   if (!$gowilds_post){ return; }

   if ($gowilds_post->post_type != BABE_Post_types::$booking_obj_post_type){ return;}

   $ba_post = BABE_Post_types::get_post($gowilds_post->ID);

   if( empty($ba_post) || !isset($ba_post['related_items']) ){return;}
   
   if( empty($ba_post['related_items']) ){return;}

   $related_arr = $ba_post['related_items'];

   $classes = array();
   $classes[] = 'ba-item-related-carousel swiper-slider-wrapper';
   $classes[] = $settings['space_between'] < 15 ? 'margin-disable': '';
   $this->add_render_attribute('wrapper-carousel', 'class', $classes);
?>

   <?php if (isset($related_arr) && !empty($related_arr)){ ?>
      <div class="gowilds-single-related">
         <div class="content-inner">
            <div <?php echo $this->get_render_attribute_string('wrapper-carousel'); ?>>
               <div class="swiper-content-inner">
                  <div class="init-carousel-swiper swiper" data-carousel="<?php echo $this->get_carousel_settings() ?>">
                     <div class="swiper-wrapper">
                        <?php
                           foreach ($related_arr as $related_post) {
                              $post = get_post( $related_post, ARRAY_A);
                              //$prices = BABE_Post_types::get_post_price_from($related_post);
                              //$post = array_merge($post, $prices);
                              echo '<div class="swiper-slide">';
                                 include get_theme_file_path('templates/booking/block/item-' . $settings['style'] . '.php');
                              echo '</div>'; 
                           }
                        ?>
                     </div>
                  </div>      
               </div>
               <?php echo ($settings['ca_pagination'] ? '<div class="swiper-pagination"></div>' : '' ); ?>
               <?php echo ($settings['ca_navigation'] ? '<div class="swiper-nav-next"></div><div class="swiper-nav-prev"></div>' : '' ); ?>   
            </div>   
         </div>
      </div>
   <?php } ?>   

