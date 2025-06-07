<?php
	if (!defined('ABSPATH')){ exit; }
	use Elementor\Icons_Manager;

	$classes = array();
   $classes[] = 'gsc-testimonial layout-grid';
   $classes[] = $settings['style'];

	$this->add_render_attribute('wrapper', 'class', $classes);

	//add_render_attribute grid
	$this->get_grid_settings();
?>

<div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
	<div <?php echo $this->get_render_attribute_string('grid') ?>>
		<?php
		foreach ($settings['testimonials'] as $item){ 
			$has_icon = ! empty( $item['selected_icon']['value']); ?>
			
			<div class="item-columns">
				<?php include $this->get_template('general/testimonials/item.php'); ?>
			</div>

		<?php } ?>
	</div>   
</div>
