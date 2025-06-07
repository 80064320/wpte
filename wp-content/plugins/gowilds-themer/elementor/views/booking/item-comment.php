<?php
   use Elementor\Icons_Manager;

   if(!defined('ABSPATH')){ exit; }

   global $gowilds_post, $post;
   
   if(!$gowilds_post){ return; }

   if($gowilds_post->post_type != BABE_Post_types::$booking_obj_post_type){ return; }

   $post = $gowilds_post;
?>

<div class="gowilds-single-comment">
   <?php
      if(comments_open($gowilds_post->ID) || get_comments_number($gowilds_post->ID)) {
         echo '<div class="listing-comment">';
            comments_template();
         echo '</div>';   
      }
   ?>
   <div class="avg-total-tmp hidden">
      <div class="content-inner">
         <span class="value">5.00</span>
         <span class="avg-title"><?php echo esc_html__('Average Rating', 'gowilds-themer') ?></span>
      </div>   
   </div>
</div>

