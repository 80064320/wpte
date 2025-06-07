<?php 
	use Elementor\Icons_Manager;
   use Elementor\Group_Control_Image_Size;
	$has_icon = !empty($item['selected_icon']['value']);
   $active = ''; // $item['active'] == 'yes' ? ' active' : '';

   // Style 01
   if($settings['style'] == 'style-1'){ 

   	$image_id = $item['image']['id']; 
      $image_url = isset($item['image']['url']) ? $item['image']['url'] : '';
      if($image_id){
         $attach_url = Group_Control_Image_Size::get_attachment_image_src($image_id, 'image', $settings);
         if($attach_url){
            $image_url = $attach_url;
         }
      }

      $link = '';
      if( defined('BABE_VERSION') || class_exists('\WPTravelEngine\Plugin') ){
         $taxonomy = $item['taxonomy'] ? $item['taxonomy'] : 'ba_location'; 
         $term = $link_term = false;
         if( !empty($item['term_slug']) ){
            $term = get_term_by( 'slug', $item['term_slug'], $taxonomy );
            if($term){
               $link_term = get_term_link( $term->term_id, $taxonomy );
            }
         }
         $link = $link_term;
      }
      if( !empty($item['link_custom']) ) $link = $item['link_custom'];

      echo '<div class="banner-one__single' . esc_attr($active) . '">';
         echo '<div class="banner-one__content">';

            if ( ( defined('BABE_VERSION') || class_exists('\WPTravelEngine\Plugin') ) && $settings['show_number_content'] == 'yes' && $term ) {
               if(!empty($settings['term_slug'])){
                  echo '<span class="banner-one__items-count">';
                     echo $term->count . '&nbsp;';
                     echo ($term->count < 2 ? $settings['show_number_one_text'] : $settings['show_number_text']);
                  echo '</span>';
               }
            } 

      		if($image_url){ 
   				echo '<div class="banner-one__image">';
   					echo '<img src="' . esc_url($image_url) . '" alt="' . esc_html($item['title']) . '"/>';
   				echo '</div>';
   			}

   			echo '<div class="banner-one__content-inner">';
               if($item['subtitle']){
                  echo '<div class="banner-one__subtitle banner-two__subtitle">' . $item['subtitle'] . '</div>';
               }
               echo '<div class="banner-one__content-top">';
      				if($item['title']){
      					echo '<h4 class="banner-one__title"><span>' . esc_html($item['title']) . '</span></h4>';
      				}
                  echo '<span class="banner-one__arrow"><i class="fa-solid fa-arrow-right"></i></span>';
               echo '</div>';
   				if($item['desc']){
   					echo '<div class="banner-one__desc">' . $item['desc']  . '</div>';
   				}
   			echo '</div>';

            if($link){
               echo '<a href="' . esc_url($link) . '" class="banner-one__link-overlay"></a>';
            }
   			
   		echo '</div>';
   	echo '</div>';
   } 
   
   // Style 02
   if($settings['style'] == 'style-2'){

      $image_id = $item['image']['id']; 
      $image_url = isset($item['image']['url']) ? $item['image']['url'] : '';
      if($image_id){
         $attach_url = Group_Control_Image_Size::get_attachment_image_src($image_id, 'image', $settings);
         if($attach_url){
            $image_url = $attach_url;
         }
      }

      $link = '';
      if( defined('BABE_VERSION') || class_exists('\WPTravelEngine\Plugin') ){
         $taxonomy = $item['taxonomy'] ? $item['taxonomy'] : 'ba_location'; 
         $term = $link_term = false;
         if( !empty($item['term_slug']) ){
            $term = get_term_by( 'slug', $item['term_slug'], $taxonomy );
            if($term){
               $link_term = get_term_link( $term->term_id, $taxonomy );
            }
         }
         $link = $link_term;
      }
      
      if( !empty($item['link_custom']) ) $link = $item['link_custom'];

      echo '<div class="banner-two__single' . esc_attr($active) . '">';
         echo '<div class="banner-two__wrap">';

            if ( ( defined('BABE_VERSION') || class_exists('\WPTravelEngine\Plugin') ) && $settings['show_number_content'] == 'yes' && $term ) {
               if(!empty($item['term_slug'])){
                  echo '<span class="banner-two__count">';
                     echo $term->count . '&nbsp;';
                     echo ($term->count < 2 ? $settings['show_number_one_text'] : $settings['show_number_text']);
                  echo '</span>';
               }
            } 

            if($image_url){ 
               echo '<div class="banner-two__image">';
                  echo '<img src="' . esc_url($image_url) . '" alt="' . esc_html($item['title']) . '"/>';
               echo '</div>';
            }

            echo '<div class="banner-two__content">';
               echo '<div class="banner-two__content-inner">';
                  if($item['subtitle']){
                     echo '<div class="banner-two__subtitle">' . $item['subtitle'] . '</div>';
                  }
                  if($item['title']){
                     echo '<h4 class="banner-two__title"><span>' . esc_html($item['title']) . '</span></h4>';
                  }
               echo '</div>';
               if($item['desc']){
                  echo '<div class="banner-two__desc">' . $item['desc']  . '</div>';
               }
               echo '<span class="banner-two__arrow"><i class="fa-solid fa-arrow-right"></i></span>';
            echo '</div>';

            if($link){
               echo '<a href="' . esc_url($link) . '" class="banner-two__link-overlay"></a>';
            }
            
         echo '</div>';
      echo '</div>';
   }

    // Style 03
   if($settings['style'] == 'style-3'){

      $image_id = $item['image']['id']; 
      $image_url = isset($item['image']['url']) ? $item['image']['url'] : '';
      if($image_id){
         $attach_url = Group_Control_Image_Size::get_attachment_image_src($image_id, 'image', $settings);
         if($attach_url){
            $image_url = $attach_url;
         }
      }

      $link = '';
      if( defined('BABE_VERSION') || class_exists('\WPTravelEngine\Plugin') ){
         $taxonomy = $item['taxonomy'] ? $item['taxonomy'] : 'ba_location'; 
         $term = $link_term = false;
         if( !empty($item['term_slug']) ){
            $term = get_term_by( 'slug', $item['term_slug'], $taxonomy );
            if($term){
               $link_term = get_term_link( $term->term_id, $taxonomy );
            }
         }
         $link = $link_term;
      }
      if( !empty($item['link_custom']) ) $link = $item['link_custom'];

      echo '<div class="banner-three__single' . esc_attr($active) . '">';
         echo '<div class="banner-three__wrap">';

            if ( ( defined('BABE_VERSION') || class_exists('\WPTravelEngine\Plugin') ) && $settings['show_number_content'] == 'yes' && $term ) {
               if(!empty($item['term_slug'])){
                  echo '<span class="banner-three__count">';
                     echo $term->count . '&nbsp;';
                     echo ($term->count < 2 ? $settings['show_number_one_text'] : $settings['show_number_text']);
                  echo '</span>';
               }
            } 

            if($image_url){ 
               echo '<div class="banner-three__image">';
                  echo '<img src="' . esc_url($image_url) . '" alt="' . esc_html($item['title']) . '"/>';
               echo '</div>';
            }

            echo '<div class="banner-three__content">';
               echo '<div class="banner-three__content-inner">';
                  if($item['subtitle']){
                     echo '<div class="banner-three__subtitle">' . $item['subtitle'] . '</div>';
                  }
                  if($item['title']){
                     echo '<h4 class="banner-three__title"><span>' . esc_html($item['title']) . '</span></h4>';
                  }
               echo '</div>';
               if($item['desc']){
                  echo '<div class="banner-three__desc">' . $item['desc']  . '</div>';
               }
               echo '<span class="banner-three__arrow"><i class="fa-solid fa-arrow-right"></i></span>';
            echo '</div>';

            if($link){
               echo '<a href="' . esc_url($link) . '" class="banner-three__link-overlay"></a>';
            }
            
         echo '</div>';
      echo '</div>';
   } 
?>
