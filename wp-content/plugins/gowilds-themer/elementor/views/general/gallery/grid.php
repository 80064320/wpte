<?php
	$class_gutter = $settings['grid_remove_padding'] == 'yes' ? 'small-gutter' : '';
	$this->add_render_attribute('wrapper', 'class', ['gva-gallery-grid clearfix', $class_gutter]);
	$this->get_grid_settings();
   $_random = gaviasthemer_random_id();
?>
  
<div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
	<div class="gva-content-items"> 
	  	<div <?php echo $this->get_render_attribute_string('grid') ?>>
		 	<?php
			  	foreach ($settings['images'] as $image){
				 	echo '<div class="item">';
						include $this->get_template('general/gallery/item.php');
				 	echo '</div>';  
			  	}
			?>
	  	</div>
	</div>
</div>
