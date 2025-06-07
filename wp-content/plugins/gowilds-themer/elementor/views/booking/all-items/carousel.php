<?php
	$classes = array();
	$classes[] = 'gva-booking-carousel swiper-slider-wrapper gva-booking-allitems';
	$classes[] = $settings['space_between'] < 15 ? 'margin-disable': '';
	$this->add_render_attribute('wrapper', 'class', $classes);
?>
	
	<div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
		<div class="swiper-content-inner">
			<div class="init-carousel-swiper swiper" data-carousel="<?php echo $this->get_carousel_settings() ?>">
				<div class="swiper-wrapper">
					<?php echo do_shortcode($this->all_items_shortcode()); ?>
				</div>    
			</div>
		</div>   
		<?php echo ($settings['ca_pagination'] ? '<div class="swiper-pagination"></div>' : '' ); ?>
		<?php echo ($settings['ca_navigation'] ? '<div class="swiper-nav-next"></div><div class="swiper-nav-prev"></div>' : '' ); ?>
	</div>

	<?php wp_reset_postdata(); 