<?php
	$this->add_render_attribute('wrapper', 'class', ['gva-booking-grid clearfix gva-booking-allitems']);
	$this->get_grid_settings();
?>
  
  	<div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
		<div class="gva-content-items"> 
			<div <?php echo $this->get_render_attribute_string('grid') ?>>
				<?php echo do_shortcode($this->all_items_shortcode()); ?>
			</div>
         <?php 
            if($settings['pagination']){
               $posts_pages = BABE_Post_types::$get_posts_pages;
               $pagination = BABE_Functions::pager($posts_pages);
               echo $pagination;
            }
         ?>
		</div>
  	</div>
  <?php

  wp_reset_postdata();