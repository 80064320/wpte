<?php
   if (!defined('ABSPATH')) {
      exit; 
   }
   global $gowilds_post;
   if (!$gowilds_post){
      return;
   }
   $author_id = get_post_field('post_author', $gowilds_post->ID);
   $author = get_user_by('id', $author_id);
   $userdata = get_user_meta($author_id);
?>
   
<div class="post-author-box">
   <div class="content-inner">
      <div class="author-image">
         <a href="<?php echo get_author_posts_url($author_id) ?>">
            <?php echo get_avatar( $author_id, 190); ?>
         </a>
      </div>
      <div class="author-content">
         <div class="author-name">
            <a href="<?php echo get_author_posts_url($author_id) ?>">
               <?php echo esc_html($author->display_name); ?>
            </a>
         </div>
         <?php if(isset($userdata['description'][0])){ ?>
            <div class="author-bio">
               <?php echo esc_html($userdata['description'][0]); ?>
            </div>   
         <?php } ?>   
      </div>   
   </div>   
</div>      

