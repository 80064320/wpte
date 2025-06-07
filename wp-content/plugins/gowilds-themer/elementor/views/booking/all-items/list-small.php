<?php
	$this->add_render_attribute('wrapper', 'class', ['gva-booking-list-small clearfix gva-booking-allitems']);
?>
  
  <div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
		<div class="gva-content-items"> 
			<?php echo do_shortcode($this->all_items_shortcode()); ?>
		</div>
  </div>
  <?php

  wp_reset_postdata();