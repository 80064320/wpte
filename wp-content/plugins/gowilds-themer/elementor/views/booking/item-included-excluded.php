<?php
   use Elementor\Icons_Manager;

   if (!defined('ABSPATH')){ exit; }

   global $gowilds_post;

   if (!$gowilds_post){ return; }

   if ($gowilds_post->post_type != BABE_Post_types::$booking_obj_post_type){ return;}

   $ba_post = BABE_Post_types::get_post($gowilds_post->ID);

   $content = '';

   if($settings['type'] == 'included'){
      $content = isset($ba_post['gowilds_included']) ? $ba_post['gowilds_included'] : false;
   }else{
      $content = isset($ba_post['gowilds_excluded']) ? $ba_post['gowilds_excluded'] : false;
   }
   
?>

<div class="gowilds-single-in-ex type-<?php echo esc_attr($settings['type']) ?>">
   <div class="content-inner">
      <?php echo wp_kses($content, true); ?>
   </div>
</div>

