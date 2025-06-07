<?php
   $query = $this->query_posts();
   if (!$query->found_posts){ return;}

   $this->add_render_attribute('wrapper', 'class', ['gsc-campaign layout-grid']);
   $this->get_grid_settings();
?>

<div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
   <div class="gva-content-items"> 
      <div <?php echo $this->get_render_attribute_string('grid') ?>>
         <?php
            global $post;
            while ( $query->have_posts() ) { 
               $query->the_post();
               echo '<div class="item-columns">';
                  $this->gowilds_get_template_part('woocommerce/content', $settings['style'], array('thumbnail_size' => $settings['image_size']) );
               echo '</div>';
            }
         ?>
      </div>   
   </div>   
   <?php if($settings['pagination'] == 'yes'): ?>
       <div class="pagination">
           <?php echo $this->pagination($query); ?>
       </div>
   <?php endif; ?>
</div>
