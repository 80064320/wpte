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
	$destination = get_the_term_list($post_id, 'destination', '', ', ');

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

	// Discount
	 $discount_label = '';
	if( $meta->discount_percent ){
	 	$discount_label = sprintf( esc_html__( '%1$s%% ', 'gowilds' ), (float) $meta->discount_percent );
	 	$discount_label .= esc_html__( 'Off', 'gowilds' );
	}						
	// Featured
	$featured_label = $is_featured ? esc_html__('Featured', 'gowilds') : '';
	
?>
<div class="trip-two<?php echo esc_attr($content_classes) ?>">
   <div class="trip-two__single">
   	<div class="trip-two__wrap">
		   <div class="trip-two__image">
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
		   	<a class="trip-two__overlay" href="<?php echo get_permalink(); ?>"></a>  
		   </div>


		   <div class="trip-two__content">
			   <div class="trip-two__content-inner">
			   	<div class="trip-two__content-top">
				   	<div class="trip__rating">
					   	<?php 
			         		// Rating
								$review_avg = get_post_meta($post_id, 'lt_reviews_average', true); 
				            if( !empty($review_avg) && class_exists('Gowilds_Listing_Comment') ){ 
				               $review_avg = round( $review_avg, 1 );
									$count_comment = Gowilds_Listing_Comment::instance()->total_reviews($post_id, false, true);
									$suffix_review = sprintf('(%s)', $review_avg);
				               echo Gowilds_Listing_Comment::instance()->show_star_by_avg($review_avg, '', $suffix_review); 
				            } 
				         ?>
			         </div>

			        	<?php 
					   	if($enable_video_gallery || $images){ 
						   	echo '<div class="trip__media trip-two__media">';
					   			if($images){
					            	$i = 1;
					               foreach($images as $image){ 
					               	if ( is_wp_error( $image ) ) {
												continue;
											}
					               	$classes = ($i>1) ? 'hidden' : 'trip-gallery';
					                  if( isset(wp_get_attachment_image_src($image, 'full')[0]) ){ ?>
					                     <a class="<?php echo esc_attr($classes) ?>" href="<?php echo esc_url(wp_get_attachment_image_src($image, 'full')[0]) ?>" data-elementor-lightbox-slideshow="<?php echo esc_attr($_rand) ?>">
					                        <?php 
					                        	if($i == 1){
					                        		echo '<i class="las la-camera"></i>';
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

			      <h3 class="trip-two__title">
			      	<a href="<?php echo esc_url( get_permalink() ) ?>" rel="bookmark"><?php the_title() ?></a>
			      </h3>
			      	
			      <?php if(!empty($location_address)){  ?>
			      	<div class="trip-two__address">
			      		<i class="fas fa-map-marker-alt"></i>
			      		<span class="value"><?php echo esc_html($location_address) ?></span>
			      	</div>
			      <?php } ?>

			      <div class="trip-two__price trip__price">
			   		<label class="trip-two__price-label">
			   			<i class="fa-solid fa-circle-dollar-to-slot"></i>
			   			<?php echo esc_html__('From', 'gowilds'); ?>
			   		</label>
			   		<span class="trip-two__price-number">
							<?php	
								echo '<span class="actual-price">';
									echo wte_esc_price( wte_get_formated_price_html( $meta->has_sale ? $meta->sale_price : $meta->price ) ); 
								echo '</span>';
								if ( $meta->has_sale ){
									echo '<span class="striked-price">'; 
										echo wte_esc_price( wte_get_formated_price_html( $meta->price ) ); 
									echo '</span>';
								}
							?>
						</span>
			   	</div>
		      	
			   </div>
			</div>
		</div>
	</div>
</div>   

