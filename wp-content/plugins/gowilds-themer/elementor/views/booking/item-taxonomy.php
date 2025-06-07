<?php
   use Elementor\Icons_Manager;

   if (!defined('ABSPATH')){ exit; }

   global $gowilds_post;

   if (!$gowilds_post){ return; }

   if ($gowilds_post->post_type != BABE_Post_types::$booking_obj_post_type){ return;}

   $ba_post = BABE_Post_types::get_post($gowilds_post->ID);

   $taxonomy_slug = $settings['taxonomy_slug'];

   $has_icon = ! empty( $settings['selected_icon']['value']);

   $terms_value = get_the_terms($gowilds_post->ID, 'ba_amenities');

?>

   <div class="gowilds-single-taxonomy slug-<?php echo esc_attr($taxonomy_slug) ?> <?php echo esc_attr($settings['style']) ?>">
      <div class="content-inner">
         <div class="icon">
            <?php if ($has_icon){ ?>
               <?php Icons_Manager::render_icon($settings['selected_icon'], ['aria-hidden' => 'true']); ?>
            <?php } ?>
         </div>
         <div class="box-content">
            <?php 
               
               if( empty($taxonomy_slug) ){ 
                  if($settings['title_text']){ 
                     echo '<h4 class="ba-meta-title">' . esc_html($settings['title_text']) . '</h4>';
                  }
                  echo '<div class="item-value">' . esc_html__('N/A', 'gowilds-themer') . '</div>';
               }

               if( ($taxonomy_slug == 'amenities' || $taxonomy_slug == 'features' ||  $taxonomy_slug == 'car-amenities' || $taxonomy_slug == 'car-feautures') && $settings['style'] == 'style-2'){
                  $terms_value = get_the_terms($gowilds_post->ID, 'ba_' . $taxonomy_slug);

                  if(!empty($terms_value)){
                     if($settings['title_text']){
                        echo '<h4 class="ba-meta-title">' . esc_html($settings['title_text']) . '</h4>';
                     }
                     foreach ($terms_value as $term){
                        if(isset($term->term_id)){
                           $term_icon = get_term_meta($term->term_id, 'fa_class', true);
                           $term_icon_image = get_term_meta($term->term_id, 'image', true);
                           $term_icon_width = get_term_meta($term->term_id, 'image_width', true);
                           echo '<div class="term-item">';
                              if($term_icon_image){
                                 echo '<img class="term-icon-image" src="' . $term_icon_image . '" style="max-width: 35px;"/>';
                              }else{
                                 echo ($term_icon ? '<i class="' . $term_icon . '"></i>' : '');
                              }
                              echo esc_html($term->name);
                           echo '</div>';
                        }
                     }
                  }
                     
               }else{
                  if($settings['title_text']){ 
                     echo '<h4 class="ba-meta-title">' . esc_html($settings['title_text']) . '</h4>';
                  }
                  $value = get_the_term_list($gowilds_post->ID, BABE_Post_types::$attr_tax_pref . $taxonomy_slug, '', ', ');
                  if(!is_wp_error($value)){
                     echo '<div class="item-value">' . ($value) . '</div>';
                  }
               }

            ?>
         </div>
      </div>
   </div>

