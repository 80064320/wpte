<?php
class Gavias_Addon_Form_Ajax{
	
	private static $instance = null;
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function __construct(){
		add_action('init', array($this, 'register_scripts'));
		add_action('gowilds/addons/user', array($this, 'html_form'));
		$this->include_files();
	}

	public function include_files(){
		// require_once('ajax-login.php'); 
		//require_once('ajax-registration.php'); 
		// require_once('ajax-forget-pwd.php'); 
		//require_once('ajax-change-pwd.php'); 
		// require_once('ajax-user.php'); 
		require_once('ajax-wishlist.php'); 
	}

	public static function html_form(){
		if (!is_user_logged_in()) {
			require_once('template.php'); 
		}
		return false;
	}

	public function register_scripts(){
		wp_register_script('ajax-form', GAVIAS_GOWILDS_PLUGIN_URL . 'assets/js/ajax-form.js', array('jquery') ); 
		wp_enqueue_script('ajax-form');
		
		wp_localize_script( 'ajax-form', 'form_ajax_object', array( 
		  'ajaxurl' => admin_url( 'admin-ajax.php' ),
		  'redirecturl' => home_url(),
		  'security_nonce' => wp_create_nonce( "gowilds-ajax-security-nonce" )
		));
	}

}

new Gavias_Addon_Form_Ajax();