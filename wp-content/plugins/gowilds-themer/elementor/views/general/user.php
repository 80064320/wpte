<?php
   use Elementor\Icons_Manager;
   
   $_random = gaviasthemer_random_id();

   $this->add_render_attribute( 'block', 'class', [ 'user-one__single', ' text-' . $settings['align'] ] );
   $source = $settings['source'] ? $settings['source'] : 'babe';       
?>

<div <?php echo $this->get_render_attribute_string( 'block' ) ?>>
   <?php if(is_user_logged_in()){ ?>
      <?php
         $user_id = get_current_user_id();
         $user_info = wp_get_current_user();
         $menu_html = '';

         if($source == 'babe'){
            if ($user_info->ID > 0 && class_exists('BABE_My_account')){
               $check_role = BABE_My_account::validate_role($user_info);

               $nav_arr = BABE_My_account::get_nav_arr($check_role);
               $nav_activity = isset($nav_arr['activity']) ? $nav_arr['activity'] : false;
               
               if(isset($nav_arr['activity']['title'])){ 
                  $nav_arr['activity']['title'] = ''; 
               }
               if(isset($nav_arr['post_to_book']['title'])){ 
                  $nav_arr['post_to_book']['title'] = ''; 
               }
               if(isset($nav_arr['profile']['title'])){ 
                  $nav_arr['profile']['title'] = ''; 
               }
               $user_nav = array();

               if(isset($nav_arr['dashboard'])){ 
                  $user_nav['dashboard'] = $nav_arr['dashboard'];
               }

               if(isset($nav_arr['post_to_book'])){ 
                  $user_nav['post_to_book'] = array(
                     'title'              => '',
                     'new-post-to_book'   => $nav_arr['post_to_book']['new-post-to_book'],
                     'all-posts-to_book'  => $nav_arr['post_to_book']['all-posts-to_book']
                  );
               }

               if(isset($nav_arr['activity'])){ 
                  $user_nav_2['activity'] = $nav_arr['activity'];
               }

               if(isset($nav_arr['profile'])){ 
                  $user_nav_2['profile'] = $nav_arr['profile'];
               }

               if(isset($nav_arr['logout'])){ 
                  $user_nav_2['logout'] = $nav_arr['logout'];
               }

               $menu_html .= '<div class="my_account_nav">';
                  
                  $menu_html .= '<div class="hi-account">' . $settings['hi_text'] . $user_info->display_name . '</div>';

                  $menu_html .= BABE_My_account::get_nav_html($user_nav, '', 1);
                  $menu_html .= '
                     <ul class="my_account_nav_list">
                        <li class="my_account_nav_item my_account_nav_wishlist">
                           <a href="' . BABE_Settings::get_my_account_page_url() . '?inner_page=posts-wishlist">
                              <span class="my_account_nav_item_title">
                                 <i class="my_account_nav_item_icon lar la-heart"></i>'
                                 . esc_html__('Wishlist', 'gowilds-themer') . 
                              '</span>
                           </a>
                        </li>
                     </ul>
                  ';
                  $menu_html .= BABE_My_account::get_nav_html($user_nav_2, '', 1);
               $menu_html .= '</div>';
            }
         } //// end if ($check_role)

         if($source == 'wte'){
            $args = [
               'echo'        => false,
               'menu'        => $settings['menu'],  
               'menu_class'  => 'gva-user-menu clearfix',
               'menu_id'     => 'menu-' . $_random,
               'container'   => 'div'
            ];
            if(class_exists('Gowilds_Walker')){
               $args['walker' ]     = new Gowilds_Walker();
            }
            $menu_html = '<div class="hi-account">' . $settings['hi_text'] . $user_info->display_name . '</div>';
            $menu_html .= wp_nav_menu($args);
         }

      ?>
      <div class="user-one__login-account">
         <div class="user-one__profile">
            <div class="user-one__login-avata">
               <?php  
                  $user_avatar = get_avatar_url($user_id, array('size' => 90));

                  $avatar = get_the_author_meta( '_user_avatar', $user_id);
                  if($avatar){
                     $avatar = wp_get_attachment_image_src( $avatar, 'thumbnail' );
                     if( isset($avatar[0]) && $avatar[0] ){
                        $user_avatar = $avatar[0];
                     }
                  }

                  $avatar_url = !empty($user_avatar) ? $user_avatar : (get_template_directory_uri() . '/images/placehoder-user.jpg');
               ?>
               <img src="<?php echo esc_url($avatar_url) ?>" alt="<?php echo esc_html($user_info->display_name) ?>">
            </div>
         </div>  
         
         <div class="user-one__user-account" >
            <?php echo ($menu_html) ?>
         </div> 

      </div>

   <?php }else{ 
         
         //Login
         $login_link = site_url('/wp-login.php?action=login&redirect_to=' . get_permalink());
         if(class_exists('BABE_Settings') && $source == 'babe'){
            $login_link = BABE_Settings::get_my_account_page_url() . '?action=login';
         } 
         $dashboard_link = '';
         if($source == 'wte' && class_exists('\WPTravelEngine\Plugin')){
            $tf_settings     = get_option( 'wp_travel_engine_settings', array() );
            if(isset($tf_settings['pages']['wp_travel_engine_dashboard_page']) && $tf_settings['pages']['wp_travel_engine_dashboard_page']){
               $dashboard_id = $tf_settings['pages']['wp_travel_engine_dashboard_page'];
               $dashboard_link = get_permalink($dashboard_id);
               if($dashboard_link){
                  $login_link = $dashboard_link . '#login';
               }
            }
         }

         $login_link = !empty($settings['login_link']) ? $settings['login_link'] : $login_link;

         //Register
         $register_link = site_url('/wp-login.php?action=register&redirect_to=' . get_permalink());
         if(class_exists('BABE_Settings') && $source == 'babe'){
            $register_link = BABE_Settings::get_my_account_page_url() . '?action=register';
         } 
         if($source == 'wte' && class_exists('\WPTravelEngine\Plugin')){
            if($dashboard_link){
               $register_link = $dashboard_link . '?signup#signup';
            }
         }

         $register_link = !empty($settings['register_link']) ? $settings['register_link'] : $register_link;
      ?>
      <div class="user-one__login-account without-login">
         <div class="user-one__profile">
            <div class="user-one__avata-icon">
               <?php if($settings['selected_icon']){ ?>
                  <?php Icons_Manager::render_icon( $settings['selected_icon'], [ 'class' => 'icon', 'aria-hidden' => 'true' ] ); ?>
               <?php } ?>
            </div>
         </div>
         <div class="user-one__user-account">
            <ul class="my_account_nav_list">
               <li>
                  <a class="login-link" href="<?php echo esc_url($login_link) ?>">
                     <i class="icon far fa-user"></i>
                     <?php echo esc_html__('Login', 'gowilds-themer') ?>
                  </a>
               </li>
               <li>
                  <a class="register-link" href="<?php echo esc_url($register_link) ?>">
                     <i class="icon fas fa-user-plus"></i> 
                     <?php echo ($settings['register_text'] ? $settings['register_text'] : "Register"); ?>
                  </a>
               </li>
            </ul>
         </div>
      </div>
         
   <?php } ?>
</div>