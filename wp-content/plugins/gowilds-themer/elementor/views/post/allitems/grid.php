<?php
  $query = $this->query_posts();
  $_random = gaviasthemer_random_id();
  if ( ! $query->found_posts ) {
	 return;
  }

	$this->add_render_attribute('wrapper', 'class', ['gva-posts-grid clearfix gva-posts']);

	//add_render_attribute grid
	$this->get_grid_settings();
?>
  
  <div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
		<div class="gva-content-items"> 
		  <div <?php echo $this->get_render_attribute_string('grid') ?>>
			 <?php
				global $post;
				$count = 0;
				while( $query->have_posts()){ 
				  	$query->the_post();
				  	$post->loop = $count++;
				  	$post->post_count = $query->post_count;
               echo '<div class="item-columns">';
   				  	$this->gowilds_get_template_part('templates/content/item', $settings['style'], array(
   					 	'thumbnail_size' => $settings['image_size'],
   					 	'excerpt_words'  => $settings['excerpt_words']
   				  	));
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
  <?php

  wp_reset_postdata();