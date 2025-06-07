<?php
  use Elementor\Icons_Manager;

   $style = $settings['style'];
   $description_text = $settings['description_text'];
   $header_tag = 'h2';
   if(!empty($settings['header_tag'])) $header_tag = $settings['header_tag'];

   $has_icon = (!empty( $settings['selected_icon']['value'])) ? true : false;
   $title_html = $settings['title_text'];

   $this->add_render_attribute( 'block', 'class', [ 'widget gsc-icon-box-styles', $settings['style'], $settings['active'] == 'yes' ? 'active' : '' ] );

   $active_class = $settings['active'] == 'yes' ? ' active' : '';
   ?>

   <?php if($style == 'style-1'){ ?>
      <div class="icon-style-one__single<?php echo esc_attr($active_class) ?>">
         <div class="icon-style-one__wrap">
            <?php 
               if($has_icon){
                  echo '<div class="icon-style-one__icon">';
                     Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] );
                  echo '</div>';
               } 
            ?>
            <div class="icon-style-one__content">
               <?php 
                  if(!empty($settings['title_text'])){
                     echo '<' . esc_attr($header_tag) . ' class="icon-style-one__title">';
                        echo $title_html;
                     echo '</' . esc_attr($header_tag) . '>';
                  } 
                  if(!empty($settings['description_text'])){
                     echo '<div class="icon-style-one__desc">' . wp_kses($description_text, true) . '</div>';
                  }
               ?>
            </div>
         </div> 
         <?php $this->gva_render_link_html('', $settings['button_url'], 'icon-style-one__link'); ?>
      </div>   
   <?php } ?>

   <?php if($style == 'style-2'){ ?>
      <div class="icon-style-two__single<?php echo esc_attr($active_class) ?>">
         <div class="icon-style-two__wrap">
            <?php 
               if($has_icon){ 
                  echo '<div class="icon-style-two__icon">';
                     Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] );
                  echo '</div>';
               }
            ?>
            <div class="icon-style-two__content">
               <?php 
                  if(!empty($settings['title_text'])){
                     echo '<' . esc_attr($header_tag) . ' class="icon-style-two__title">';
                        echo $title_html;
                     echo '</' . esc_attr($header_tag)  . '>';
                  } 
               ?>
            </div>
         </div> 
         <?php $this->gva_render_link_html('', $settings['button_url'], 'icon-style-two__link-overlay'); ?>
      </div>   
   <?php } ?>
