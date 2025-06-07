<?php
  use Elementor\Icons_Manager;
   

   $style = $settings['style'];
   $header_tag = 'h2';
   if(!empty($settings['title_size'])) $header_tag = $settings['title_size'];

   $has_icon = ! empty( $settings['selected_icon']['value']);

   $title_html = $settings['title_text'];

   ?>

   <?php if($style == 'style-1'){ ?>
      <div class="milestone-one__single">
            
         <?php 
            if($has_icon){ 
               echo '<div class="milestone-one__icon">';
                  echo '<span class="icon">';
                     Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] );
                  echo '</span>';
               echo '</div>';
            } 
         ?>

         <div class="milestone-one__content">
            <div class="milestone-one__number">
               <?php 
                  if($settings['text_before']){
                     echo ('<span class="symbol before">' . $settings['text_before'] . '</span>');
                  }
                  echo '<span class="milestone-number">' . esc_attr($settings['number']) . '</span>';
                  if($settings['text_after']){
                     echo ('<span class="symbol after">' . $settings['text_after'] . '</span>');
                  }  
               ?>
            </div>
            <?php 
               if(!empty($title_html)){ 
                  echo '<' . esc_attr($header_tag) .' class="milestone-one__title">';
                     echo $title_html;
                  echo '</' . esc_attr($header_tag) . '>';
               } 
            ?>
         </div>
         
         <?php $this->gva_render_link_html('', $settings['link'], 'milestone-one__link'); ?>

      </div> 
   <?php } ?>

   <?php if($style == 'style-2'){ ?>
      <div class="milestone-two__single">
         <?php 
            if($has_icon){ 
               echo '<div class="milestone-two__icon">';
                  Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] );
               echo '</div>';
            } 
         ?>
         <div class="milestone-two__content">
            <div class="milestone-two__number">
               <?php 
                  if($settings['text_before']){
                     echo ('<span class="symbol before">' . $settings['text_before'] . '</span>');
                  }
                  echo '<span class="milestone-number">' . esc_attr($settings['number']) . '</span>';
                  if($settings['text_after']){
                     echo ('<span class="symbol after">' . $settings['text_after'] . '</span>');
                  }  
               ?>
            </div>
            <?php 
               if(!empty($title_html)){ 
                  echo '<' . esc_attr($header_tag) .' class="milestone-two__title">';
                     echo $title_html;
                  echo '</' . esc_attr($header_tag) . '>';
               } 
            ?>
         </div>
         <?php $this->gva_render_link_html('', $settings['link'], 'milestone-two__link'); ?>
      </div> 
   <?php } ?>

   <?php if($style == 'style-3'){ ?>
      <div class="milestone-three__single">
         <div class="milestone-three__content">
            <?php 
               if($has_icon){ 
                  echo '<div class="milestone-three__icon">';
                     echo '<span class="icon">';
                        Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] );
                     echo '</span>';
                  echo '</div>';
               } 
            ?>
            <div class="milestone-three__number">
               <?php 
                  if($settings['text_before']){
                     echo ('<span class="symbol before">' . $settings['text_before'] . '</span>');
                  }
                  echo '<span class="milestone-number">' . esc_attr($settings['number']) . '</span>';
                  if($settings['text_after']){
                     echo ('<span class="symbol after">' . $settings['text_after'] . '</span>');
                  }  
               ?>
            </div>
            <?php 
               if(!empty($title_html)){ 
                  echo '<' . esc_attr($header_tag) .' class="milestone-three__title">';
                     echo $title_html;
                  echo '</' . esc_attr($header_tag) . '>';
               } 
            ?>
            <?php $this->gva_render_link_html('', $settings['link'], 'milestone-three__link'); ?>
         </div>   
      </div> 
   <?php } ?>