<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
 * BABE_shortcodes Class.
 * Shortcodes for the BA Book Everything plugin.
 * 
 * @class 		BABE_shortcodes
 * @version		1.2.0
 * @author 		Booking Algorithms
 */

BABE_shortcodes::init(); 

class BABE_shortcodes {
    
//////////////////////////////
    /**
	 * Hook in tabs.
	 */
    public static function init() {
        
        add_shortcode( 'all-items', array( __CLASS__, 'shortcode_all_items' ) );
        add_shortcode( 'babe-listing', array( __CLASS__, 'shortcode_listing' ) );

        add_shortcode( 'babe-search-form', array( __CLASS__, 'shortcode_search_form' ) );

        add_shortcode( 'babe-booking-form', array( __CLASS__, 'shortcode_booking_form' ) );

        add_shortcode( 'babe-item-stars', array( __CLASS__, 'shortcode_item_stars' ) );

        add_shortcode( 'babe-item-address-map', array( __CLASS__, 'shortcode_item_address_map' ) );

        add_shortcode( 'babe-item-meeting-points', array( __CLASS__, 'shortcode_item_meeting_points' ) );

        add_shortcode( 'babe-item-calendar', array( __CLASS__, 'shortcode_item_calendar' ) );

        add_shortcode( 'babe-item-slideshow', array( __CLASS__, 'shortcode_item_slideshow' ) );

        add_shortcode( 'babe-item-faqs', array( __CLASS__, 'shortcode_item_faqs' ) );

        add_shortcode( 'babe-item-steps', array( __CLASS__, 'shortcode_item_steps' ) );

        add_shortcode( 'babe-item-custom-section', array( __CLASS__, 'shortcode_item_custom_section' ) );

        add_shortcode( 'babe-item-price-from', array( __CLASS__, 'shortcode_item_price_from' ) );

        add_shortcode( 'babe-item-related', array( __CLASS__, 'shortcode_item_related' ) );

        ///// transforms 'babe-' prefix to 'get_' in method name
        add_shortcode( 'babe-order-customer-name', array( __CLASS__, 'shortcode_order_router' ) );

        add_shortcode( 'babe-order-customer-details', array( __CLASS__, 'shortcode_order_router' ) );

        add_shortcode( 'babe-order-items', array( __CLASS__, 'shortcode_order_router' ) );

        add_shortcode( 'babe-order-amount-to-pay', array( __CLASS__, 'shortcode_order_router' ) );

        add_shortcode( 'babe-order-number', array( __CLASS__, 'shortcode_order_router' ) );

        add_shortcode( 'babe-order-admin-notes', array( __CLASS__, 'shortcode_order_router' ) );

        add_shortcode( 'babe-email-button', array( __CLASS__, 'shortcode_order_router' ) );

        add_shortcode( 'babe-email-header-image', array( __CLASS__, 'shortcode_email_header_image' ) );

        add_shortcode( 'babe-email-body-title', array( __CLASS__, 'shortcode_email_body_title' ) );

        add_shortcode( 'babe-email-body-content', array( __CLASS__, 'shortcode_email_body_content' ) );

        add_action( 'wp_ajax_babe_listing_filtered', array( __CLASS__, 'ajax_babe_listing_filtered'));
        add_action( 'wp_ajax_nopriv_babe_listing_filtered', array( __CLASS__, 'ajax_babe_listing_filtered'));

        add_action( 'wp_ajax_babe_listing_update_filters', array( __CLASS__, 'ajax_babe_listing_update_filters'));
        add_action( 'wp_ajax_nopriv_babe_listing_update_filters', array( __CLASS__, 'ajax_babe_listing_update_filters'));
	}

