<?php
   if (!defined('ABSPATH')){ exit; }

   global $gowilds_post, $post;

   if(!$gowilds_post){ return; }
   $post = $gowilds_post;
?>
   
<div class="post-comment">
   <?php
      if(comments_open($gowilds_post->ID)){
         comments_template();
      }else{
         if(\Elementor\Plugin::$instance->editor->is_edit_mode()){
            echo '<div class="alert alert-info">' . esc_html__('This Post Disabled Comment', 'gowilds-themer') . '</div>';
         }
      }
   ?>
</div>      

