<?php
   use Elementor\Icons_Manager;

   if (!defined('ABSPATH')){ exit; }

   global $gowilds_post;

   if (!$gowilds_post){ return; }

   if ($gowilds_post->post_type != BABE_Post_types::$booking_obj_post_type){ return;}

   $ba_post = BABE_Post_types::get_post($gowilds_post->ID);

   $has_icon = ! empty( $settings['selected_icon']['value']);

   $max_guests = isset($ba_post['guests']) ? $ba_post['guests'] : false;

?>

   <div class="gowilds-single-max_guests">
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
               if($max_guests){
                  echo '<div class="item-value">' . esc_html($max_guests) . '</div>';
               }
            ?>
         </div>
      </div>
   </div>

