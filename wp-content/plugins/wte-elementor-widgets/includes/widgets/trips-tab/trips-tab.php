<?php
/**
 * Trips Tab Widget.
 *
 * @since 1.3.6
 * @package wptravelengine-elementor-widgets
 */

namespace WPTRAVELENGINEEB;

use WPTRAVELENGINEEB\Widget;

defined( 'ABSPATH' ) || exit;

/**
 * Class Trips Tab Widget.
 *
 * @since 1.3.6
 */
class Widget_Trips_Tab extends Widget {

	/**
	 * Widget name.
	 *
	 * @since 1.3.6
	 *
	 * @var string
	 */
	public $widget_name = 'wptravelengine-trips-tab';

	/**
	 * Widget keywords.
	 *
	 * @since 1.3.6
	 *
	 * @var array
	 */
	protected $keywords = array( 'trip', 'wp travel engine', 'wte', 'trips-tab', 'tab' );

	/**
	 * Style dependencies.
	 */
	public function get_style_depends() {
		wp_register_style( 'wpte-trip-tabs', plugin_dir_url( WPTRAVELENGINEEB_FILE__ ) . 'dist/css/wpte-trips-tab.css' );
		
		return array( 'wpte-trip-tabs' );
	}

	/**
	 * Javascripts dependencies.
	 */
	public function get_script_depends() {
		wp_register_script('wpte-trips-tab', plugin_dir_url(WPTRAVELENGINEEB_FILE__) . 'includes/widgets/trips-tab/trips-tab.js', array('jquery'), WPTRAVELENGINEEB_VERSION, true);
		return array( 'wpte-trips-tab', 'trip-wishlist');
	}

	/**
	 * Widget categories.
	 */
	public function get_categories() {
		return array( 'wptravelengine' );
	}

	/**
	 * Widget Settings.
	 *
	 * @since 1.3.6
	 */
	protected function register_controls() {
		$settings = Widgets_Controller::instance()->get_core_widget_setting( $this->widget_name, 'controls' );
		$controls = isset( $settings['controls'] ) && is_array( $settings['controls'] ) ? $settings['controls'] : array();
		$this->_wte_add_controls( $settings );
		$controls = include __DIR__ . '/controls.php';
		$this->_wte_add_controls( $controls );
	}

	

	/**
	 * Summary of check_empty_taxonomy
	 * @param mixed $attributes
	 * @param mixed $taxonomy
	 * 
	 * @since 1.3.6
	 * @return bool
	 */
	protected function check_empty_taxonomy( $attributes ) {
	
		$destination = $attributes[ '' . 'destination' . '_termstoDisplay' ];
		$activities = $attributes[ '' . 'activities' . '_termstoDisplay' ];
		$trip_types = $attributes[ '' . 'trip_types' . '_termstoDisplay' ];

		if ( ! empty( $destination ) || ! empty( $activities ) || ! empty( $trip_types ) ) {
			return true;
		}

		return false;
	}
	