    //////////////////////////
    /**
     * Get email button
     *
     * @param int $order_id
     * @param array $atts
     * @param string $content
     * @param string $tag
     * @return string
     */
    public static function get_email_button($order_id, $atts, $content, $tag ) {

        $args = shortcode_atts( array(
            'title'      => '',
            'type'      => 'home_url',
        ), $atts, $tag );

        switch ($args['type']){
            case 'admin_confirmation_success':
                $output = BABE_html_emails::email_get_row_button( $args['title'], BABE_Order::get_admin_confirmation_page($order_id, 'confirm'), 1);
                break;
            case 'admin_confirmation_reject':
                $output = BABE_html_emails::email_get_row_button( $args['title'], BABE_Order::get_admin_confirmation_page($order_id, 'reject'), 2);
                break;
            case 'admin_confirmation_change':
                $output = BABE_html_emails::email_get_row_button( $args['title'], BABE_Order::get_admin_confirmation_page($order_id, 'change'), 3);
                break;
            case 'customer_confirmation_success':
                $output = BABE_html_emails::email_get_row_button( $args['title'], BABE_Order::get_customer_confirmation_page($order_id, 'confirm'), 1);
                break;
            case 'customer_confirmation_reject':
                $output = BABE_html_emails::email_get_row_button( $args['title'], BABE_Order::get_customer_confirmation_page($order_id, 'reject'), 2);
                break;
            case 'my_account':
                $output = BABE_html_emails::email_get_row_button( $args['title'], BABE_Settings::get_my_account_page_url());
                break;
            case 'pay_now':
                $output = BABE_html_emails::email_get_row_button( $args['title'], BABE_Order::get_order_payment_page($order_id));
                break;
            case 'home_url':
            default:
                $output = BABE_html_emails::email_get_row_button( $args['title'], home_url());
                break;
        }

        return $output;
    }

    //////////////////////////////
    /**
     * Get email body content
     *
     * @param array $atts
     * @param string $content
     * @param string $tag
     * @return string
     */
    public static function shortcode_email_body_content( $atts, $content, $tag ) {

        $args = shortcode_atts( array(
            'title'      => '',
        ), $atts, $tag );

        return BABE_html_emails::email_get_row_content( do_shortcode($content) );
    }

    //////////////////////////////
    /**
     * Get email body title
     *
     * @param array $atts
     * @param string $content
     * @param string $tag
     * @return string
     */
    public static function shortcode_email_body_title( $atts, $content, $tag ) {

        $args = shortcode_atts( array(
            'title'      => '',
        ), $atts, $tag );

        return BABE_html_emails::email_get_row_title( do_shortcode($content) );
    }

    //////////////////////////////
    /**
     * Get email header image
     *
     * @param array $atts
     * @param string $content
     * @param string $tag
     * @return string
     */
    public static function shortcode_email_header_image( $atts, $content, $tag ) {

        $args = shortcode_atts( array(
            'title'      => '',
        ), $atts, $tag );

        return BABE_html_emails::email_get_row_header_image();
    }

    //////////////////////////////
    /**
     * Order items
     *
     * @param int $order_id
     * @param array $atts
     * @param string $content
     * @param string $tag
     * @return string
     */
    public static function get_order_items($order_id, $atts, $content, $tag ) {

        $args = shortcode_atts( array(
            'title'      => '',
        ), $atts, $tag );

        return BABE_html::order_items($order_id);
    }

    //////////////////////////////
    /**
     * Order number
     *
     * @param int $order_id
     * @param array $atts
     * @param string $content
     * @param string $tag
     * @return string
     */
    public static function get_order_number($order_id, $atts, $content, $tag ) {

        $args = shortcode_atts( array(
            'title'      => '',
        ), $atts, $tag );

        return BABE_Order::get_order_number($order_id);
    }

    /** To use in emails */
    public static function get_order_admin_notes($order_id, $atts, $content, $tag ) {

        global $current_screen;

        $admin_to_customer_notes = BABE_Order::get_order_admin_to_customer_notes($order_id);

        if (
            is_admin()
            && !empty($_POST['admin_to_customer_notes'])
            && !empty($current_screen->post_type)
            && $current_screen->post_type === BABE_Post_types::$order_post_type
            && $current_screen->base === 'post'
        ){
            $post_data = sanitize_textarea_field($_POST['admin_to_customer_notes']);
            if ( $post_data !== $admin_to_customer_notes ){
                $admin_to_customer_notes = $post_data;
            }
        }

        return BABE_html_emails::email_wrap_notes(
            $admin_to_customer_notes
        );
    }

