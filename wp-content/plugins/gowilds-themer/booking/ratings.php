<?php
class Gowilds_Booking_Review{
   function __construct(){
      add_filter('babe_init_rating_criteria', array($this, 'init_rating_criteria_filter'), 10, 1);
      add_filter('babe_sanitize_' . BABE_Settings::$option_name, array($this, 'sanitize_settings'), 10, 2);
      add_action( 'admin_init', array( $this, 'settings_rating_criteria' ), 10 );
   }

   public function ratings_criteria() {
      $rating['quality'] = esc_html__('Quality', 'gowilds-themer');
      $rating['location'] = esc_html__('Location', 'gowilds-themer');
      $rating['amenities'] = esc_html__('Amenities', 'gowilds-themer');
      $rating['services'] = esc_html__('Services', 'gowilds-themer');
      $rating['price'] = esc_html__('Price', 'gowilds-themer');
      return apply_filters('gowilds_booking_criteria', $rating);
   }

   public function init_rating_criteria_filter($ratings) {
      $settings_criteria_arr = isset(BABE_Settings::$settings['criteria_arr']) && BABE_Settings::$settings['criteria_arr'] ? BABE_Settings::$settings['criteria_arr'] : false;
      if($settings_criteria_arr){
         $selected = $settings_criteria_arr;
         $ratings = $this->ratings_criteria();
         $results = [];
         if($selected && is_array($selected)){
            foreach ($selected as $value){
               if(array_key_exists($value, $ratings)){
                  $results[$value] = $ratings[$value];
               }
            }
         }
       return $results;
      }
   }

   public function settings_rating_criteria() {
      add_settings_field(
         'criteria_arr',
         __( 'Rating Criteria List', 'gowilds-themer' ),
         array( $this, 'rating_criteria_checkbox_callback' ),
         BABE_Settings::$option_menu_slug, 
         'setting_section_general', 
         array( 'option' => 'criteria_arr', 'settings_name' => BABE_Settings::$option_name ) 
      );
   }

   public function rating_criteria_checkbox_callback($args) {
      $rating_criteria_arr = $this->ratings_criteria();
      if(!$rating_criteria_arr) return false;
      $settings_criteria_arr = isset(BABE_Settings::$settings['criteria_arr']) && BABE_Settings::$settings['criteria_arr'] ? BABE_Settings::$settings['criteria_arr'] : false;

      if($settings_criteria_arr){
         $selected = $settings_criteria_arr;
      }else{
         $selected = [];
      }
      $html = '';
      $i = 1;
      foreach ($rating_criteria_arr as $item=>$value){
         $checked = in_array($item, $selected) ? ' checked="checked"' : '';
         $html .= '<span><input type="checkbox" id="' . $args['option'] . $i. '" name="' . $args['settings_name'] . '[' . $args['option'] . '][]" value="'.$item.'" '.$checked.'/>';
         $html .= '<label for="checkbox_example">'.$value.'</label></span><br>';
         $i++;
      }
      echo $html;
  }

   public function sanitize_settings($new_input, $input) {
      $rating_criteria_arr = isset($input['criteria_arr']) ? (array)$input['criteria_arr'] : array('quality', 'location', 'amenities', 'services', 'price');
      foreach ($rating_criteria_arr as $value){
         $new_input['criteria_arr'][] = $value;
      }
      return $new_input;
   }
   
}

return new Gowilds_Booking_Review();

