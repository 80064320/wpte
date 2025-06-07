<?php 
use Elementor\Icons_Manager;
   
$has_icon = ! empty( $item['selected_icon']['value']); 
$style = $settings['style'];
$avatar = (isset($item['testimonial_image']['url']) && $item['testimonial_image']['url']) ? $item['testimonial_image']['url'] : '';
?>
<div class="testimonial-item <?php echo esc_attr($style) ?> elementor-repeater-item-<?php echo $item['_id'] ?>">
   
   <?php if( $style == 'style-1'){ ?>
      <div class="testimonial-one__single<?php echo ($style=='style-1a' ? ' skin-white' : '') ?>">
         <div class="testimonial-one__quote">
            <div class="testimonial-one__stars">
               <i class="fa fa-star"></i>
               <i class="fa fa-star"></i>
               <i class="fa fa-star"></i>
               <i class="fa fa-star"></i>
               <i class="fa fa-star"></i>
            </div>
            <?php echo esc_html($item['testimonial_content']); ?>
            <span class="testimonial-one__quote-icon"><i class="gwflaticon-quote"></i></span>
            <span class="testimonial-one__arrow">
               <span class="first"></span>
               <span class="second"></span>
            </span>
         </div>
         <div class="testimonial-one__meta">
            <?php 
               if($avatar){ 
                  echo '<div class="testimonial-one__image">';
                     echo '<img ' . $this->gowilds_get_image_size($avatar) . ' src="' . esc_url($avatar) . '" alt="' . $item['testimonial_name'] . '" />';
                  echo '</div>';
               }
            ?>
            <div class="testimonial-one__information">
               <span class="testimonial-one__name"><?php echo $item['testimonial_name']; ?></span>
               <span class="testimonial-one__job"><?php echo $item['testimonial_job']; ?></span>
            </div>
         </div>
      </div>   
   <?php } ?>  

   <?php if( $style == 'style-2'){ ?>
      <div class="testimonial-two__single">
         <div class="testimonial-two__wrap">
            
            <div class="testimonial-two__top">
               <div class="testimonial-two__top-left">
                  <i class="gwflaticon-quote"></i>   
               </div>
               <div class="testimonial-two__top-right">
                  <?php 
                     if($item['testimonial_title']){
                        echo '<h3 class="testimonial-two__title">' . $item['testimonial_title'] . '</h3>';
                     } 
                  ?>
                  <div class="testimonial-two__stars">
                     <i class="fa fa-star"></i>
                     <i class="fa fa-star"></i>
                     <i class="fa fa-star"></i>
                     <i class="fa fa-star"></i>
                     <i class="fa fa-star"></i>
                  </div>
               </div>   
            </div>

            <div class="testimonial-two__quote">
               <?php echo $item['testimonial_content']; ?>
            </div>

            <div class="testimonial-two__meta">
               <div class="testimonial-two__meta-content">
                  <?php 
                     if($avatar){ 
                        echo '<div class="testimonial-two__image">';
                           echo '<img ' . $this->gowilds_get_image_size($avatar) . ' src="' . esc_url($avatar) . '" alt="' . $item['testimonial_name'] . '" />';
                        echo '</div>';
                     }
                  ?>
                  <div class="testimonial-two__meta-inner">
                     <h4 class="testimonial-two__name"><?php echo $item['testimonial_name']; ?></h4>
                     <div class="testimonial-two__job"><?php echo $item['testimonial_job']; ?></div>
                  </div>
               </div>   
            </div>
         </div>
      </div>
   <?php } ?>  

   <?php if( $style == 'style-3'){ ?>
      <div class="testimonial-three__single">
         <div class="testimonial-three__content">
            <span class="testimonial-three__quote-icon"><i class="gwflaticon-quote"></i></span>
            <div class="testimonial-three__meta">
               <div class="testimonial-three__meta-left">
                  <?php 
                     if($avatar){ 
                        echo '<div class="testimonial-three__image">';
                           echo '<img ' . $this->gowilds_get_image_size($avatar) . ' src="' . esc_url($avatar) . '" alt="' . $item['testimonial_name'] . '" />';
                        echo '</div>';
                     }
                  ?>
               </div>
               <div class="testimonial-three__meta-right">
                  <div class="testimonial-three__stars">
                     <i class="fa fa-star"></i>
                     <i class="fa fa-star"></i>
                     <i class="fa fa-star"></i>
                     <i class="fa fa-star"></i>
                     <i class="fa fa-star"></i>
                  </div>
                  <h4 class="testimonial-three__name"><?php echo $item['testimonial_name']; ?></h4>
                  <div class="testimonial-three__job"><?php echo $item['testimonial_job']; ?></div>
               </div>   
            </div>

            <div class="testimonial-three__quote">
               <?php echo $item['testimonial_content']; ?>
               <span class="arrow"></span>
            </div>
            
         </div>
      </div>
   <?php } ?> 

   <?php if( $style == 'style-4'){ ?>
      <div class="testimonial-four__single">
         <div class="testimonial-four__wrap">
            
            <div class="testimonial-four__top">
               <div class="testimonial-four__top-left">
                  <i class="gwflaticon-quote"></i>   
               </div>
               <div class="testimonial-four__top-right">
                  <?php 
                     if($item['testimonial_title']){
                        echo '<h3 class="testimonial-four__title">' . $item['testimonial_title'] . '</h3>';
                     } 
                  ?>
                  <div class="testimonial-four__stars">
                     <i class="fa fa-star"></i>
                     <i class="fa fa-star"></i>
                     <i class="fa fa-star"></i>
                     <i class="fa fa-star"></i>
                     <i class="fa fa-star"></i>
                  </div>
               </div>   
            </div>

            <div class="testimonial-four__quote">
               <?php echo $item['testimonial_content']; ?>
            </div>

            <div class="testimonial-four__meta">
               <div class="testimonial-four__meta-content">
                  <?php 
                     if($avatar){ 
                        echo '<div class="testimonial-four__image">';
                           echo '<img ' . $this->gowilds_get_image_size($avatar) . ' src="' . esc_url($avatar) . '" alt="' . $item['testimonial_name'] . '" />';
                        echo '</div>';
                     }
                  ?>
                  <div class="testimonial-four__meta-inner">
                     <h4 class="testimonial-four__name"><?php echo $item['testimonial_name']; ?></h4>
                     <div class="testimonial-four__job"><?php echo $item['testimonial_job']; ?></div>
                  </div>
               </div>   
            </div>
         </div>
      </div>
   <?php } ?> 

</div>

