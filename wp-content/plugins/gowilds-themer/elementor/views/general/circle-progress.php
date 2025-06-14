<?php
  use Elementor\Icons_Manager;
   $settings = $this->get_settings_for_display();
   $this->add_render_attribute( 'block', 'class', ['gsc-circle-progress clearfix'] );
   $this->add_render_attribute( 'title_text', 'class', 'title' );
   $value = !empty($settings['number']) ? $settings['number']/100 : 0.5;
   $thickness = $settings['thickness'];
   $empty_fill = !empty($settings['empty_fill']) ? $settings['empty_fill'] : '#F3F7F5';
   $color = !empty($settings['color']) ? $settings['color'] : '#63AB45';
   $width = !empty($settings['width']) ? $settings['width'] : '100';
   ?>
   
   <div <?php echo $this->get_render_attribute_string( 'block' ) ?>>
      <div class="circle-progress" data-value="<?php echo $value ?>"  data-thickness="<?php echo $thickness ?>" data-empty-fill="<?php echo esc_attr($empty_fill) ?>" data-lineCap="square" data-size="<?php echo esc_attr($width) ?>" data-fill="{ &quot;color&quot;: &quot;<?php echo $color ?>&quot; }">
         <strong></strong>
      </div> 
      <?php if(!empty($settings['title'])){ ?>
         <div class="title">
            <span><?php echo $settings['title'] ?></span>
         </div>   
      <?php } ?>
   </div> 

