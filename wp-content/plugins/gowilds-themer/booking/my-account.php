<?php
class Gowilds_BA_My_Account{
   function __construct(){
      add_filter('babe_myaccount_nav_item_icon_class', array($this, 'get_nav_item_icon'), 1, 2);
      add_filter('template_include', [$this, 'template_include'], 11);
   }
   public static $icons = array(
      'dashboard'             => 'las la-home',
      'profile'               => 'las la-user-circle',
      'edit-profile'          => 'las la-user-edit',
      'company-profile'       => 'las la-building',
      'edit-company-profile'  => 'las la-user-edit',
      'change-password'       => 'las la-unlock',
      'activity'              => 'las la-calendar-check',
      'my-bookings'           => 'las la-calendar',
      'my-orders'             => 'las la-shopping-cart',
      'logout'                => 'las la-sign-out-alt',
      'login'                 => 'las la-sign-in-alt',
      'default'               => 'las la-tag',
      'post_to_book'          => 'las la-calendar',
      'all-posts-to_book'     => 'las la-calendar',
      'new-post-to_book'      => 'las la-plus-circle',
      'post_service'          => 'las la-list-alt',
      'all-posts-service'     => 'las la-list-alt',
      'new-post-service'      => 'las la-plus-circle',
      'post_fee'              => 'las la-random',
      'all-posts-fee'         => 'las la-random',
      'new-post-fee'          => 'las la-plus-circle',
      'post_faq'              => 'las la-comment',
      'all-posts-faq'         => 'las la-comment',
      'new-post-faq'          => 'las la-comment-medical'
   );

   public static function get_nav_item_icon( $output, $item_slug ){
      $output = isset(self::$icons[$item_slug]) ? self::$icons[$item_slug] : self::$icons['default'];
      return $output;
   } 

   public function template_include($template){
      $account_page = intval(BABE_Settings::$settings['my_account_page']);
      if (intval($account_page) === get_the_ID()) {
         return locate_template(array('templates/booking/dashboard.php'));
      }
      return $template;
   }

}

new Gowilds_BA_My_Account();