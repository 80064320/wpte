<?php
   $this->add_render_attribute('wrapper', 'class', 'elementor-post-wrapper');

   $this->add_render_attribute('row', 'class', 'row');

   $this->add_render_attribute('row', 'data-elementor-columns', !empty($settings['column']) ? $settings['column'] : 1 );
   $this->add_render_attribute('row', 'data-elementor-columns-tablet', !empty($settings['column_tablet']) ? $settings['column_tablet'] : 1 );
   $this->add_render_attribute('row', 'data-elementor-columns-mobile', !empty($settings['column_mobile']) ? $settings['column_mobile'] : 1 );
?>

<div class="ba-list-items">
   <?php if($settings['title_text']){
      echo '<h3 class="title">' . esc_html($settings['title_text']) . '</h3>';
   } ?>
   <div class="box-content">
      <div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
         <div <?php echo $this->get_render_attribute_string('row'); ?>>
            <?php
               foreach($posts as $post_item){
                  $this->gowilds_get_template_part('templates/booking/block/item-style', 'list-small', array(
                    'post_item' => $post_item
                  ));
               }
            ?>
         </div>
      </div>
   </div>   
</div>

<?php  wp_reset_postdata();