<?php
   use Elementor\Group_Control_Image_Size;

   $this->add_render_attribute('block', 'class', ['gsc-booking-banner', 'text-' . $settings['content_align'], $settings['style']]);
   
   $style = $settings['style'];

   $subtitle_text = $settings['subtitle'];
   $title_text = $settings['title'];

   $this->add_render_attribute( 'subtitle_text', 'class', 'subtitle' );
   $this->add_render_attribute( 'title_text', 'class', 'title' );
   $image_id = $settings['image']['id']; 
   $image_url = $settings['image']['url'];

   if($image_id){
      $attach_url = Group_Control_Image_Size::get_attachment_image_src($image_id, 'image', $settings);
      if($attach_url) $image_url = $attach_url;
   }

   $taxonomy = $settings['taxonomy'] ? $settings['taxonomy'] : 'ba_location'; 
   $term = $link_term = false;
   if( !empty($settings['term_slug']) ){
      $term = get_term_by( 'slug', $settings['term_slug'], $taxonomy );
      if($term){
         $link_term = get_term_link( $term->term_id, $taxonomy );
      }
   }
   $link = $link_term;
   if( !empty($settings['link_custom']) ) $link = $settings['link_custom'];
   $target = (isset($settings['new_tab']) && $settings['new_tab'] == 'yes') ? 'target="blank"' : '';

?>

<?php 
   if($style == 'style-1'){
      echo '<div class="lt-banner-one__single text-' . $settings['content_align'] . '">';
         echo '<div class="lt-banner-one__wrap">';
            
            if ( $settings['show_number_content'] == 'yes' && $term ) {
               if(!empty($settings['term_slug'])){
                  echo '<span class="lt-banner-one__count">';
                     echo $term->count . '&nbsp;';
                     echo ($term->count < 2 ? $settings['show_number_one_text'] : $settings['show_number_text']);
                  echo '</span>';
               }
            } 

            if($image_url){ 
               echo '<div class="lt-banner-one__image">';
                  echo '<img src="' . esc_url($image_url) . '" alt="' . esc_html($title_text) . '" />';
               echo '</div>';
            }

            echo '<div class="lt-banner-one__content">';
               if($subtitle_text){
                  echo '<div class="lt-banner-one__subtitle">' . esc_html($subtitle_text) . '</div>';
               }
               if($title_text){
                  echo '<h3 class="lt-banner-one__title">' . $title_text . '</h3>';
               }
            echo '</div>';

            if($link){ 
               echo '<a class="lt-banner-one__link" ' . $target . ' href="' . esc_url($link) . '"></a>';
            }
         echo '</div>';
      echo '</div>';
   } 
?>

<?php 
   if($style == 'style-2'){
      echo '<div class="lt-banner-two__single text-' . $settings['content_align'] . '">';
         echo '<div class="lt-banner-two__wrap">';
            
            if ( $settings['show_number_content'] == 'yes' && $term ) {
               if(!empty($settings['term_slug'])){
                  echo '<span class="lt-banner-two__count">';
                     echo $term->count . '&nbsp;';
                     echo ($term->count < 2 ? $settings['show_number_one_text'] : $settings['show_number_text']);
                  echo '</span>';
               }
            } 

            if($image_url){ 
               echo '<div class="lt-banner-two__image">';
                  echo '<img src="' . esc_url($image_url) . '" alt="' . esc_html($title_text) . '" />';
               echo '</div>';
            }

            echo '<div class="lt-banner-two__content">';
               if($subtitle_text){
                  echo '<div class="lt-banner-two__subtitle">' . esc_html($subtitle_text) . '</div>';
               }
               if($title_text){
                  echo '<h3 class="lt-banner-two__title">' . $title_text . '</h3>';
               }
               if($link){
                  echo '<a class="lt-banner-two__btn btn-white"' . $target . ' href="' . esc_url($link) . '">' . esc_html($settings['btn_title']) . '</a>';
               }
            echo '</div>';

            if($link){ 
               echo '<a class="lt-banner-two__link"' . $target . ' href="' . esc_url($link) . '"></a>';
            }
         echo '</div>';
      echo '</div>';
   } 
?>

<?php 
   if($style == 'style-3'){
      echo '<div class="lt-banner-three__single text-' . $settings['content_align'] . '">';
         echo '<div class="lt-banner-three__wrap">';
            
            if ( $settings['show_number_content'] == 'yes' && $term ) {
               if(!empty($settings['term_slug'])){
                  echo '<span class="lt-banner-three__count">';
                     echo $term->count . '&nbsp;';
                     echo ($term->count < 2 ? $settings['show_number_one_text'] : $settings['show_number_text']);
                  echo '</span>';
               }
            } 

            if($image_url){ 
               echo '<div class="lt-banner-three__image">';
                  echo '<img src="' . esc_url($image_url) . '" alt="' . esc_html($title_text) . '" />';
               echo '</div>';
            }

            echo '<div class="lt-banner-three__content">';
               if($subtitle_text){
                  echo '<div class="lt-banner-three__subtitle">' . esc_html($subtitle_text) . '</div>';
               }
               if($title_text){
                  echo '<h3 class="lt-banner-three__title">' . $title_text . '</h3>';
               }
            echo '</div>';

            if($link){ 
               echo '<a class="lt-banner-three__link"' . $target . ' href="' . esc_url($link) . '"></a>';
            }
         echo '</div>';
      echo '</div>';
   } 
?>