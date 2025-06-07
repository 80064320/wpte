<?php
   use Elementor\Icons_Manager;

   if (!defined('ABSPATH')){ exit; }

   global $gowilds_post;

   if (!$gowilds_post){ return; }

   if ($gowilds_post->post_type != BABE_Post_types::$booking_obj_post_type){ return;}

   $ba_post = BABE_Post_types::get_post($gowilds_post->ID);

   $has_icon = ! empty( $settings['selected_icon']['value']);

   $min_age = isset($ba_post['gowilds_booking_min_age']) ? $ba_post['gowilds_booking_min_age'] : false;

?>

   <div class="gowilds-single-min_age">
      <div class="content-inner">
         <div class="icon">
            <?php if ($has_icon){ ?>
               <?php Icons_Manager::render_icon($settings['selected_icon'], ['aria-hidden' => 'true']); ?>
            <?php } ?>
         </div>
         <div class="box-content">
            <?php 
               if($settings['title_text']){ 
                  echo '<h4 class="ba-meta-title">' . esc_html($settings['title_text']) . '</h4>';
               }
               if($min_age){
                  echo '<div class="item-value">' . esc_html($min_age) . '</div>';
               }
            ?>
         </div>
      </div>
   </div>

