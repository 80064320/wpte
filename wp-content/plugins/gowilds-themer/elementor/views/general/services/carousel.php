<?php
   use Elementor\Icons_Manager;
   
   $classes = array();
   $classes[] = 'swiper-slider-wrapper gsc-services layout-carousel';
   $classes[] = $settings['style'];
   $classes[] = $settings['space_between'] < 15 ? 'margin-disable': '';
   $this->add_render_attribute('wrapper', 'class', $classes);
?>

<div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
   <div class="swiper-content-inner">   
      <div class="init-carousel-swiper swiper" data-carousel="<?php echo $this->get_carousel_settings() ?>">
         <div class="swiper-wrapper">
            <?php 
            $index = 0; 
            foreach ($settings['services_content'] as $item):
            $index ++; 
            ?>
               <div class="swiper-slide">
                  <?php include $this->get_template('general/services/item.php'); ?>
               </div>
            <?php endforeach; ?>
         </div> 
      </div>
   </div>   
   <?php echo ($settings['ca_pagination'] ? '<div class="swiper-pagination"></div>' : '' ); ?>
   <?php echo ($settings['ca_navigation'] ? '<div class="swiper-nav-next"></div><div class="swiper-nav-prev"></div>' : '' ); ?>
</div>
