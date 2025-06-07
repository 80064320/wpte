<?php
   global $wp_query;

   $this->add_render_attribute('wrapper', 'class', ['booking-grid clearfix ba-booking-archive']);
   $this->get_grid_settings();

?>

<div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
   <div class="gva-content-items"> 
      <div <?php echo $this->get_render_attribute_string('grid') ?>>
         <?php
            while (have_posts()) : the_post();
               $post = get_post(get_the_ID(), ARRAY_A);
               $prices = BABE_Post_types::get_post_price_from($post['ID']);
               $post = array_merge($post, $prices);
               if($settings['layout'] == 'grid'){
                  echo '<div class="item-columns">';
                     include get_theme_file_path('templates/booking/block/item-style-1.php');
                  echo '</div>';
               }elseif($settings['layout'] == 'list'){
                  include get_theme_file_path('templates/booking/block/item-style-list.php');
               }
           endwhile;
         ?>
      </div>
   </div>

   <div class="pagination">
      <?php echo $this->pagination($wp_query); ?>
   </div>
</div>
  <?php

