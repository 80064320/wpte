<?php
   use Elementor\Icons_Manager;
   
   $classes = array();
   $classes[] = 'swiper-slider-wrapper gsc-team layout-carousel';
   $classes[] = $settings['space_between'] < 15 ? 'margin-disable': '';
   $this->add_render_attribute('wrapper', 'class', $classes);
?>

<div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
   <div class="swiper-content-inner">   
      <div class="init-carousel-swiper swiper" data-carousel="<?php echo $this->get_carousel_settings() ?>">
         <div class="swiper-wrapper">
            <?php foreach ($settings['team_content'] as $item): ?>
               <div class="swiper-slide">
                  <?php include $this->get_template('general/team/item.php'); ?>
               </div>
            <?php endforeach; ?>
         </div> 
      </div>
   </div>   
   <?php echo ($settings['ca_pagination'] ? '<div class="swiper-pagination"></div>' : '' ); ?>
   <?php echo ($settings['ca_navigation'] ? '<div class="swiper-nav-next"></div><div class="swiper-nav-prev"></div>' : '' ); ?>
</div>