	protected function get_swiper_pagination($attributes){
		$prev_arrow_class = ! empty( $attributes['slider_prev_arrow_icon']['value'] ) ? 'custom-prev-arrow' : '';
		$next_arrow_class = ! empty( $attributes['slider_next_arrow_icon']['value'] ) ? ' custom-next-arrow' : '';
		$hidden_class_xl  = empty( $attributes['arrow'] ) ? 'hide-xl' : '';
		$hidden_class_lg  = empty( $attributes['arrow_laptop'] ) ? 'hide-lg' : '';
		$hidden_class_md  = empty( $attributes['arrow_tablet'] ) ? 'hide-md' : '';
		$hidden_class_sm  = empty( $attributes['arrow_mobile'] ) ? 'hide-sm' : '';
		$hidden_pg_xl     = empty( $attributes['pagination'] ) ? 'hide-xl' : '';
		$hidden_pg_lg     = empty( $attributes['pagination_laptop'] ) ? 'hide-lg' : '';
		$hidden_pg_md     = empty( $attributes['pagination_tablet'] ) ? 'hide-md' : '';
		$hidden_pg_sm     = empty( $attributes['pagination_mobile'] ) ? 'hide-sm' : '';

		$this->add_render_attribute( 
			'swiper-navigation', 
			'class', 
			[
				'wpte-swiper-navigation',
				esc_attr( $hidden_class_lg ),
				esc_attr( $hidden_class_md ),
				esc_attr( $hidden_class_sm ),
				esc_attr( $prev_arrow_class ),
				esc_attr( $next_arrow_class ),
				esc_attr( $hidden_class_xl ),
			] 
		);

		$this->add_render_attribute( 
			'swiper-pagination', 
			'class', 
			[
				'wpte-swiper-page',
				'tab-page',
				esc_attr( $hidden_pg_xl ),
				esc_attr( $hidden_pg_lg ),
				esc_attr( $hidden_pg_md ),
				esc_attr( $hidden_pg_sm ),
			] 
		);

		?>
			<div <?php $this->print_render_attribute_string( 'swiper-navigation' ); ?>>
				<div class="wpte-swiper-btn-prev tab-btn-prev">
				<?php
				if ( ! empty( $attributes['slider_prev_arrow_icon'] ) && is_array( $attributes['slider_prev_arrow_icon'] ) && ! empty( $attributes['slider_prev_arrow_icon']['value'] ) && ! is_array( $attributes['slider_prev_arrow_icon']['value'] ) ) :
					?>
						<i class="<?php echo esc_attr( $attributes['slider_prev_arrow_icon']['value'] ); ?>"></i>
					<?php
					elseif ( is_array( $attributes['slider_prev_arrow_icon']['value'] ) && ! empty( $attributes['slider_prev_arrow_icon']['value']['url'] ) ) :
						Icons_Manager::render_icon( $attributes['slider_prev_arrow_icon'] );
					else :
						?>
						<?php
					endif;
					?>
				</div>
				<div class="wpte-swiper-btn-next tab-btn-next">
				<?php
				if ( ! empty( $attributes['slider_next_arrow_icon'] ) && is_array( $attributes['slider_next_arrow_icon'] ) && ! empty( $attributes['slider_next_arrow_icon']['value'] ) && ! is_array( $attributes['slider_next_arrow_icon']['value'] ) ) :
					?>
						<i class="<?php echo esc_attr( $attributes['slider_next_arrow_icon']['value'] ); ?>"></i>
					<?php
					elseif ( is_array( $attributes['slider_next_arrow_icon']['value'] ) && ! empty( $attributes['slider_next_arrow_icon']['value']['url'] ) ) :
						Icons_Manager::render_icon( $attributes['slider_next_arrow_icon'] );
					else :
						?>
						<?php
					endif;
					?>
			</div>
		</div>
			<div <?php $this->print_render_attribute_string( 'swiper-pagination' ); ?>></div>
		<?php
	}