    //////////////////////////////
    /**
     * Order amount to pay
     *
     * @param int $order_id
     * @param array $atts
     * @param string $content
     * @param string $tag
     * @return string
     */
    public static function get_order_amount_to_pay($order_id, $atts, $content, $tag ) {

        $args = shortcode_atts( array(
            'title'      => '',
        ), $atts, $tag );

        return BABE_Currency::get_currency_price(BABE_Order::get_order_prepaid_amount($order_id), BABE_Order::get_order_currency($order_id));
    }

//////////////////////////////
    /**
     * Order customer details
     *
     * @param int $order_id
     * @param array $atts
     * @param string $content
     * @param string $tag
     * @return string
     */
    public static function get_order_customer_details($order_id, $atts, $content, $tag ) {

        $args = shortcode_atts( array(
            'title'      => '',
        ), $atts, $tag );

        return BABE_html::order_customer_details($order_id);
    }

//////////////////////////////
    /**
     * Order customer name
     *
     * @param int $order_id
     * @param array $atts
     * @param string $content
     * @param string $tag
     * @return string
     */
    public static function get_order_customer_name($order_id, $atts, $content, $tag) {

        $args = shortcode_atts( array(
            'title'      => '',
        ), $atts, $tag );

        $customer_details = BABE_Order::get_order_customer_details($order_id);

        return $customer_details['first_name'].' '.$customer_details['last_name'];
    }

//////////////////////////////
    /**
     * Order methods router
     *
     * @param $atts
     * @param string $content
     * @param string $tag
     * @return string
     */
    public static function shortcode_order_router($atts, $content, $tag ) {

        global $post; // should be order post

        $output = '';

        if ( empty($post->post_type) || $post->post_type !== BABE_Post_types::$order_post_type) {
            return $output;
        }

        $method = str_replace(array('-', 'babe'), array('_', 'get'), $tag);

        if ( !method_exists(__CLASS__, $method) ){
            return $output;
        }

        return self::$method($post->ID, $atts, $content, $tag);
    }

//////////////////////////////
    /*
     * Item related
     *
     * @param array $atts
     * @param string $content
     *
     * @return string
     */
    public static function shortcode_item_related( $atts, $content = null ) {

        global $post;

        $output = '';

        if ( is_single() && $post->post_type == BABE_Post_types::$booking_obj_post_type) {

            $args = shortcode_atts( array(
                'title'      => '',
            ), $atts, 'babe-item-related' );

            $babe_post = BABE_Post_types::get_post($post->ID);

            $output .= $args['title'] ? '<h3 class="babe_post_content_title">'.esc_html($args['title']).'</h3>' : '';

            $output .= BABE_html::block_related($babe_post);

        }

        return $output;
    }

//////////////////////////////
    /*
     * Item price from
     *
     * @param array $atts
     * @param string $content
     *
     * @return string
     */
    public static function shortcode_item_price_from( $atts, $content = null ) {

        global $post;

        $output = '';

        if ( is_single() && $post->post_type == BABE_Post_types::$booking_obj_post_type) {

            $args = shortcode_atts( array(
                'title'      => '',
            ), $atts, 'babe-item-price-from' );

            $babe_post = BABE_Post_types::get_post($post->ID);

            $output .= BABE_html::block_price_from($babe_post);

        }

        return $output;
    }

//////////////////////////////
    /*
     * Item steps
     *
     * @param array $atts
     * @param string $content
     *
     * @return string
     */
    public static function shortcode_item_steps( $atts, $content = null ) {

        global $post;

        $output = '';

        if ( is_single() && $post->post_type == BABE_Post_types::$booking_obj_post_type) {

            $args = shortcode_atts( array(
                'title'      => '',
            ), $atts, 'babe-item-steps' );

            $babe_post = BABE_Post_types::get_post($post->ID);

            $output .= $args['title'] ? '<h3 class="babe_post_content_title">'.esc_html($args['title']).'</h3>' : '';

            $output .= BABE_html::block_steps($babe_post);

        }

        return $output;
    }

