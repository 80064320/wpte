<?php
	if ( ! defined( 'ABSPATH' ) ) exit;
   $query = $this->query_posts();
  	$_random = gaviasthemer_random_id();

	$classes = array();
	$classes[] = 'swiper-slider-wrapper';
	$classes[] = $settings['space_between'] < 15 ? 'margin-disable': '';
	$this->add_render_attribute('wrapper', 'class', $classes);
?>

<div class="all-listing listings-carousel"> 
	<?php if($query->found_posts){ ?>
		<div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
			<div class="swiper-content-inner">
				<div class="init-carousel-swiper swiper" data-carousel="<?php echo $this->get_carousel_settings() ?>">
					<div class="swiper-wrapper">
						<?php
							global $post;
							$count = 0;
							while ( $query->have_posts() ) { 
								$query->the_post();
								echo '<div class="swiper-slide">';
									$this->gowilds_get_template_part('templates/content/item', $settings['card_style'], array(
									  'thumbnail_size' => $settings['image_size'],
									  'excerpt_words'	 => $settings['excerpt_words']
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
		}else{
         echo '<div class="directorist-archive-notfound">' . esc_html__( 'No listings found.', 'gowilds-themer' ) . '</div>';
      }
   ?>
</div>

<?php
/* Restore original Post Data */
wp_reset_postdata();