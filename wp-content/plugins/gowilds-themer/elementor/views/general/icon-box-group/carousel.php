<?php
   if(!defined('ABSPATH')){ exit; }
   use Elementor\Icons_Manager;

   $classes = array();
   $classes[] = 'gsc-icon-box-group layout-carousel swiper-slider-wrapper';
   $classes[] = $settings['space_between'] < 15 ? 'margin-disable': '';
   $this->add_render_attribute('wrapper', 'class', $classes);

?>

<div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
   <div class="swiper-content-inner">
      <div class="init-carousel-swiper swiper" data-carousel="<?php echo $this->get_carousel_settings() ?>">
         <div class="swiper-wrapper">
            <?php 
               $inumber = 1;
               foreach ($settings['icon_boxs'] as $item){ 
                  echo '<div class="swiper-slide">';
                     include $this->get_template('general/icon-box-group/item.php');
                  echo '</div>';
                  $inumber++;
               } 
            ?>
         </div>
      </div>
   </div>   
   <?php echo ($settings['ca_pagination'] ? '<div class="swiper-pagination"></div>' : '' ); ?>
   <?php echo ($settings['ca_navigation'] ? '<div class="swiper-nav-next"></div><div class="swiper-nav-prev"></div>' : '' ); ?>
</div>
