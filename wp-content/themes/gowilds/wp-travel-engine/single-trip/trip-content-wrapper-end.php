<?php
/**
 * Single Trip Content
 *
 * This template can be overridden by copying it to yourtheme/wp-travel-engine/single-trip/trip-content-wrapper-end.php.
 *
 * @package Wp_Travel_Engine
 * @subpackage Wp_Travel_Engine/includes/templates
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$settings                      = get_option( 'wp_travel_engine_settings', array() );
$custom_enquiry_form_shortcode = ( isset( $settings['enquiry_shortcode'] ) && '' !== $settings['enquiry_shortcode'] ) ? $settings['enquiry_shortcode'] : '';

if ( empty( $settings['enquiry'] ) ) {
?>
	<div class="modal fade" id="modal-trip-send-enquiry-mess" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg">
	    	<div class="modal-content">
		      <div class="modal-header">
		        	<h5 class="modal-title"><?php echo esc_html__('Send Us A Message!', 'gowilds') ?></h5>
		        	<button type="button" class="close modal-trip-close" data-dismiss="modal" aria-label="Close">
		          	<span aria-hidden="true">&times;</span>
		        	</button>
		      </div>
		      <div class="modal-body">
			      <?php 
						/**
						 * Custom Enquiry Form Check .
						 *
						 * @since 5.7.1
						 */
						if ( empty( $settings['custom_enquiry'] ) ) {
							do_action( 'wp_travel_engine_enquiry_form' );
						}

						/**
						 * Custom Enquiry Form Check .
						 */
						if ( isset( $settings['custom_enquiry'] ) && ! empty( $settings['custom_enquiry'] ) && ! empty( $custom_enquiry_form_shortcode ) ) {
							/**
							* Check for multiple shortcodes in the custom enquiry form shortcode.
							* If multiple shortcodes are found, then only the first shortcode will be used.
							*/
							preg_match( '/\[([^\]]+)\]/', $custom_enquiry_form_shortcode, $matches );
							if ( ! empty( $matches ) ) {
								?> <div id="wte_enquiry_form_scroll_wrapper" class="wte_enquiry_contact_form-wrap">
								<?php
								echo do_shortcode( '[' . $matches[1] . ']' );
								?>
								</div>
								<?php
							}
						}
					?>
				</div>
	    	</div>
	  	</div>
	</div>
<?php } ?>

<?php 
	if( comments_open(get_the_ID()) || get_comments_number(get_the_ID()) ){
		get_template_part('wp-travel-engine/single-trip/parts/rating-criteria');
      echo '<div class="tour-comment">';
         comments_template();
      echo '</div>';   
   }
?>

</div>
<!-- /#primary -->
<?php