	/**
	 * Renders Widget.
	 *
	 * @since 1.3.6
	 */
	protected function render() {
		$attributes = $this->get_settings_for_display();
		$taxlistby  = wte_array_get( $attributes, 'listby', 'destination' );

		$attributes['default_taxonomies'] = array(
			'destination',
			'activities',
			'trip_types'
		);

		$trip_args = array();

		if ( isset( $attributes['listby'] ) ) {
			$trip_args = array(
				'post_type'      => \WP_TRAVEL_ENGINE_POST_TYPE,
				'posts_per_page' => $attributes['tripsCount'],
				'fields'         => 'ids',
				'post_status'    => 'publish',
			);
		}
		$trip_posts   = get_posts( $trip_args );

		$ribbonType        = wte_array_get( $attributes, 'ribbonType', '3' );
		$ribbonAlignment   = wte_array_get( $attributes, 'ribbonAlignment', 'left' );
		$discountType      = wte_array_get( $attributes, 'discountType', '1' );
		$discountAlignment = wte_array_get( $attributes, 'discountAlignment', 'left' );
		$priceType         = wte_array_get( $attributes, 'priceType', '1' );
		$tabOrientation    = wte_array_get( $attributes, 'tab_orientation', 'horizontal' );
		$tabLayout         = wte_array_get( $attributes, 'tab_layout', '1' );
		$enableSlider      = wte_array_get( $attributes, 'enableSlider', 'yes' );
		$layout_data 	   = wte_array_get( $attributes, 'cardlayout', '1' );

		//swiper settings
		$slider_settings = array(
			'speed'         => wte_array_get( $attributes, 'speed', 300 ),
			'effect'        => wte_array_get( $attributes, 'effect', 'slide' ),
			'loop'          => wte_array_get( $attributes, 'loop', 'yes' ) === 'yes',
			'wrapperClass'  => 'wpte-trips-tab__swiper-wrapper',
			'slidesPerView' => wte_array_get( $attributes, 'slidesPerViewDesktop_mobile', 1 ),
			'spaceBetween'  => wte_array_get( $attributes, 'spaceBetween', 30 ),
			'breakpoints'   => wte_array_get(
				$attributes,
				'breakpoints',
				array(
					768  => array(
						'slidesPerView' => (int) wte_array_get( $attributes, 'slidesPerViewDesktop_tablet', 2 ),
					),
					1025 => array(
						'slidesPerView' => (int) wte_array_get( $attributes, 'slidesPerViewDesktop_laptop', 3 ),
					),
					1367 => array(
						'slidesPerView' => (int) wte_array_get( $attributes, 'slidesPerViewDesktop', 3 ),
					),
				)
			),
		);
		
		if ( wte_array_get( $attributes, 'autoplay', 'yes' ) === 'yes' ) {
			$slider_settings['autoplay'] = array(
				'delay' => (int) wte_array_get( $attributes, 'autoplaydelay', 3000 ),
				'disableOnInteraction' => false,
			);
		}

		//Add classes to render on the HTML
		$this->add_render_attribute( 
			'main-wrapper-classes', 
			'class', 
			[
				'wpte-elementor-widget',
				'wpte-trips-tab',
				'wpte-trips-tab--' . esc_attr($tabOrientation),
				isset( $attributes['cardlayout'] ) && ! empty( $attributes['cardlayout'] ) ? esc_attr( "wpte-trips-tab--layout-{$attributes['cardlayout']}" ) : esc_attr('wpte-trips-tab--layout-1'),
			] 
		);

		$this->add_render_attribute( 
			'featured-ribbon', 
			'class', 
			[
				'wpte-badge',
				'wpte-badge_featured',
				'wpte-badge--layout-' . esc_attr($ribbonType),
				'wpte-badge--' . esc_attr($ribbonAlignment)
			] 
		);
		
		$this->add_render_attribute( 
			'discount-badge', 
			'class', 
			[
				'wpte-badge',
				'wpte-badge_discount',
				'wpte-badge--layout-' . esc_attr($discountType),
				'wpte-badge--' . esc_attr($discountAlignment)
			] 
		);
		
		$this->add_render_attribute( 
			'price-data', 
			'class', 
			[
				'wpte-card__price',
				'wpte-card__price--layout-'. esc_attr($priceType)
			] 
		);

		$this->add_render_attribute( 
			'tab-nav', 
			'class', 
			[
				'wpte-trips-tab__nav',
				'wpte-trips-tab__nav--layout-'. esc_attr($tabLayout),
				isset( $attributes['enableSlider'] ) && $attributes['enableSlider'] === 'yes' ? esc_attr('slider-enabled') : esc_attr('slider-disabled'),
			] 
		);

		$this->add_render_attribute( 
			'tab-nav', 
			'aria-orientation', 
			[
				esc_attr($tabOrientation)
			] 
		);
		$this->add_render_attribute( 
			'tab-nav', 
			'role', 
			[
				'tablist'
			] 
		);

		$this->add_render_attribute( 
			'swiper-wrapper', 
			'data-swiper-options', 
			[
				esc_attr( wp_json_encode( $slider_settings ) )
			] 
		);

		$this->add_render_attribute( 
			'swiper-wrapper', 
			'class', 
			[
				'wpte-trips-tab__swiper',
				'swiper'
			] 
		);

		$widget_id = $this->get_id();

		if ( $trip_posts && is_array( $trip_posts ) ) : ?>
			<div <?php $this->print_render_attribute_string( 'main-wrapper-classes' ); ?>>
				<?php if( $this->check_empty_taxonomy( $attributes ) ) : ?>
					<div <?php $this->print_render_attribute_string( 'tab-nav' ); ?>>
						<?php 
						foreach ( $attributes['default_taxonomies'] as $taxonomy ) {
							if( $taxlistby == $taxonomy ){
								$terms_check = $attributes[ '' . $taxonomy . '_termstoDisplay' ];
								if( isset( $terms_check ) ){
									foreach( $terms_check as $index => $single_term ){
										$term = get_term( $single_term, $taxonomy );
										?>
										<button id="tab-<?php echo esc_attr( $term->term_id ); ?>-<?php echo esc_attr( $widget_id ); ?>" type="button" role="tab" aria-selected="<?php echo ( $index == 0 ) ? 'true' : 'false'; ?>" aria-controls="tabpanel-<?php echo esc_attr( $term->term_id ); ?>-<?php echo esc_attr( $widget_id ); ?>">
											<?php echo esc_html( $term->name ); ?>
										</button>
										<?php
									}
								}
							}
						}
					?>
					</div>
					<div class="wpte-trips-tab__content">
						<?php 
						if( isset( $attributes['listby'] ) ){
							foreach ( $attributes['default_taxonomies'] as $taxonomy ) {
								if( $taxlistby == $taxonomy ){
									$terms_check = $attributes[ '' . $taxonomy . '_termstoDisplay' ];
										if( isset( $terms_check ) ){
											foreach( $terms_check as $index => $single_term ){
												$term = get_term( $single_term, $taxonomy );
												?>
													<div id="tabpanel-<?php echo esc_attr( $term->term_id ); ?>-<?php echo esc_attr( $widget_id ); ?>" class="<?php echo ( $index == 0 ) ? esc_attr('visible') : esc_attr('is-hidden'); ?>" role="tabpanel" tabindex="0" aria-labelledby="tab-<?php echo esc_attr( $term->term_id ); ?>">
														<?php if( $enableSlider == 'yes' ) : ?>
															<div <?php $this->print_render_attribute_string( 'swiper-wrapper' ); ?>>
														<?php endif; ?>
															<div class="<?php echo ( $enableSlider == 'yes' ) ? esc_attr('wpte-trips-tab__swiper-wrapper swiper-wrapper') : esc_attr('wpte-grid'); ?>">
																<?php
																	if ( isset( $attributes['listby'] ) ) {
																		$query_args = array(
																			'post_type'      => \WP_TRAVEL_ENGINE_POST_TYPE,
																			'posts_per_page' => $attributes['tripsCount'],
																			'fields'         => 'ids',
																			'post_status'    => 'publish',
																		);
																	}
																	
																	$query_args['suppress_filters'] = false;
																	$query_args['tax_query'][] = array(
																		'taxonomy' => $taxonomy,
																		'field'    => 'term_id',
																		'terms'    => $single_term  // The term ID
																	);
																	$trips   = get_posts( $query_args );
																	$results_array = [];
																	if( $trips ){
																		foreach( $trips as $trip_id ){
																			$duration_mapping    = array(
																				'days'   => array( __( 'Day', 'wptravelengine-elementor-widgets' ), __( 'Days', 'wptravelengine-elementor-widgets' ) ),
																				'nights' => array( __( 'Night', 'wptravelengine-elementor-widgets' ), __( 'Nights', 'wptravelengine-elementor-widgets' ) ),
																				'hours'  => array( __( 'Hour', 'wptravelengine-elementor-widgets' ), __( 'Hours', 'wptravelengine-elementor-widgets' ) ),
																			);
																			$results_array['duration'] = $duration_mapping;
																			$args                = array( $attributes, $trip_id, $results_array );
																			
																			if ( $layout_data == '1' || $layout_data == '4' ) {
																				include __DIR__ . '/layout-1-4.php';
																			} else if ( $layout_data == '2' || $layout_data == '3' ) {
																				include __DIR__ . '/layout-2-3.php';
																			} else {
																				include __DIR__ . '/layout-5.php';
																			}
																		}
																	}
																?>
															</div>
														<?php if( $enableSlider == 'yes' ) : ?>
															</div>
															<?php $this->get_swiper_pagination($attributes); ?>
														<?php endif; ?>
													</div>
												<?php
											}
										}
									}
								}
							}
						?>
					</div>
					<?php
					else :
						echo esc_html__('No terms selected. Please assign a term.','wptravelengine-elementor-widgets');
					endif; ?>
			</div>
		<?php
		else :
			echo esc_html__('No trips available. Please add a new trip.','wptravelengine-elementor-widgets');
		endif;
	}
}