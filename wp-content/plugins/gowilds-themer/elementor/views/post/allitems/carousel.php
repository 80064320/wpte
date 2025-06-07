<?php
	$query = $this->query_posts();
	if (!$query->found_posts) {
		return;
	}

	$classes = array();
	$classes[] = 'gva-posts-carousel gva-posts swiper-slider-wrapper';
	$classes[] = $settings['space_between'] < 15 ? 'margin-disable': '';
	$this->add_render_attribute('wrapper', 'class', $classes);

	$_random = gaviasthemer_random_id();
	$this->add_render_attribute('wrapper', 'data-filter', $_random);
  ?>

	<div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
		<div class="swiper-content-inner">
			<div class="init-carousel-swiper swiper" data-carousel="<?php echo $this->get_carousel_settings() ?>">
				<div class="swiper-wrapper">
					<?php
						global $post;
						$count = 0;
						while ( $query->have_posts() ) { 
							$query->the_post();
							$post->loop = $count++;
							$post->post_count = $query->post_count;
							echo '<div class="swiper-slide">';
								$this->gowilds_get_template_part('templates/content/item', $settings['style'], array(
								  'thumbnail_size' => $settings['image_size'],
								  'excerpt_words'  => $settings['excerpt_words']
								));
							echo '</div>';
						}
					?>
				</div>
			</div>	
		</div>	
		<?php echo ($settings['ca_pagination'] ? '<div class="swiper-pagination"></div>' : '' ); ?>
		<?php echo ($settings['ca_navigation'] ? '<div class="swiper-nav-next"></div><div class="swiper-nav-prev"></div>' : '' ); ?> 
	</div>
  <?php
  wp_reset_postdata();