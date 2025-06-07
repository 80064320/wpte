<?php
  	$query = $this->query_posts();
  	$_random = gaviasthemer_random_id();
  	if ( !$query->found_posts ){
		return;
  	}

	$this->add_render_attribute('wrapper', 'class', ['gva-posts-standard clearfix gva-posts']);
?>
  
<div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
		
	<div class="gva-content-items cleafix"> 
			<?php
				global $post;
				$i = 0;
				while ( $query->have_posts() ) { 
					$i ++;
					$query->the_post();
					$post->post_count = $query->post_count;

					echo '<div class="item-post">';
   				  	$this->gowilds_get_template_part('templates/content/item-post', 'standard', array(
   					 	'thumbnail_size' => $settings['image_size'],
   					 	'excerpt_words'  => $settings['excerpt_words']
   				  	));
               echo '</div>';
				}
			?>

		<?php if($settings['pagination'] == 'yes'): ?>
			<div class="pagination">
				<?php echo $this->pagination($query); ?>
			</div>
		<?php endif; ?>
	</div>

</div>

<?php wp_reset_postdata();