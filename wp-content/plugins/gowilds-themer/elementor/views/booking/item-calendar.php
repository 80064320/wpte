<?php
   use Elementor\Icons_Manager;

   if (!defined('ABSPATH')){ exit; }

   global $gowilds_post;

   if (!$gowilds_post){ return; }

   if ($gowilds_post->post_type != BABE_Post_types::$booking_obj_post_type){ return;}

   $ba_post = BABE_Post_types::get_post($gowilds_post->ID);

   $post_id = $gowilds_post->ID;

   $av_cal = BABE_Calendar_functions::get_av_cal($post_id);

   if (empty($av_cal)){ return; }

   $date_now_obj = BABE_Functions::datetime_local();

   $rules_cat = BABE_Booking_Rules::get_rule_by_obj_id( $post_id );

   //// get discount
   $discount_arr = BABE_Post_types::get_post_discount( $post_id );

   ///// create calendar by month
   $date_current     = $date_now_obj->format( 'Y-m-01' );
   $date_obj_current = new DateTime( $date_current );
   $date_end         = clone( $date_obj_current );
   $date_end->modify( '+' . absint( BABE_Settings::$settings['av_calendar_max_months'] ) . ' months' );
   $interval   = new DateInterval('P1M');
   $daterange  = new DatePeriod($date_obj_current, $interval, $date_end);
   $i          = 0;

?>

<div class="gowilds-single-calendar">
   <?php if($settings['title_text']){
      echo '<h3 class="title">' . esc_html($settings['title_text']) . '</h3>';
   } ?>
   <div class="box-content">
      <div id="av-cal">
         <?php foreach ($daterange as $date_obj){
            $block_class = ! $i ? 'cal-month-active' : '';
            printf("%s", BABE_html::get_calendar_month_html($date_obj->format( 'Y-m-01' ), $av_cal, $discount_arr, $rules_cat, $block_class));
            $i ++;
         } ?>
      </div>
   </div>
</div>

