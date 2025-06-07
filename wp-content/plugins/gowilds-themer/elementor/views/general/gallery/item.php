<?php
use Elementor\Group_Control_Image_Size;

$image_id = $image['image']['id']; 
$image_url = $image['image']['url'];
$image_url_thumbnail = $image['image']['url'];
if($image_id){
   $attach_url = Group_Control_Image_Size::get_attachment_image_src($image_id, 'image', $settings);
   if($attach_url){
      $image_url_thumbnail = $attach_url;
   }
}
$style = $settings['style'];

if($style == 'style-1'){ 
   echo '<div class="gallery-one__single">';
      if($image_url){
         echo '<div class="gallery-one__image">';
            echo '<img src="' . esc_url($image_url_thumbnail) . '" alt="' . esc_html($image['title']) . '" />';  
         echo '</div>';
         echo '<a class="gallery-one__photo photo-gallery" href="' . esc_url($image_url) . '" data-elementor-lightbox-slideshow="gallery-' . esc_attr($_random) . '"></a>';
      }
      echo '<div class="gallery-one__content">';
         echo '<div class="gallery-one__content-inner">';
            echo '<span class="gallery-one__icon"><i class="fas fa-plus"></i></span>';
            if($image['title']){
               echo '<h3 class="gallery-one__title">' . esc_html($image['title']) . '</h3>';
            }
            if($image['sub_title']){
               echo '<div class="gallery-one__sub-title">' . esc_html($image['sub_title']) . '</div>';
            }
         echo '</div>';
      echo '</div>';
   echo '</div>';
}

if($style == 'style-2'){ 
   echo '<div class="gallery-two__single">';
      if($image_url){
         echo '<div class="gallery-two__image">';
            echo '<img src="' . esc_url($image_url_thumbnail) . '" alt="' . esc_html($image['title']) . '" />';  
         echo '</div>';
         echo '<a class="gallery-two__photo photo-gallery" href="' . esc_url($image_url) . '" data-elementor-lightbox-slideshow="gallery-' . esc_attr($_random) . '">';
            echo '<i class="las la-expand"></i>';
         echo '</a>';
      }
   echo '</div>';
}
