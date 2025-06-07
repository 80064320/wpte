<?php
   if (!defined('ABSPATH')) {
      exit; 
   }
   global $gowilds_post;
   if (!$gowilds_post){
      return;
   }
?>

<?php 
   $thumbnail_size = $settings['gowilds_image_size'];

   if(has_post_thumbnail($gowilds_post)){
      echo get_the_post_thumbnail($gowilds_post, $thumbnail_size);
   }
?>

