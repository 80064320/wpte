<?php
   if (!defined('ABSPATH')) {
      exit; 
   }
   global $gowilds_post;
   if (!$gowilds_post){
      return;
   }
   $html_tag = $settings['html_tag'];
?>

<div class="gowilds-post-title">
   <<?php echo esc_attr($html_tag) ?> class="post-title">
      <span><?php echo get_the_title($gowilds_post) ?></span>
   </<?php echo esc_attr($html_tag) ?>>
</div>   