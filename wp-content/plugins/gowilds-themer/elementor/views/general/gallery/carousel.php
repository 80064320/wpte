<?php
	$classes = array();
	$classes[] = 'gva-gallery-carousel swiper-slider-wrapper';
	$classes[] = $style = $settings['style'];
   $classes[] = $settings['space_between'] < 15 ? 'margin-disable': '';
   $this->add_render_attribute('wrapper', 'class', $classes);
   $_random = gaviasthemer_random_id();
?>

<div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
	<div class="swiper-content-inner">
   	<div class="init-carousel-swiper swiper" data-carousel="<?php echo $this->get_carousel_settings() ?>">
      	<div class="swiper-wrapper">
				<?php
					foreach ($settings['images'] as $image){
						echo '<div class="swiper-slide item">';
							include $this->get_template('general/gallery/item.php');
						echo '</div>';	
					}
				?>
			</div>
		</div>
	</div>
	<?php echo ($settings['ca_pagination'] ? '<div class="swiper-pagination"></div>' : '' ); ?>
   <?php echo ($settings['ca_navigation'] ? '<div class="swiper-nav-next"></div><div class="swiper-nav-prev"></div>' : '' ); ?>
</div>
