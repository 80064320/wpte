<?php
/**
 *
 * @since 6.3.3
 */

defined( 'ABSPATH' ) || exit;

/**
 * @var string $banner_layout
 * @var array $list_images List of image sizes.
 * @var bool $show_image_gallery
 * @var bool $show_video_gallery
 * @var bool $full_width_banner Is full width banner enabled?
 */
$wptravelengine_settings 	= get_option( 'wp_travel_engine_settings', array() );
$banner_layout           	= $wptravelengine_settings[ 'trip_banner_layout' ] ?? 'banner-default';
$meta_layout = get_post_meta( get_the_ID(), 'gowilds_banner_layout', true );
$banner_layout = !empty($meta_layout) && $meta_layout != '_default_' ? $meta_layout : $banner_layout;

$fullwidth_class = $full_width_banner && 'banner-layout-1' === $banner_layout ? ' banner-layout-full' : '';
?>

<?php 
if( $banner_layout == 'banner-layout-5' ){
	$tour_video = ! empty( $meta['tour_video'] ) ? $meta['tour_video'] : '';
	$carousel_options = array(
	  'items'               => 4,
	  'items_lg'            => 3,
	  'items_md'            => 2,
	  'items_sm'            => 2,
	  'items_xs'            => 2,
	  'items_xx'            => 1,
	  'effect'					=> 'slide',
	  'space_between'			=> 10,
	  'loop'                => 1, 
	  'speed'               => 1200,
	  'autoplay'           	=> 5000,
	  'autoplay_delay'   	=> 3500,
	  'autoplay_hover'     	=> 1,
	  'navigation'          => 1,
	  'pagination'          => 0,
	  'dynamic_bullets'		=> 1,
	  'pagination_type'		=> 1
	);
	$count = 1;
?>

	<!-- Tour Gallery Section -->
	<div class="booking-single-gallery">
	   <div class="swiper-slider-wrapper">
	      <div class="swiper-content-inner">
	         <div class="init-carousel-swiper-theme swiper" data-carousel="<?php echo htmlspecialchars(json_encode($carousel_options)) ?>">
	            <div class="swiper-wrapper">
	               <?php 
	               	$gallery_ids = $list_images;
	                  if(!empty($gallery_ids)){
	                     foreach ( $gallery_ids as $key => $gallery_item_id ) { 
	                     	if ( !is_numeric( $gallery_item_id ) ) {
										continue;
									}
	                     	$image_url = wp_get_attachment_image_src( $gallery_item_id, 'post_thumbnail' )[0];
	                        echo '<div class="swiper-slide">';
	                        	echo '<img src="' . esc_url($image_url) . '">';
	                        echo '</div>';
	                     }
	                  } 
	               ?>
	            </div>
	         </div>
	      </div>  
	      <?php 
	      	if($carousel_options['pagination']){ 
	      		echo '<div class="swiper-pagination"></div>';
	      	} 
	      	if($carousel_options['navigation']){ 
	      		echo '<div class="swiper-nav-next"></div><div class="swiper-nav-prev"></div>';
	      	} 
	      ?>
	   </div>
	   <?php
			if ( $show_image_gallery || $show_video_gallery ) {
				wptravelengine_get_template(
					'single-trip/banner-layouts/list-gallery.php',
					compact( 'show_image_gallery', 'show_video_gallery' )
				);
			}
		?>
		<div class="images-count hidden"><?php echo count($list_images) ?></div>
	</div>

<?php }else{ ?>

	<div class="wpte-gallery-wrapper <?php echo esc_attr( $banner_layout ); ?>">
		<div class="wpte-multi-banner-layout<?php echo esc_attr( $fullwidth_class ); ?>">
			<?php
			/**
			 * Use this filter to generate markup for images.
			 *
			 * @param $list_images List of attachment IDs.
			 */
			$list_images = apply_filters( 'wptravelengine_trip_dynamic_banner_list_images', $list_images, $banner_layout, $show_image_gallery, $show_video_gallery );
			foreach ( $list_images as $image ) {
				if ( is_numeric( $image ) ) {
					continue;
				}
				echo wp_kses_post( $image );
			}
			?>
		</div>
		<?php
		if ( $show_image_gallery || $show_video_gallery ) {
			wptravelengine_get_template(
				'single-trip/banner-layouts/list-gallery.php',
				compact( 'show_image_gallery', 'show_video_gallery' )
			);
		}
		?>
	</div>

<?php } ?>
