<?php

   $style = $settings['style'];
   $this->add_render_attribute( 'link', 'href', $settings['link']['url'] );
   $this->add_render_attribute( 'link', 'class', 'popup-video' );
   if ( $settings['link']['is_external'] ) {
      $this->add_render_attribute( 'link', 'target', '_blank' );
   }
   if ( $settings['link']['nofollow'] ) {
      $this->add_render_attribute( 'link', 'rel', 'nofollow' );
   }

   ?>

   <?php if($style == 'style-1'){ ?>
      <div class="video-one__single">
         <div class="video-one__inner">
            <?php if(isset($settings['image']['url']) && $settings['image']['url']){ ?>
               <div class="video-one__image">
                  <a <?php echo $this->get_render_attribute_string( 'link' ) ?>>
                     <img src="<?php echo esc_url($settings['image']['url']) ?>" alt="<?php echo esc_html($settings['title_text']) ?>"/>
                  </a>   
               </div>
            <?php } ?>   
            <div class="video-one__content">
               <div class="video-one__action">
                  <?php 
                     echo '<a ' . $this->get_render_attribute_string( 'link' ) . '><i class="fa fa-play"></i></a>';
                  ?>  
               </div>   
            </div>    
         </div>
      </div> 
   <?php } ?>

   <?php if($style == 'style-2'){ ?>
      <div class="video-two__single">
         <div class="video-two__inner">
            <div class="video-two__content">
               <div class="video-two__action">
                  <a <?php echo $this->get_render_attribute_string( 'link' ) ?>><span><i class="fa fa-play"></i></span></a>
               </div>
               <?php if( $settings['title_text'] ){ ?>
                  <div class="video-two__title"><?php echo $settings['title_text'] ?></div>
               <?php } ?>
            </div>    
         </div>
      </div> 
   <?php } ?>

 
 
