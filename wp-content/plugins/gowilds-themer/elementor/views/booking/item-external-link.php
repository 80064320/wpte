<?php
   if (!defined('ABSPATH')){ exit; }

   global $gowilds_post;

   if (!$gowilds_post){ return; }

   if ($gowilds_post->post_type != BABE_Post_types::$booking_obj_post_type){ return;}

   $ba_post = BABE_Post_types::get_post($gowilds_post->ID);
   $title = $settings['title_text'];
   $button_link = isset($ba_post['external_link']) ? $ba_post['external_link'] : false;
   $button_label = $settings['link_title'];
   $desc = isset($ba_post['external_link_desc']) ? $ba_post['external_link_desc'] : false;
?>

<div class="gowilds-external-link gowilds-single-booking-form style-1">
   <?php 
      if($title){
         echo '<h3 class="box-title">' . $title . '</h3>';
      }
 
      echo '<div class="box-content">';
      if($desc){
         echo '<div class="box-description">';
            echo $desc;
         echo '</div>';
      }

      if($button_link){
         echo '<div class="box-external-link">';
            echo '<a class="btn-theme" target="_blank" href="' . esc_url($button_link) . '" ><i class="fas fa-shopping-cart"></i>' . $button_label . '</a>';
         echo '</div>';
      }
   ?>
   </div>
</div>

