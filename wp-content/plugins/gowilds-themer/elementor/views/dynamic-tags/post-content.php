<?php
   if (!defined('ABSPATH')) {
      exit; 
   }
   global $gowilds_post;
   if (!$gowilds_post){
      return;
   }
   ?>
   
   <div class="post-content">
         <?php 
            echo apply_filters('the_content', $gowilds_post->post_content); 
         ?>
   </div>      

