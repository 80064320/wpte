<?php 
   global $post;
	$_rand  		= wp_rand(5);
   $post_id = get_the_ID();
   $thumbnail = (isset($thumbnail_size) && $thumbnail_size) ? $thumbnail_size : 'post-thumbnail';
   $excerpt_words = (isset($excerpt_words) && $excerpt_words) ? $excerpt_words : '0';
   $desc = gowilds_limit_words($excerpt_words, get_the_excerpt(), '');
   $content_classes = has_post_thumbnail() ? ' has-thumbnail' : ' has-no-thumbnail';

   // Tour
	$is_featured       = wte_is_trip_featured( $post_id );
	$meta              = \wte_trip_get_trip_rest_metadata( $post_id );
	$wte_global        = get_option( 'wp_travel_engine_settings', true );
	$max_capacity 		 = (int) $meta->max_pax ? esc_html( $meta->min_pax . '-' . $meta->max_pax ) : esc_html( $meta->min_pax );

	$post_meta = get_post_meta( $post_id, 'wp_travel_engine_setting', true );
	$location_address = isset($post_meta['map_address']) && ! empty($post_meta['map_address']) ? $post_meta['map_address'] : '';

	// Media
	$wptravelengine_trip_images = get_post_meta( $post_id, 'wpte_gallery_id', true );
	$images = false;
	if ( isset( $wptravelengine_trip_images[ 'enable' ] ) && '1' === $wptravelengine_trip_images[ 'enable' ] ) {
		if ( ! empty( $wptravelengine_trip_images ) ) {
			unset( $wptravelengine_trip_images[ 'enable' ] );
		}
		if ( ! empty( $wptravelengine_trip_images ) ){
			$images = $wptravelengine_trip_images;
		}
	}
	$enable_video_gallery = $post_meta[ 'enable_video_gallery' ] ?? false;
	$video = '';
	// $video = isset($meta['tour_video']) && ! empty($meta['tour_video']) ? $meta['tour_video'] : false;

	// Discount
	 $discount_label = '';
	if( $meta->discount_percent ){
	 	$discount_label = sprintf( esc_html__( '%1$s%% ', 'gowilds' ), (float) $meta->discount_percent );
	 	$discount_label .= esc_html__( 'Off', 'gowilds' );
	}						
	// Featured
	$featured_label = $is_featured ? esc_html__('Featured', 'gowilds') : '';
	
