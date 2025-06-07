<?php
   if (!defined('ABSPATH')){ exit; }

   global $gowilds_post;

   if (!$gowilds_post){ return; }

   if ($gowilds_post->post_type != BABE_Post_types::$booking_obj_post_type){ return;}

   $ba_post = BABE_Post_types::get_post($gowilds_post->ID);
?>

   <?php if(!empty($ba_post) && isset($ba_post['address']['address'])){ ?>
   <div class="gowilds-single-address">
      <i class="flaticon-place"></i>
      <span><?php echo esc_html($ba_post['address']['address']); ?></span>
   </div>

<?php } ?>
