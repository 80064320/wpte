<?php
   if(!defined('ABSPATH')){ exit; }
   use Elementor\Icons_Manager;

   $classes = array();
   $classes[] = 'gsc-content-carousel swiper-slider-wrapper';
   $this->add_render_attribute('wrapper', 'class', $classes);

?>

<div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
   <div class="swiper-content-inner">
      <div class="init-carousel-swiper swiper" data-carousel="<?php echo $this->get_carousel_single_settings() ?>">
         <div class="swiper-wrapper">
            <?php foreach ($settings['carousel_content'] as $item){ ?>
               <div class="swiper-slide">
                  <div class="item-content">
                     <div class="item-content-inner">
                        <?php if($item['image']['url']){ ?>
                           <div class="box-image">
                              <div class="image-content">
                                 <img src="<?php echo esc_url($item['image']['url']) ?>" alt="<?php echo esc_html($item['title']) ?>"/>
                              </div>
                           </div>
                        <?php } ?>
                        <div class="box-content">
                           <div class="gsc-heading">
                              <?php 
                                 if($item['sub_title']){
                                    echo '<div class="sub-title">';
                                       echo $item['sub_title'] ? '<span class="tagline">' . esc_html($item['sub_title']) . '</span>' : '';
                                       echo $item['shadow_sub_title'] ? '<span class="shadow-text">' . esc_html($item['shadow_sub_title']) . '</span>' : '';
                                    echo '</div>';
                                 } 
                              ?>
                              <?php 
                                 if($item['title']){ 
                                    echo '<h2 class="title">' . esc_html($item['title']) . '</h2>'; 
                                 }
                              ?>   
                              <?php 
                                 if($item['desc']){ 
                                    echo '<div class="title-desc">' . $item['desc'] . '</div>'; 
                                 }
                              ?>
                              <?php if($item['btn_link']['url']){ ?>
                                 <div class="read-more">
                                    <?php echo $this->gva_render_link_html($item['btn_title'], $item['btn_link'], 'btn-border' ) ?>
                                 </div>
                              <?php } ?>

                           </div>
                        </div>
                     </div>   
                  </div>
               </div>
            <?php } ?>
         </div>
      </div>
   </div>   
   <?php echo ($settings['ca_pagination'] ? '<div class="swiper-pagination"></div>' : '' ); ?>
   <?php echo ($settings['ca_navigation'] ? '<div class="swiper-nav-next"></div><div class="swiper-nav-prev"></div>' : '' ); ?>
</div>
