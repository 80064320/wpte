<?php 
   $register_link = site_url('/wp-login.php?action=register');
   if(class_exists('BABE_Settings')){
      $register_link = BABE_Settings::get_my_account_page_url() . '?action=register';
   }
?>
<div class="modal fade modal-ajax-user-form" id="form-ajax-login-popup" tabindex="-1" role="dialog">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
            <div class="modal-header-form">
               <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
         <div class="modal-body">
            <div class="ajax-user-form">
               <h2 class="title"><?php echo esc_html__('Signin', 'gowilds-themer'); ?></h2>
               <div class="form-ajax-login-popup-content">
                  <?php 
                     if(class_exists('Gowilds_Addons_Login_Ajax')){
                        Gowilds_Addons_Login_Ajax::instance()->html_form();
                     } 
                  ?>
               </div>
               <div class="user-registration">
                  <?php echo esc_html__("Don't have an account", "gowilds-themer"); ?>
                  <a class="registration-popup" href="<?php echo esc_url($register_link) ?>">
                     <?php echo esc_html__('Register', 'gowilds-themer') ?>
                  </a>
               </div>   
            </div>   
         </div>
      </div>
   </div>
</div>

<div class="modal fade modal-ajax-user-form" id="form-ajax-lost-password-popup" tabindex="-1" role="dialog">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header-form">
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="ajax-user-form">
               <h2 class="title"><?php echo esc_html__('Reset Password', 'gowilds-themer'); ?></h2>
               <div class="form-ajax-login-popup-content">
                  <?php
                     if(class_exists('Gowilds_Addons_Forget_Pwd_Ajax')){
                         Gowilds_Addons_Forget_Pwd_Ajax::instance()->html_form();
                     } 
                  ?>
               </div>
             
               <div class="user-registration">
                  <?php echo esc_html__("Don't have an account", "gowilds-themer"); ?>
                  <a class="registration-popup" href="<?php echo esc_url($register_link) ?>">
                     <?php echo esc_html__('Register', 'gowilds-themer') ?>
                  </a>
               </div>   

            </div>   
         </div>
      </div>
   </div>
</div>

