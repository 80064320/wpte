<?php
   $title_text = $settings['title_text'];
   $sub_title = $settings['sub_title'];
   $description_text = $settings['description_text'];
   $button_style = $settings['button_style'] ? $settings['button_style'] : 'btn-line-white';
   $button_size = $settings['button_size'] ? $settings['button_size'] : '';
   $auto_responisve = $settings['auto_responsive'] == 'yes' ? 'auto-responsive' : '';
   $this->add_render_attribute( 'block', 'class', [ 'align-' . $settings['align'], $settings['style'], 'widget gsc-heading', 'box-align-' . $settings['box_align'], $auto_responisve ]  );
   $header_tag = $settings['header_tag'];

   $this->add_render_attribute( 'title_text', 'class', 'title' );
   $this->add_render_attribute( 'description_text', 'class', 'title-desc' );
   $this->add_render_attribute( 'sub_title', 'class', ['sub-title'] );

   $this->add_inline_editing_attributes( 'title_text', 'none' );

   $this->add_inline_editing_attributes( 'description_text' );
   $btn_classes = "btn-cta {$button_style} {$button_size}";
   ?>
   <div <?php echo $this->get_render_attribute_string( 'block' ) ?>>
      <div class="content-inner">
         
         <?php if($settings['video'] == 'yes' && $settings['video_url']){ ?>
            <div class="heading-video">
               <a class="video-link popup-video" href="<?php echo esc_url($settings['video_url']) ?>">
                  <i class="fa fa-play"></i>
                  <span class="arrow"></span>
               </a>
            </div>
         <?php } ?>
         
         <?php 
            if($sub_title){
               echo '<div ' . $this->get_render_attribute_string( 'sub_title' ) . '>';
                  echo '<span class="tagline">' .  esc_html($sub_title) . '</span>'; 
               echo '</div>';
            } 
         ?>  
         
         <?php if($title_text){ ?>
            <<?php echo esc_attr($header_tag) ?> <?php echo $this->get_render_attribute_string( 'title_text' ); ?>>
               <span><?php echo $settings['title_text'] ?></span>
            </<?php echo esc_attr($header_tag) ?>>
         <?php } ?>
         
         <?php if( $description_text && !empty(trim($description_text)) ){ ?>
            <div <?php echo $this->get_render_attribute_string( 'description_text' ); ?>><?php echo wp_kses($description_text, true); ?></div>
         <?php } ?>

         <?php if($settings['button_url']['url']){ ?>
            <div class="heading-action">
               <?php $this->gva_render_button($btn_classes); ?>
            </div>
         <?php } ?>

      </div>
   </div>
