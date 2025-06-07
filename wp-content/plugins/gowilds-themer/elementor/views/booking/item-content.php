<?php
   use Elementor\Icons_Manager;

   if (!defined('ABSPATH')){ exit; }

   global $gowilds_post;

   if (!$gowilds_post){ return; }

   if ($gowilds_post->post_type != BABE_Post_types::$booking_obj_post_type){ return;}
?>

<div class="gowilds-single-content">
   <?php
      echo apply_filters('the_content', $gowilds_post->post_content);
   ?>
</div>

