<?php
   if (!defined('ABSPATH')) {
      exit; // Exit if accessed directly.
   }
   use Elementor\Icons_Manager;

   $this->add_render_attribute('wrapper', 'class', ['gsc-services layout-grid']);
   //add_render_attribute grid
   $this->get_grid_settings();
?>

<div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
   <div <?php echo $this->get_render_attribute_string('grid') ?>>
      <?php 
         $index = 0;
         foreach ($settings['services_content'] as $item){
            $index ++;
            echo '<div class="item-columns">';
               include $this->get_template('general/services/item.php'); 
            echo '</div>';

         }
      ?>
   </div>
</div>
