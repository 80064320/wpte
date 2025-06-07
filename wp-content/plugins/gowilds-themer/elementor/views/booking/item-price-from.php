<?php
   use Elementor\Icons_Manager;

   if (!defined('ABSPATH')){ exit; }

   global $gowilds_post;

   if (!$gowilds_post){ return; }

   if ($gowilds_post->post_type != BABE_Post_types::$booking_obj_post_type){ return;}

   $ba_post = BABE_Post_types::get_post($gowilds_post->ID);

   $has_icon = ! empty( $settings['selected_icon']['value']);

   if( !isset($ba_post['discount_price_from']) || !isset($ba_post['price_from']) || !isset($ba_post['discount_date_to']) || !isset($ba_post['discount']) ){
      $price = BABE_Post_types::get_post_price_from($ba_post['ID']);
   }else{
      $price = $ba_post;
   }
?>

<div class="gowilds-single-price_from">
   <div class="content-inner">
      <div class="icon">
         <?php if ($has_icon){ ?>
            <?php Icons_Manager::render_icon($settings['selected_icon'], ['aria-hidden' => 'true']); ?>
         <?php } ?>
      </div>
      <div class="box-content">
         <?php 
            if($settings['title_text']){ 
               echo '<h4 class="ba-meta-title">' . esc_html($settings['title_text']) . '</h4>';
            }
            if($price){
               echo '<div class="item-value">';
                  echo '<div class="ba-price">';
                     echo '<span class="item_info_price_new">' . BABE_Currency::get_currency_price($price['discount_price_from']) . '</span>';
                     if($price['discount_price_from'] < $price['price_from']){
                        echo '<span class="item_info_price_old">' . BABE_Currency::get_currency_price($price['price_from']) . '</span>';
                     }
                  echo '</div>';
               echo '</div>';   
            }
         ?>
      </div>
   </div>
</div>