    public static function shortcode_item_custom_section( $atts, $content = null ) {

        global $post;

        $output = '';

        if ( !is_single() || $post->post_type !== BABE_Post_types::$booking_obj_post_type) {
            return $output;
        }

        $args = shortcode_atts( array(
            'title'      => '',
        ), $atts, 'babe-item-custom-section' );

        $babe_post = BABE_Post_types::get_post($post->ID);

        $output .= BABE_html::block_custom_section($babe_post);

        return $output;
    }

//////////////////////////////
    /*
     * Item faqs
     *
     * @param array $atts
     * @param string $content
     *
     * @return string
     */
    public static function shortcode_item_faqs( $atts, $content = null ) {

        global $post;

        $output = '';

        if ( is_single() && $post->post_type == BABE_Post_types::$booking_obj_post_type) {

            $args = shortcode_atts( array(
                'title'      => '',
            ), $atts, 'babe-item-faqs' );

            $babe_post = BABE_Post_types::get_post($post->ID);

            $output .= $args['title'] ? '<h3 class="babe_post_content_title">'.esc_html($args['title']).'</h3>' : '';

            $output .= BABE_html::block_faqs($babe_post);

        }

        return $output;
    }

//////////////////////////////
    /*
     * Item slideshow
     *
     * @param array $atts
     * @param string $content
     *
     * @return string
     */
    public static function shortcode_item_slideshow( $atts, $content = null ) {

        global $post;

        $output = '';

        if ( is_single() && $post->post_type == BABE_Post_types::$booking_obj_post_type) {

            $args = shortcode_atts( array(
                'title'      => '',
            ), $atts, 'babe-item-slideshow' );

            $babe_post = BABE_Post_types::get_post($post->ID);

            $output .= BABE_html::block_slider($babe_post);

        }

        return $output;
    }

//////////////////////////////
    /*
     * Item calendar
     *
     * @param array $atts
     * @param string $content
     *
     * @return string
     */
    public static function shortcode_item_calendar( $atts, $content = null ) {

        global $post;

        $output = '';

        if ( is_single() && $post->post_type == BABE_Post_types::$booking_obj_post_type) {

            $args = shortcode_atts( array(
                'title'      => '',
            ), $atts, 'babe-item-calendar' );

            $babe_post = BABE_Post_types::get_post($post->ID);

            $output .= $args['title'] ? '<h3 class="babe_post_content_title">'.esc_html($args['title']).'</h3>' : '';

            $output .= BABE_html::block_calendar($babe_post);

        }

        return $output;
    }

//////////////////////////////
    /*
     * Item meeting points
     *
     * @param array $atts
     * @param string $content
     *
     * @return string
     */
    public static function shortcode_item_meeting_points( $atts, $content = null ) {

        global $post;

        $output = '';

        if ( is_single() && $post->post_type == BABE_Post_types::$booking_obj_post_type) {

            $args = shortcode_atts( array(
                'title'      => '',
            ), $atts, 'babe-item-meeting-points' );

            $babe_post = BABE_Post_types::get_post($post->ID);

            $output .= $args['title'] ? '<h3 class="babe_post_content_title">'.esc_html($args['title']).'</h3>' : '';

            $output .= BABE_html::block_meeting_points($babe_post);

        }

        return $output;
    }

//////////////////////////////
    /*
     * Item address map
     *
     * @param array $atts
     * @param string $content
     *
     * @return string
     */
    public static function shortcode_item_address_map( $atts, $content = null ) {

        global $post;

        $output = '';

        if ( is_single() && $post->post_type == BABE_Post_types::$booking_obj_post_type) {

            $args = shortcode_atts( array(
                'title'      => '',
            ), $atts, 'babe-item-address-map' );

            $babe_post = BABE_Post_types::get_post($post->ID);

            $output .= $args['title'] ? '<h3 class="babe_post_content_title">'.esc_html($args['title']).'</h3>' : '';

            $output .= BABE_html::block_address_map($babe_post);

        }

        return $output;
    }

//////////////////////////////
    /*
     * Item stars
     *
     * @param array $atts
     * @param string $content
     *
     * @return string
     */
    public static function shortcode_item_stars( $atts, $content = null ) {

        global $post;

        $output = '';

        if ( is_single() && $post->post_type == BABE_Post_types::$booking_obj_post_type) {

            $args = shortcode_atts( array(
                'title'      => '',
            ), $atts, 'babe-item-stars' );

            $output .= BABE_Rating::post_stars_rendering($post->ID);

        }

        return $output;
    }

//////////////////////////////
    /*
     * Booking form
     *
     * @param array $atts
     * @param string $content
     *
     * @return string
     */
    public static function shortcode_booking_form( $atts, $content = null ) {

        $output = '';

        $args = shortcode_atts( array(
            'title'      => '',
        ), $atts, 'babe-booking-form' );

        $output .= $args['title'] ? '<h3 class="babe_post_content_title">'.esc_html($args['title']).'</h3>' : '';

        $output .= BABE_html::booking_form();

        return $output;
    }

//////////////////////////////
    /*
     * Search form
     *
     * @param array $atts
     * @param string $content
     *
     * @return string
     */
    public static function shortcode_search_form( $atts, $content = null ) {

        $output = '';

        $args = shortcode_atts( array(
            'title'      => '',
        ), $atts, 'babe-search-form' );

        $output .= BABE_Search_From::render_form($args['title']);

        return $output;
    }
    
//////////////////////////////
        /*
		 * Gets all items.
		 * 
		 * @param array $atts
		 * @param string $content
		 *
		 * @return string
		 */
		public static function shortcode_all_items( $atts, $content = null ) {
			
			$output = '';
            
            $args = shortcode_atts( self::get_babe_listing_default_shortcode_args(), $atts, 'all-items' );

            $args['pagination'] = (int)$args['pagination'];

            if (!$args['pagination']){
                $args['paged'] = 1;
            }
            
            if (!$args['date_to']){
                $date_to_obj = new DateTime('+10 years');
                $args['date_to'] = $date_to_obj->format(BABE_Settings::$settings['date_format']);
            }

            $post_args = apply_filters('babe_shortcode_all_items_post_args', self::get_babe_listing_post_args($args) );

            $image_url = !empty( $args['bg_img_id'] ) ? wp_get_attachment_image_url( (int)$args['bg_img_id'], 'large') : $args['bg_img_url'];
			
			$bg_style = $image_url ? $bg_style = "style=\"background-image: url('" . esc_url( $image_url ) . "');\"" : '' ;
			
			$classes = $args['classes'] ?: '';
			
			$fa_icon = $args['fa_icon'] ? '<i class="' . esc_attr($args['fa_icon']) . '"></i>' : '';
			
			$content = $content ? '<div class="babe_shortcode_block_description">' . $content . '</div>' : '';

            $posts = BABE_Post_types::get_posts($post_args);
            $posts_pages = BABE_Post_types::$get_posts_pages;

            foreach($posts as $post) {
                $output .= BABE_html::get_post_preview_html($post, $args['view']);
            }

            $pagination = '';

            if ( $args['pagination'] ){
                $pagination = BABE_Functions::pager($posts_pages);
            }
			
			$output = apply_filters('babe_shortcode_all_items_html', '
				<div class="babe_shortcode_block sc_all_items ' . esc_attr($classes) . '" ' . $bg_style . '>
					<div class="babe_shortcode_block_bg_inner">
						<h2 class="babe_shortcode_block_title">' . $fa_icon . esc_html($args['title']) . '</h2>
						' . $content . '
						<div class="babe_shortcode_block_inner">
							' . $output . '
						</div>'.$pagination.'
					</div>
				</div>
			', $args, $post_args);
			
			return $output;
		}

    public static function shortcode_listing( $atts, $content = null ) {

        $args = shortcode_atts( self::get_babe_listing_default_shortcode_args(), $atts, 'babe-listing' );

        if( empty($args['sort_by']) ){
            $args['sort_by'] = $args['sortby'];
        }

        $args['pagination'] = (int)$args['pagination'];

        if (!$args['pagination']){
            $args['paged'] = 1;
        }

        if (!$args['date_to']){
            $date_to_obj = new DateTime('+10 years');
            $args['date_to'] = $date_to_obj->format(BABE_Settings::$settings['date_format']);
        }

        $args = BABE_Post_types::sort_args_to_search_filter_arg( $args );

        $post_args = apply_filters('babe_shortcode_listing_post_args', self::get_babe_listing_post_args($args) );

        $listing_filtered_content = self::get_babe_listing_filtered_content($args);

        if ( empty( $listing_filtered_content ) ) {
            $listing_filtered_content = __( 'No results were found for your request', 'ba-book-everything' );
        }

        $image_url = !empty( $args['bg_img_id'] ) ? wp_get_attachment_image_url( (int)$args['bg_img_id'], 'large') : $args['bg_img_url'];

        $bg_style = $image_url ? "style=\"background-image: url('" . esc_url( $image_url ) . "');\"" : '' ;

        $classes = $args['classes'] ?: '';

        if( $bg_style ){
            if( $classes ){
                $classes .= ' ';
            }
            $classes .= 'babe_shortcode_block_with_bg';
        }

        $fa_icon = $args['fa_icon'] ? '<i class="' . esc_attr($args['fa_icon']) . '"></i>' : '';

        $content = $content ? '<div class="babe_shortcode_block_description">' . $content . '</div>' : '';

        $filters_button = '';
        $modal_filters = self::get_babe_listing_filters($args);

        if( $modal_filters ){
            $modal_filters = '<div id="babe_overlay_container">
            <div class="babe_overlay_inner">
              <span id="modal_close"><i class="fas fa-times"></i></span>
              
                <h3>'.__('Filters', 'ba-book-everything').'</h3>
                <div class="babe_shortcode_babe_listing_filters_container">
                '.$modal_filters.'
                </div>
                <div>
                    <button id="babe_shortcode_babe_listing_filters_button_apply" class="btn button">'.__('Apply filters', 'ba-book-everything').'</button>
                </div>  

            </div>
          </div>
          <div id="babe_overlay"></div>';

            $filters_button = '<button class="btn babe_shortcode_babe_listing_filters_button">
                  <i class="fas fa-sliders-h"></i> '.esc_html__('Filters', 'ba-book-everything').' 
                  </button>';
        }

        $sort_by_filter = (int)$args['with_sorting_option'] === 1
            ? BABE_html::get_search_filter_html($args['search_results_sort_by']) : '';

        $title = $args['title']
            ? '<h2 class="babe_shortcode_block_title">' . $fa_icon . esc_html($args['title']) . '</h2>'
            : '';

        $output = apply_filters('babe_shortcode_listing_html', '
            <div class="babe_shortcode_babe_listing" data-args="'.htmlspecialchars(json_encode($args), ENT_QUOTES | JSON_HEX_APOS, 'UTF-8').'" 
            data-dynamic="'.(int)$args['dynamic_filters'].'"
            data-filter-sort-by="'.esc_attr($args['search_results_sort_by']).'"
            >
                <div class="babe_shortcode_babe_listing_filters">
                  '.$filters_button.'
                  <div class="babe_shortcode_babe_listing_filters_content">
                  '.$modal_filters.'
                  </div>
                  <div class="babe_search_results_filters">
                    '.$sort_by_filter.'
                  </div>
                </div>
				<div class="babe_shortcode_block ' . esc_attr($classes) . '" ' . $bg_style . '>
					<div class="babe_shortcode_block_bg_inner">
						' . $title . '
						' . ($content ?? '') . '
						<div class="babe_shortcode_block_inner babe_shortcode_block_content">
							' . $listing_filtered_content . '
						</div>
					</div>
				</div>
			</div>
			', $args, $post_args);

        return $output;
    }

    public static function get_babe_listing_filters( array $args ): string
    {
        global $wpdb;

        if ( empty($args['filter_taxonomies']) ) {
            return '';
        }

        $filters = '';

        $filter_taxonomies = explode(",", $args['filter_taxonomies']);
        $filter_taxonomies = array_map('intval', $filter_taxonomies);
        $filter_taxonomies = array_unique($filter_taxonomies);

        $term_ids = [];

        if ( $args['term_ids'] ) {
            $term_ids = explode(",", $args['term_ids']);
            $term_ids = array_map('intval', $term_ids);
            $term_ids = array_unique($term_ids);
        }

        $term_taxonomy_id = '';

        if( (int)$args['dynamic_filters'] === 1 && !empty($term_ids) ){

            $term_taxonomy_id = [];

            $query = "SELECT object_id FROM ".$wpdb->term_relationships."
                    WHERE term_taxonomy_id IN (".implode( ',', $term_ids ).")
                    GROUP BY object_id
                    ";

            $object_ids = $wpdb->get_col( $query );

            if( !empty($object_ids) ){
                $query = "SELECT tr.term_taxonomy_id, tt.parent tr FROM ".$wpdb->term_relationships."
                    INNER JOIN ".$wpdb->term_taxonomy." tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
                    WHERE tr.object_id IN (".implode( ',', $object_ids ).")
                    GROUP BY tr.term_taxonomy_id
                    ";
                $result = $wpdb->get_results( $query, ARRAY_A );
                $term_taxonomy_id = array_unique(array_column($result, 'term_taxonomy_id'));
                $parents = array_column($result, 'parent');
                if( !empty($parents) ){
                    $parents = array_unique($parents);
                    $term_taxonomy_id = array_merge($term_taxonomy_id, $parents);
                }
            }
        }

        foreach( $filter_taxonomies as $taxonomy_id ){

            if ( !isset(BABE_Post_types::$taxonomies_list[$taxonomy_id]) ){
                continue;
            }

            $taxonomy = BABE_Post_types::$taxonomies_list[$taxonomy_id]['slug'];
            $id = 'filter_'.$taxonomy;

            $terms_children_hierarchy_args = array(
                'taxonomy' => $taxonomy,
                'level' => 0,
                'view' => 'multicheck', // 'select', 'multicheck' or 'list'
                'id' => $id,
                'class' => 'babe-search-filter-terms',
                'name' => $id,
                'term_id_name' => 'term_taxonomy_id',
                'hide_empty' => true,
                'term_taxonomy_id' => $term_taxonomy_id,
            );

            $terms_content = BABE_Post_types::get_terms_children_hierarchy($terms_children_hierarchy_args, $term_ids);

            if( empty($terms_content) ){
                continue;
            }

            $filters .= '
                    <div class="babe_shortcode_babe_listing_filter_terms">
                      <div class="babe_shortcode_babe_listing_filter_terms_title">'
                .esc_html(BABE_Post_types::$taxonomies_list[$taxonomy_id]['name'])
                .'</div>
                      <div class="babe_shortcode_babe_listing_filter_terms_content">'
                .$terms_content
                .'</div>
                    </div>';
        }

        return $filters;
    }

    public static function get_babe_listing_default_shortcode_args(): array
    {
        return array(
            'title'      => '',
            'ids'        => '',
            'category_ids' => '', //// term_taxonomy_ids from categories
            'term_ids' => '', //// term_taxonomy_ids from custom taxonomies in $taxonomies_list
            'per_page'   => BABE_Settings::$settings['posts_per_taxonomy_page'],
            'pagination' => 0,
            'view' => 'grid',
            'fa_icon'    => '',
            'sort'       => 'price_from', /// price_from, rating, post_title, av_date_from, post_date, post_modified, menu_order
            'sortby'     => 'ASC',
            'search_results_sort_by' => 'price_asc',
            'classes'    => '',
            'bg_img_url' => '',
            'bg_img_id' => '',
            'date_from' => '', //// d/m/Y or m/d/Y format
            'date_to' => '',
            'post_author' => 0,
            'keyword' => '',
            'return_total_count' => 1,
            'without_av_check' => 0,
            'group_results_by_date' => 0,
            'not_scheduled' => 0,
            'filter_taxonomies' => '',
            'dynamic_filters' => 0,
            'with_sorting_option' => 0,
        );
    }

    public static function get_babe_listing_default_post_args( array $args ): array
    {
        $output = array(
            'sort' => $args['sort'],
            'sort_by' => $args['sortby'],
            'posts_per_page' => (int)$args['per_page'],
            'date_from' => $args['date_from'],
            'date_to' => $args['date_to'],
            'post_author' => (int)$args['post_author'],
            'keyword' => sanitize_text_field($args['keyword']),
            'return_total_count' => (int)$args['return_total_count'],
            'without_av_check' => (int)$args['without_av_check'],
            'group_results_by_date' => (int)$args['group_results_by_date'],
            'not_scheduled' => (int)$args['not_scheduled'],
        );

        if( isset( $args['sort_by'] ) ){
            $output['sort_by'] = $args['sort_by'];
        }

        return $output;
    }

    public static function get_babe_listing_post_args( array $args ): array
    {
        $post_args = self::get_babe_listing_default_post_args($args);

        if ( $args['ids'] ) {
            $ids = explode(",", $args['ids']);
            $ids = array_map('intval', $ids);
            $ids = array_unique($ids);

            if ( ! empty( $ids ) ) {
                $post_args['post__in'] = $ids;
            }
        }

        if ( $args['category_ids'] ) {
            $category_ids = explode(",", $args['category_ids']);
            $category_ids = array_map('intval', $category_ids);
            $category_ids = array_unique($category_ids);

            if ( ! empty( $category_ids ) ) {
                $post_args['categories'] = $category_ids;
            }
        }

        $post_args['terms'] = [];

        if ( $args['term_ids'] ) {
            $term_ids = explode(",", $args['term_ids']);
            $term_ids = array_map('intval', $term_ids);
            $term_ids = array_unique($term_ids);

            if ( ! empty( $term_ids ) ) {
                $post_args['terms'] = $term_ids;
            }
        }

        return $post_args;
    }

    public static function get_babe_listing_filtered_content( array $args, bool $with_pagination = true ): string
    {
        $output = '';

        $args = wp_parse_args( $args, self::get_babe_listing_default_shortcode_args() );

        $args['pagination'] = (int)$args['pagination'];

        if (!$args['pagination']){
            $args['paged'] = 1;
        }

        if (!$args['date_to']){
            $date_to_obj = new DateTime('+10 years');
            $args['date_to'] = $date_to_obj->format(BABE_Settings::$settings['date_format']);
        }

        $post_args = apply_filters('babe_shortcode_listing_post_args', self::get_babe_listing_post_args($args) );

        $posts = BABE_Post_types::get_posts($post_args);
        $posts_pages = BABE_Post_types::$get_posts_pages;

        foreach($posts as $post){
            $output .= BABE_html::get_post_preview_html($post, $args['view']);
        }

        if ( $args['pagination'] && $with_pagination && $output ){
            $output .= BABE_Functions::pager($posts_pages);
        }

        return apply_filters(
            'babe_shortcode_listing_html_content',
            $output,
            $args,
            $post_args
        );
    }

    public static function ajax_babe_listing_filtered(){

        $args = [];

        if (
            isset( $_POST['nonce'], $_POST['page'], $_POST['args'] )
            && wp_verify_nonce( $_POST['nonce'], BABE_html::$nonce_title )
        ){
            $term_ids = !empty( $_POST['term_ids'] ) && is_array($_POST['term_ids']) ? array_map('absint', $_POST['term_ids']) : [];

            $args = [];

            if( !empty($_POST['args']) && is_array($_POST['args']) ){
                foreach ($_POST['args'] as $arg_key => $arg_value){
                    $args[sanitize_key($arg_key)] = is_array($arg_value) ? array_map('absint', $arg_value) : sanitize_text_field($arg_value);
                }
            }

            $args['term_ids'] = implode(',', $term_ids);

            if( !empty( $_POST['page'] ) ){
                set_query_var( 'paged', absint($_POST['page']) );
            }

            if( !empty( $_POST['listing_search_results_sort_by'] ) ){
                $args['search_results_sort_by'] = sanitize_key($_POST['listing_search_results_sort_by']);
                $args = BABE_Post_types::search_filter_to_get_posts_args($args);
            }
        }

        $listing_filtered_content = self::get_babe_listing_filtered_content($args);

        if ( empty( $listing_filtered_content ) ) {
            $listing_filtered_content = __( 'No results were found for your request', 'ba-book-everything' );
        }

        $output = [
            'listing_filtered_content' => $listing_filtered_content,
            'sort_by_filter' => BABE_html::get_search_filter_html($args['search_results_sort_by'] ?? 'price_asc'),
        ];

        echo json_encode($output);
        wp_die();
    }

    public static function ajax_babe_listing_update_filters(){

        $args = [];

        if (
            isset( $_POST['nonce'], $_POST['args'] )
            && wp_verify_nonce( $_POST['nonce'], BABE_html::$nonce_title )
        ){
            $term_ids = !empty( $_POST['term_ids'] ) && is_array($_POST['term_ids']) ? array_map('absint', $_POST['term_ids']) : [];

            $args = [];

            if( !empty($_POST['args']) && is_array($_POST['args']) ){
                foreach ($_POST['args'] as $arg_key => $arg_value){
                    $args[sanitize_key($arg_key)] = is_array($arg_value) ? array_map('absint', $arg_value) : sanitize_text_field($arg_value);
                }
            }

            $args['term_ids'] = implode(',', $term_ids);
        }

        $args = wp_parse_args( $args, self::get_babe_listing_default_shortcode_args() );
        echo self::get_babe_listing_filters($args);
        wp_die();
    }
        
//////////////////////////////
		/**
		 * Gets posts tile view.
		 * 
		 * @param array $post_args
		 * 
		 * @return string
		 */
		public static function get_posts_tile_view($post_args) {
		     
            $output = '';
             
            $posts = BABE_Post_types::get_posts( $post_args );
			
			$thumbnail = apply_filters('babe_shortcodes_all_item_thumbnail', 'ba-thumbnail');
            $excerpt_length = apply_filters('babe_shortcodes_all_item_excerpt_length', 13);
			
			foreach( $posts as $post ) {
             
             $image_srcs = wp_get_attachment_image_src( get_post_thumbnail_id( $post['ID'] ), $thumbnail );
				
			 $item_url = BABE_Functions::get_page_url_with_args($post['ID'], $_GET);
				
			 $image = $image_srcs ? '<a href="' . $item_url . '"><img src="' . $image_srcs[0] . '"></a>' : '';
				
			 $price_old = $post['discount_price_from'] < $post['price_from'] ? '<span class="item_info_price_old">' . BABE_Currency::get_currency_price( $post['price_from'] ) . '</span>' : '';
				
			 $discount = $post['discount'] ? '<div class="item_info_price_discount">-' . $post['discount'] . '%</div>' : '';
				
			 $babe_post = BABE_Post_types::get_post( $post['ID'] );
				
			 $output .= apply_filters('babe_shortcode_all_items_item_html', '
					<div class="babe_all_items_item">
						<div class="babe_all_items_item_inner">
							<div class="item_img">
								'.$image.'
							</div>
							<div class="item_text">
                                <div class="item_title">
                                   <a href="' . $item_url . '">' . apply_filters('translate_text', $post['post_title']) . '</a>
                                   ' . BABE_Rating::post_stars_rendering( $post['ID'] ) . '
                                </div>
								<div class="item_info_price">
									<label>' . __( 'from', 'ba-book-everything' ) . '</label>
									' . $price_old . '
									<span class="item_info_price_new">' . BABE_Currency::get_currency_price( $post['discount_price_from'] ) . '</span>
                                   ' . $discount . ' 
								</div>
								
								<div class="item_description">
									' . BABE_Post_types::get_post_excerpt( $post, $excerpt_length ) . '
								</div>
							</div>
						</div>
					</div>
				', $post, $babe_post);
            }    
            
            return $output;
             
		}        

//////////////////////////////    

}
