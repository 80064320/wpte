<?php
   use Elementor\Icons_Manager;

   if (!defined('ABSPATH')){ exit; }

   global $gowilds_post;

   if (!$gowilds_post){ return; }

   if ($gowilds_post->post_type != BABE_Post_types::$booking_obj_post_type){ return;}

?>

<div class="gowilds-single-booking-form <?php echo esc_attr($settings['style']) ?>">
   <?php if($settings['title_text']){ ?>
      <h3 class="box-title"><?php echo esc_html($settings['title_text']) ?></h3>
   <?php } ?>
   <div class="box-content">
     <div class="babe-booking-form"><?php echo BABE_html::booking_form($gowilds_post->ID) ?></div>
   </div>
</div>