?>
<div class="booking-three<?php echo esc_attr($content_classes) ?>">
   <div class="booking-three__thumbnail">
   	<?php if(has_post_thumbnail()){ ?>
         <a href="<?php echo esc_url( get_permalink() ) ?>">
            <?php the_post_thumbnail( $thumbnail, array( 'alt' => get_the_title() ) ); ?>
         </a>
         <?php 
	         if($discount_label || $featured_label){
	         	echo '<div class="booking__item-labels">';
	         	if($discount_label){
	         		echo '<span class="booking__item-discount booking__item-label">' . $discount_label . '</span>';
	         	}
	         	if($featured_label){
	         		echo '<span class="booking__item-featured booking__item-label">' . $featured_label . '</span>';
	         	}
	         	echo '</div>';
	         }
         ?> 
   	<?php } ?> 

      <?php 
	   	if($enable_video_gallery || $images){ 
		   	echo '<div class="booking__media booking-three__media">';
	   			if($images){
	            	$i = 1;
	               foreach($images as $image){ 
	               	if ( is_wp_error( $image ) ) {
								continue;
							}
	               	$classes = ($i>1) ? 'hidden' : 'booking-gallery';
	                  if( isset(wp_get_attachment_image_src($image, 'full')[0]) ){ ?>
	                     <a class="<?php echo esc_attr($classes) ?>" href="<?php echo esc_url(wp_get_attachment_image_src($image, 'full')[0]) ?>" data-elementor-lightbox-slideshow="<?php echo esc_attr($_rand) ?>">
	                        <?php 
	                        	if($i == 1){
	                        		echo '<i class="ticon-photo-camera"></i>';
	                        		echo '<span>' . count($images) . '</span>';
	                        	}
	                        ?>
	                     </a>
	                  <?php }  
	                  $i = $i + 1;
	               }
					}
					if ( $enable_video_gallery ) {
						echo do_shortcode( '[wte_video_gallery label="Video" trip_id="'.$post_id.'"]' );
					}
		   	echo '</div>';
		   } 
		?>
   </div>

   <div class="booking-three__content">
   	<div class="booking-three__content-top">
   		<h3 class="title">
         	<a href="<?php echo esc_url( get_permalink() ) ?>" rel="bookmark"><?php the_title() ?></a>
         </h3>
		</div>

      <div class="booking-three__bottom">
	   	
	   	<div class="booking-three__meta-inline">
	      	<?php
	      		$trip_duration_unit   = $meta->duration['duration_unit'];
					$trip_duration_nights = $meta->duration['nights'];
					$set_duration_types   = 'days';
					//$set_duration_types   = $settings['durationType'];
					$duration_mapping      = array(
						'days'   => array( __( 'Day', 'gowilds' ), __( 'Days', 'gowilds' ) ),
						'nights' => array( __( 'Night', 'gowilds' ), __( 'Nights', 'gowilds' ) ),
						'hours'  => array( __( 'Hour', 'gowilds' ), __( 'Hours', 'gowilds' ) ),
					);
					$duration_label       = array();
	      	?>
	      	
	      	<?php if ( $meta->duration['days'] != 0 ) : ?>
					<div class="booking-three__meta-item booking-three__duration">
						<i class="icon fa fa-clock"></i>
						<span class="value">
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
						</span>
					</div>
				<?php endif; ?>

		      <?php if($max_capacity){ ?>
		      	<div class="booking-three__meta-item booking-three__max-capacity">
		      		<i class="icon fa fa-users"></i>
		      		<span class="value"><?php echo esc_html($max_capacity) ?></span>
		      	</div>
		      <?php } ?>
		   </div>

	      <div class="booking-three__price">
      		<div class="booking-three__price-label hidden">
      			<?php 
      				if($discount_label){
							echo '<span class="discount-label">' . esc_html($discount_label) . '</span>';
						}else{
							echo esc_html__('From', 'gowilds');
						}
					?>
      		</div>
				<div class="booking-three__price-number">
					<?php	
						echo '<span class="actual-price">';
							echo wte_esc_price( wte_get_formated_price_html( $meta->has_sale ? $meta->sale_price : $meta->price ) ); 
						echo '</span>';
						if ( $meta->has_sale ) { 
							echo '<span class="striked-price">'; 
								echo wte_esc_price( wte_get_formated_price_html( $meta->price ) ); 
							echo '</span>';
						}
					?>
				</div>
      	</div>
			   
      </div>
   </div>   

   <!-- Main Hover -->
   <div class="booking-three__hover">
   	<h3 class="booking-three__main-title">
      	<a href="<?php echo esc_url( get_permalink() ) ?>" rel="bookmark"><?php the_title() ?></a>
      </h3>
      <?php 
         if($desc){
         	echo '<div class="booking-three__desc">';
         		echo esc_html($desc);
         	echo '</div>';
         } 
      ?>
      <div class="booking-three__meta">
      	<?php 
	   		// Rating
				$review_avg = get_post_meta($post_id, 'lt_reviews_average', true); 
	         if( !empty($review_avg) && class_exists('Gowilds_Listing_Comment') ){ 
	            $review_avg = round( $review_avg, 1 );
					$count_comment = Gowilds_Listing_Comment::instance()->total_reviews($post_id, false, true);
					$review_count = ($count_comment == 1) ? sprintf(esc_html__('(%s Review)', 'gowilds'), $count_comment) : sprintf(esc_html__('(%s Reviews)', 'gowilds'), $count_comment);
	            echo '<div class="booking-three__meta-item booking-three__review">';
		            echo '<i class="icon fa-solid fa-star"></i>';
		            echo '<span class="review-avg">';
		            	echo esc_html($review_avg);
		            echo '</span>';
		            echo '<span class="review-count">';
		            	echo esc_html($review_count);
		            echo '</span>';
		         echo '</div>';
	         }
	      ?> 
	      <?php if($location_address){ ?>
	      	<div class="booking-three__meta-item booking-three__location">
	      		<i class="icon fa-solid fa-location-dot"></i>
	      		<span class="value"><?php echo wp_kses($location_address, true) ?></span>
	      	</div>
	      <?php } ?>
      </div>
   </div>

</div>   

