<?php
  $query = $this->query_posts();
  $_random = gaviasthemer_random_id();
  if ( ! $query->found_posts ) {
	 return;
  }

	$this->add_render_attribute('wrapper', 'class', ['gva-posts-sticky clearfix gva-posts']);

	//add_render_attribute grid
	$this->get_grid_settings();
?>
  
<div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
		
	<div class="post-sticky__wrapper"> 
	  	<div class="post-sticky__content">
		  	<?php
			 	global $post;
			 	$i = 0;
			 	while ( $query->have_posts() ) { 
					$i++;
					$query->the_post();
					$post->post_count = $query->post_count;
					set_query_var( 'thumbnail_size', $settings['image_size'] );
					set_query_var('index', $i);
					
					if($i < 3){
						if($i == 1){
							echo '<div class="post-sticky__left"><div class="post-sticky__left-content">';
						}
						if($i == 1 || $i == 2){ 
							echo '<div class="post-sticky__left-item">';
						 		get_template_part('templates/content/item', 'post-style-5');
					  		echo '</div>';
					  	}
					  	if($i == 2 || $i == $query->found_posts){
					  		echo '</div></div>';
					  	}
					}

				  	if($i >= 3){
				  		if($i == 3){ 
				  			echo '<div class="post-sticky__right"><div class="post-sticky__right-content">'; 
				  		}
				  				get_template_part('templates/content/item', 'post-style-6' );
				  		if($i == $query->found_posts || $i == $settings['posts_per_page']) { 
				  			echo '</div></div>'; 
				  		}
				  	}
			 	}
		  	?>
		</div>

		<?php if($settings['pagination'] == 'yes'): ?>
		 	<div class="pagination">
			  	<?php echo $this->pagination($query); ?>
		 	</div>
		<?php endif; ?>
	</div>

</div>	
  <?php

  wp_reset_postdata();