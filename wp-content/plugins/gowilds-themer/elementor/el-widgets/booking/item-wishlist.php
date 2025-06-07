<?php
if (!defined('ABSPATH')) { exit; }

use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;

class GVAElement_BA_Item_Wishlist extends GVAElement_Base{
	 
	const NAME = 'gva_ba_item_wishlist';
	const TEMPLATE = 'booking/item-wishlist';
	const CATEGORY = 'gowilds_ba_booking';

	public function get_categories() {
		return array(self::CATEGORY);
	}

	public function get_name() {
		return self::NAME;
	}

	public function get_title() {
		return __('BA Item Wishlist', 'gowilds-themer');
	}

	public function get_keywords() {
		return [ 'booking', 'ba', 'item', 'book everthing', 'wishlist' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			self::NAME . '_content',
			[
				'label' => __('Content', 'gowilds-themer'),
			]
		);

		$this->end_controls_section();

	}

	protected function render(){
		parent::render();
		
		global $gowilds_post;

   	if(!$gowilds_post){ return; }

  	 	if($gowilds_post->post_type != BABE_Post_types::$booking_obj_post_type){ return;}

		$settings = $this->get_settings_for_display();
		printf('<div class="gowilds-%s gowilds-element">', $this->get_name());
			echo '<div class="wishlist-btn__single">';
				if(class_exists('Gowilds_Addons_Wishlist_Ajax')){ 
         		echo Gowilds_Addons_Wishlist_Ajax::html_icon($gowilds_post->ID, esc_html__('Wishlist', 'gowilds-themer'));
         	} 
			echo '</div>';
		print '</div>';
	}
}

$widgets_manager->register(new GVAElement_BA_Item_Wishlist());
