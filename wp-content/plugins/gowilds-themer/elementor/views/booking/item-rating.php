<?php
   use Elementor\Icons_Manager;

   if (!defined('ABSPATH')){ exit; }

   global $gowilds_post;

   if (!$gowilds_post){ return; }

   if ($gowilds_post->post_type != BABE_Post_types::$booking_obj_post_type){ return;}

?>

<div class="gowilds-single-rating">
   <div class="box-content">
      <?php echo BABE_Rating::post_stars_rendering($gowilds_post->ID); ?>
   </div>
</div>

