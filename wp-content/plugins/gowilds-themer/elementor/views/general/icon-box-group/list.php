<?php
	if (!defined('ABSPATH')){ exit; }
	use Elementor\Icons_Manager;
	$classes = array();
   $classes[] = 'gsc-icon-box-group iconboxs-layout-list';
	$this->add_render_attribute('wrapper', 'class', $classes);
?>

<div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
	<?php
		foreach ($settings['icon_boxs'] as $item){ 
			include $this->get_template('general/icon-box-group/item-list.php');
		} 
	?>
</div>
