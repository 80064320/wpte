<?php
/*
 * Type: header_layout, footer_layout, page_layout, post_layout, post_archive_layout
*/
require_once('action.php'); 

class GVA_Template_Layout extends GVA_Layout_Model{
	public $post_type = 'gva__template';
	public $meta_key = 'gva_template_type';
	
   function __construct(){
		add_action('admin_menu', array($this, 'add_admin_menu'));
	}

	public function add_admin_menu(){
		add_menu_page(
			esc_html__('Gowilds Template', 'gowilds-themer'),
			esc_html__('Gowilds Template', 'gowilds-themer'),
			'manage_options',
			'gowilds_layout_template',
			array($this, 'show_options'),
			'',
			2
		);
	}

   public function get_checkboxs_header_footer($template_type = 'header_layout', $layout_id = 0, $value=''){
      $templates = $this->get_templates($template_type);
      $html = '<div class="choose-header-footer">';
         $html .= '<a href="#" class="label">Choose Item</a>';
         $html .= '<div class="content-inner">';
            foreach ($templates as $template) {
               $active = ($value == $template['id']) ? 'active' : '';
               $html .= '<div class="checkbox-item">';
                  $html .= '<a class="control-set-header-footer '.$active.'" href="#" data-title="'.$template['title'].'" data-type="'.$template_type.'" data-id="'.$template['id'].'" data-layout_id="'.$layout_id.'">';
                     $html .= $template['title'] ;
                  $html .= '</a>';   
               $html .= '</div>';
            }
         $html .= '</div>';   
      $html .= '</div>';   
      echo $html;
   }

	public function show_options(){
      wp_enqueue_style('admin-template-layout', GAVIAS_GOWILDS_PLUGIN_URL . 'layout/assets/admin.css'); 
      wp_register_script('admin-template-layout', GAVIAS_GOWILDS_PLUGIN_URL . 'layout/assets/admin.js', array('jquery') ); 
		wp_enqueue_script('admin-template-layout');
		
      // $config = new GVA_Config('page');
      // $config->get_post_config(false);

		wp_localize_script( 'admin-template-layout', 'form_ajax_object', array( 
		  'ajaxurl' => admin_url( 'admin-ajax.php' ),
		  'redirecturl' => home_url(),
		  'security_nonce' => wp_create_nonce( "gowilds_ajax_security_nonce" )
		));
		require_once('templates/layout.php');
	}

}

new GVA_Template_Layout();