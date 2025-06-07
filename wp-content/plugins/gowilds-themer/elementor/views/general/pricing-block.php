<?php
   use Elementor\Icons_Manager;

   $title_text = $settings['title_text'];
   $subtitle_text = $settings['subtitle_text'];
   $desc = $settings['desc_text'];

   $this->add_render_attribute( 'block', 'class', [ 'widget gsc-pricing', $settings['style'], 'active-' . $settings['pricing_active'] ] );
   
   $header_tag = 'h3';

   $this->add_render_attribute( 'title_text', 'class', 'title' );

   $this->add_inline_editing_attributes( 'title_text', 'none' );

   $button_classes = $settings['button_style'] ? $settings['button_style'] : 'btn-white';

?>
   
<div <?php echo $this->get_render_attribute_string( 'block' ) ?>>
   <div class="content-inner">

      <?php 
         if($subtitle_text){ 
            echo '<div class="sub-title">' . esc_html($subtitle_text) . '</div>';
         }
      ?>

      <?php if($title_text){ ?>
         <<?php echo esc_attr($header_tag) ?> <?php echo $this->get_render_attribute_string( 'title_text' ); ?>>
            <span><?php echo $settings['title_text'] ?></span>
         </<?php echo esc_attr($header_tag) ?>>
      <?php } ?>

      <div class="plan-price">
         <div class="plan-price-inner clearfix">
            <span class="currency"><?php echo esc_html( $settings['currency'] ) ?></span>
            <span class="price"><?php echo esc_html( $settings['price'] ) ?></span>
            <?php if(!empty($settings['period'])){ ?>
               <span class="interval">/&nbsp;<?php echo esc_html( $settings['period'] ) ?></span>
            <?php } ?>   
         </div>
      </div>

      <?php 
         if($desc){ 
            echo '<div class="desc">' . esc_html($desc) . '</div>';
         }
      ?>

      <?php if($settings['pricing_content']){ ?>
         <ul class="plan-list">
            <?php foreach ($settings['pricing_content'] as $key => $item) { 
               $class_active = $item['feature_active'] == 'yes' ? 'active' : 'no-active';
               ?>
               <li class="<?php echo esc_attr($class_active) ?>">
                  <span class="text"><?php echo $item['pricing_features'] ?></span>
               </li>  
            <?php } ?>
         </ul>
      <?php } ?>   


      <?php if($settings['button_url']['url']){ ?>
         <div class="pricing-action">
            <?php $this->gva_render_button($button_classes); ?>
         </div>
      <?php } ?>
   </div>
</div>

<div class="clearfix"></div>

