<?php
/**
 * Template for related trips.
 *
 * @since __next_version__
 */
$section_title = __( 'Related trips you might interested in', 'gowilds' );
$related_trips = new \WP_Query();
extract( $args );

$carousel_options = array(
  'items'               => 3,
  'items_lg'            => 3,
  'items_md'            => 2,
  'items_sm'            => 2,
  'items_xs'            => 2,
  'items_xx'            => 1,
  'effect'					=> 'slide',
  'space_between'			=> 30,
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

?>
<div class="wte-related-trips-wrapper">
	<h2 class="wte-related-trips__heading"><?php echo esc_html( $section_title ); ?></h2>
	<div class="wte-related-trips">

		<div class="swiper-slider-wrapper">
	      <div class="swiper-content-inner">
	         <div class="init-carousel-swiper-theme swiper" data-carousel="<?php echo htmlspecialchars(json_encode($carousel_options)) ?>">
	            <div class="swiper-wrapper">
	               <?php 
		              	while ( $related_trips->have_posts() ) {
		              		echo '<div class="swiper-slide">';
									$related_trips->the_post();
									$user_wishlists            = wptravelengine_user_wishlists();
									$details                   = wte_get_trip_details( get_the_ID() );
									$related_query             = array(
										'related_query' => true,
									);
									$details                   = array_merge( $details, $related_query );
									$details['user_wishlists'] = $user_wishlists;
									if ( version_compare( '6.0.0', \WP_TRAVEL_ENGINE_VERSION, '<' ) ) {
										wte_get_template( 'content-grid.php', $details );
									} else {
										$details['view_mode'] = '';
										wte_get_template( 'content-view.php', $details );
									}
								echo '</div>';
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


		<?php wp_reset_postdata(); ?>
	</div>
</div>
