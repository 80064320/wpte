<?php
/**
 * Content wrappers
 *
 * Closing divs are left out on purpose!.
 *
 * This template can be overridden by copying it to yourtheme/wp-travel-engine/single-trip/trip-content-wrapper-start.php.
 *
 * @package Wp_Travel_Engine
 * @subpackage Wp_Travel_Engine/includes/templates
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$post_id = get_the_ID();
$post_meta = get_post_meta( $post_id, 'wp_travel_engine_setting', true );
$meta              = \wte_trip_get_trip_rest_metadata( $post_id );

$location_address = isset($post_meta['map_address']) && ! empty($post_meta['map_address']) ? $post_meta['map_address'] : '';
$max_capacity 		 = (int) $meta->max_pax ? esc_html( $meta->min_pax . '-' . $meta->max_pax ) : esc_html( $meta->min_pax );

?>
<div class="booking-single"> <!-- Wrap to avoid design issue  -->
		
	<div id="wte-crumbs">
		<?php
			//do_action( 'wp_travel_engine_breadcrumb_holder' );
		?>
	</div>

	<?php
		do_action( 'wp_travel_engine_gallery_before_content' );
	?>
	<div class="trip-info-one">
		<div class="trip-info-one__content">
			<div class="trip-info-one__left">
				<h1 class="trip-title">
					<?php echo get_the_title(); ?>
				</h1>
				<?php if($location_address){ ?>
		      	<div class="trip-info-one__address">
		      		<i class="icon fa-solid fa-location-dot"></i>
		      		<span class="value"><?php echo esc_html($location_address) ?></span>
		      	</div>
		      <?php } ?>
			</div>
			<div class="trip-info-one__right">
				<div class="booking-information">
					
					<?php
		      		$trip_duration_unit   = $meta->duration['duration_unit'];
						$trip_duration_nights = $meta->duration['nights'];
						$set_duration_types   = 'both';
						//$set_duration_types   = $settings['durationType'];
						$duration_mapping      = array(
							'days'   => array( __( 'Day', 'gowilds' ), __( 'Days', 'gowilds' ) ),
							'nights' => array( __( 'Night', 'gowilds' ), __( 'Nights', 'gowilds' ) ),
							'hours'  => array( __( 'Hour', 'gowilds' ), __( 'Hours', 'gowilds' ) ),
						);
						$duration_label       = array();
		      	?>
		      	<?php if ( $meta->duration['days'] != 0 ) : ?>
						<div class="booking-info-block">
							<div class="icon"><i class="fa fa-clock"></i></div>
							<div class="box-content">
								<h5 class="meta-title"><?php echo esc_html__( 'Duration', 'gowilds' ); ?></h5>
								<div class="item-value">
									<?php
										if ( ( 'days' !== $trip_duration_unit ) || ( 'days' === $trip_duration_unit && $meta->duration['days'] && in_array( $set_duration_types, array( 'both', 'days' ) ) ) ) {
											$days = (int)$meta->duration['days'];
											$duration_label[] = sprintf(
												_nx( '%1$d %2$s', '%1$d %3$s', $days, 'trip duration', 'gowilds' ),
												$days,
												$duration_mapping[$trip_duration_unit][0],
												$duration_mapping[$trip_duration_unit][1]
											);
										}
										if ( 'days' === $trip_duration_unit && $trip_duration_nights && in_array( $set_duration_types, array( 'both', 'nights' ) ) ) {
											$duration_label[] = sprintf( _nx( '%1$d Night', '%1$d Nights', (int) $trip_duration_nights, 'trip duration night', 'gowilds' ), (int) $trip_duration_nights );
										}
									?>
									<?php echo esc_html( implode( ' - ', $duration_label ) ); ?>
								</div>
							</div>
						</div>
					<?php endif; ?>

					   <!-- Group Size -->
				  	<?php if ( $max_capacity ) { ?>
				    	<div class="booking-info-block">
				         <div class="icon"><i class="fa fa-users"></i></div>
				         <div class="box-content">
				            <h5 class="meta-title"><?php echo esc_html__( 'Group Size', 'gowilds' ); ?></h5>
				            <div class="item-value"><?php echo esc_html( $max_capacity ) ?></div>
				         </div>
				     </div>
				  	<?php } ?>

				  	<!-- Tour Type -->
				  	<?php 
			  		$location = get_the_term_list($post_id, 'trip_types', '', ', ');
					if(!is_wp_error($location) && !empty($location)){ 
					?>
						<div class="booking-info-block">
				         <div class="icon"><i class="fa fa-users"></i></div>
				         <div class="box-content">
				            <h5 class="meta-title"><?php echo esc_html__( 'Tour Type', 'gowilds' ); ?></h5>
				            <div class="item-value"><?php echo wp_kses( $location, false ); ?></div>
				         </div>
					   </div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>

	<div class="trip-meta-one">
		<div class="trip-meta-one__content">
			<div class="trip-meta-one__left">
				<?php 
         		// Rating
					$review_avg = get_post_meta($post_id, 'lt_reviews_average', true); 
	            if( !empty($review_avg) && class_exists('Gowilds_Listing_Comment') ){ 
	               $review_avg = round( $review_avg, 1 );
						$count_comment = Gowilds_Listing_Comment::instance()->total_reviews($post_id, false, true);
						$suffix_review = $count_comment == 1 ? sprintf(esc_html__('%s by %s Review', 'gowilds'), $review_avg, $count_comment) : sprintf(esc_html__('%s by %s Reviews', 'gowilds'), $review_avg, $count_comment);
	               echo Gowilds_Listing_Comment::instance()->show_star_by_avg($review_avg, '', $suffix_review); 
	            } 
	         ?>
			</div>
			<div class="trip-meta-one__right">
				<?php 
					if(class_exists('Sassy_Social_Share_Shortcodes')){
						echo do_shortcode('[Sassy_Social_Share]');
					}
				?>
			</div>
		</div>
	</div>

	<div id="wp-travel-trip-wrapper" class="trip-content-area">

		<div class="row">
			<div id="primary" class="content-area">
				<?php
