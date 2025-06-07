<?php

namespace WPTravelEngine\Modules;

/**
 * Trip Search
 *
 * @since __addonmigration__
 */
class TripSearch {

	public function __construct() {
		$this->includes();
		$this->init_hooks();
	}

	private function includes() {
		require_once __DIR__ . '/trip-search/backward-compatibility.php';
	}

	private function init_hooks() {

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ), 15 );

		add_action( 'init', array( $this, 'init' ) );
		/**
		 * Admin Hooks.
		 */
		// add_action( 'wte_advanced_search_page', array( __CLASS__, 'search_page' ) );
		// add_action( 'wp_travel_engine_search_fields', array( __CLASS__, 'search_fields' ) );
		add_action( 'wpte_get_global_extensions_tab', array( __CLASS__, 'settings' ) );
		/**p
		 * Add settings to choose Search Page.
		 * Settings>General>Page Settings
		 */
		add_filter( 'wpte_global_page_options', array( __CLASS__, 'choose_page' ) );

		/**
		 * Public hooks
		 */
		add_filter(
			'body_class',
			function ( $classes ) {
				if ( self::is_search_page() ) {
					$classes[] = 'trip-search-result';
				}

				return $classes;
			}
		);

		add_action( 'template_redirect', array( __CLASS__, 'template_redirect' ) );

		add_action( 'wp_travel_engine_archive_sidebar', array( __CLASS__, 'archive_filter_sidebar' ) );

		// Search Filter forms callback.
		add_filter(
			'wptravelengine_search_filter_price',
			function () {
				return array( __CLASS__, 'search_filter_price' );
			}
		);
		add_filter(
			'wptravelengine_search_filter_duration',
			function () {
				return array( __CLASS__, 'search_filter_duration' );
			}
		);
	}

	public static function search_filter_duration( $args ) {
		wp_enqueue_script( 'jquery-ui-slider' );
		$range = (array) self::get_duration_range();
		$id    = wte_uniqid();
		?>
        <div data-value-format="duration" class="wpte-trip__adv-field wpte__select-field"
             data-range-slider="#<?php echo esc_attr( $id ); ?>"
             data-range="<?php echo esc_attr( implode( ',', $range ) ); ?>" data-min="0" data-max="50"
             data-suffix="<?php esc_attr_e( 'Days', 'wp-travel-engine' ); ?>">
			<?php
			self::search_filter_icon( $args, 'duration' );
			?>
            <input type="text" data-value class="wpte__input"
                   placeholder="<?php echo esc_attr( $args[ 'label' ] ); ?>" />
            <input type="hidden" data-value-min class="wpte__input-min" name="min-duration">
            <input type="hidden" data-value-max class="wpte__input-max" name="max-duration">
            <div class="wpte__select-options">
                <div id="<?php echo esc_attr( $id ); ?>"></div>
            </div>
        </div>
		<?php
	}

	public static function search_filter_price( $args ) {
		// wp_enqueue_script( 'jquery-ui-slider' );
		wp_enqueue_script( 'wte-nouislider' );
		wp_enqueue_style( 'wte-nouislider' );
		$range = (array) self::get_price_range();
		$id    = wte_uniqid();
		?>
        <div class="wpte-trip__adv-field wpte__select-field" data-range-slider="#<?php echo esc_attr( $id ); ?>"
             data-range="<?php echo esc_attr( implode( ',', $range ) ); ?>" data-min="0" data-max="50"
             data-value-format="price">
			<?php
			self::search_filter_icon( $args, 'price' );
			?>

            <input type="text" class="wpte__input" data-value
                   placeholder="<?php echo esc_attr( $args[ 'label' ] ); ?>" />
            <input type="hidden" data-value-min class="wpte__input-min" name="min-cost" />
            <input type="hidden" data-value-max class="wpte__input-max" name="max-cost" />
            <div class="wpte__select-options">
                <div id="<?php echo esc_attr( $id ); ?>"></div>
            </div>
        </div>
		<?php
	}

	public function enqueue_scripts() {
		wp_register_script( 'wte-trip-search', plugin_dir_url( WP_TRAVEL_ENGINE_FILE_PATH ) . 'dist/public/trip-search/index.js', array(
			'jquery',
			'wte-custom-scrollbar',
			'jquery-ui-slider',
		), WP_TRAVEL_ENGINE_VERSION, true );
		// wp_register_style( 'wte-trip-search', plugin_dir_url( WP_TRAVEL_ENGINE_FILE_PATH ) . 'dist/public/trip-search/index.css', array(), WP_TRAVEL_ENGINE_VERSION );

		$price_range = self::get_price_range();
		$min_cost    = 0;
		$max_cost    = $price_range->{'max_price'};
		// phpcs:disable
		$duration_range  = self::get_duration_range();
		$to_be_localized = array(
			'ajax_url'              => admin_url( 'admin-ajax.php' ),
			'min_cost'              => (int) $price_range->{'min_price'},
			'max_cost'              => (int) $price_range->{'max_price'},
			'min_duration'          => (int) $duration_range->{'min_duration'},
			'max_duration'          => (int) $duration_range->{'max_duration'},
			'selected_min_cost'     => ! empty( $_GET[ 'min-cost' ] ) ? (int) $_GET[ 'min-cost' ] : (int) $price_range->{'min_price'},
			'selected_max_cost'     => (int) $price_range->{'max_price'},
			'selected_min_duration' => ! empty( $_GET[ 'min-duration' ] ) ? (int) $_GET[ 'min-duration' ] : (int) $duration_range->{'min_duration'},
			'selected_max_duration' => ! empty( $_GET[ 'max-duration' ] ) ? (int) $_GET[ 'max-duration' ] : (int) $duration_range->{'max_duration'},
			'cur_symbol'            => wp_travel_engine_get_currency_code(),
			'days_text'             => __( 'Days', 'wp-travel-engine' ),
		);
		wp_localize_script( 'wte-trip-search', 'wte_advanced_search', $to_be_localized );
		// phpcs:enable
	}

	public static function load_trips_html() {
		// phpcs:disable
		$args                  = json_decode( wp_unslash( $_POST[ 'query' ] ), true );
		$args[ 'paged' ]       = wte_clean( wp_unslash( $_POST[ 'page' ] ) ) + 1; // we need next page to be loaded
		$args[ 'post_status' ] = 'publish';

		$query = new \WP_Query( $args );
		ob_start();

		$view_mode  = wte_clean( wp_unslash( $_POST[ 'mode' ] ) );
		$view_class = 'grid' === $view_mode ? 'col-2 category-grid' : 'category-list';

		$user_wishlists = wptravelengine_user_wishlists();

		// phpcs:enable
		while ( $query->have_posts() ) :
			$query->the_post();
			$details                     = \wte_get_trip_details( get_the_ID() );
			$details[ 'user_wishlists' ] = $user_wishlists;
			// \wte_get_template( 'content-' . $view_mode . '.php', $details );
			if ( version_compare( '6.0.0', \WP_TRAVEL_ENGINE_VERSION, '<' ) ) {
				wte_get_template( 'content-' . $view_mode . '.php', $details );
			} else {
				$details[ 'view_mode' ] = $view_mode;
				wte_get_template( 'content-view.php', $details );
			}
		endwhile;
		\wp_reset_postdata();

		$html = ob_get_clean();
		wp_send_json_success(
			array(
				'data' => $html,
			)
		);
		exit();
	}

	public static function filter_trips_html( $post_data ) {

		$view_mode = ! empty( $post_data[ 'mode' ] ) ? wte_clean( wp_unslash( $post_data[ 'mode' ] ) ) : wp_travel_engine_get_archive_view_mode(); // phpcs:ignore

		if ( ! in_array( $view_mode, array( 'grid', 'list' ) ) ) {
			return '<h1>' . sprintf( __( 'Layout not found: %s', 'wp-travel-engine' ), $view_mode ) . '</h1>';
		}

		$query_args = self::get_query_args( true );

		$query = new \WP_query( $query_args );

		if ( ! $query->have_posts() ) {
			return wp_send_json_success(
				array(
					'foundposts' => apply_filters( 'no_result_found_message', __( 'No results found!', 'wp-travel-engine' ) ),
					'data'       => '',
				)
			);
		}

		$view_class = 'grid' === $view_mode ? 'wte-col-2 category-grid' : 'category-list';

		ob_start();

		echo '<div class="category-main-wrap ' . esc_attr( $view_class ) . '">';

		$user_wishlists = wptravelengine_user_wishlists();

		while ( $query->have_posts() ) :
			$query->the_post();
			$details                     = wte_get_trip_details( get_the_ID() );
			$details[ 'user_wishlists' ] = $user_wishlists;

			// wte_get_template( 'content-' . $view_mode . '.php', $details );
			if ( version_compare( '6.0.0', \WP_TRAVEL_ENGINE_VERSION, '<' ) ) {
				wte_get_template( 'content-' . $view_mode . '.php', $details );
			} else {
				$details[ 'view_mode' ] = $view_mode;
				wte_get_template( 'content-view.php', $details );
			}
		endwhile;
		wp_reset_postdata();
		echo '</div>';

		$default_posts_per_page = get_option( 'posts_per_page', 10 );
		$paged                  = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
		if ( $query->found_posts > $default_posts_per_page ) {
			echo "<span data-id='" . esc_attr( $query->found_posts ) . "' class='wte-search-load-more'><a data-query-vars='" . wp_json_encode( $query->query_vars ) . "' data-current-page='" . esc_attr( $paged ) . "' data-max-page='" . esc_attr( $query->max_num_pages ) . "' href='#' class='load-more-search' data-nonce='" . wp_create_nonce( 'wte_show_ajax_result_load' ) . "'>" . __( 'Load More', 'wp-travel-engine' ) . '</a></span>';
		}

		$foundposts = sprintf( _nx( '%s Trip Found', '%s Trips found', $query->found_posts, 'number of trips', 'wp-travel-engine' ), '<strong>' . number_format_i18n( $query->found_posts ) . '</strong>' );

		return wp_send_json_success(
			array(
				'foundposts' => $foundposts,
				'data'       => ob_get_clean(),
			)
		);
		exit;
	}

	/**
	 * Prepares query to get results.
	 */
	public static function get_query_args( $ajax_request = false ) {
		$paged          = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
		$posts_per_page = get_option( 'posts_per_page', 10 );

		$query_args = array(
			'post_type'                => WP_TRAVEL_ENGINE_POST_TYPE,
			'post_status'              => 'publish',
			'posts_per_page'           => $posts_per_page,
			'wpse_search_or_tax_query' => true,
			'paged'                    => $paged,
		);

		$categories = apply_filters(
			'wte_filter_categories',
			array(
				'trip_types'  => array(
					'taxonomy'         => 'trip_types',
					'field'            => 'slug',
					'include_children' => true,
				),
				'cat'         => array(
					'taxonomy'         => 'trip_types',
					'field'            => 'slug',
					'include_children' => true,
				),
				'budget'      => array(
					'taxonomy'         => 'budget',
					'field'            => 'slug',
					'include_children' => false,
				),
				'activities'  => array(
					'taxonomy'         => 'activities',
					'field'            => 'slug',
					'include_children' => true,
				),
				'destination' => array(
					'taxonomy'         => 'destination',
					'field'            => 'slug',
					'include_children' => true,
				),
				'trip_tag'    => array(
					'taxonomy' => 'trip_tag',
					'field'    => 'slug',
				),
				'difficulty'  => array(
					'taxonomy' => 'difficulty',
					'field'    => 'slug',
				),
			)
		);
		// phpcs:disable
		$tax_query = array();
		foreach ( $categories as $cat => $term_args ) {
			if ( $ajax_request ) {
				$category = ! empty( $_REQUEST[ 'result' ][ $cat ] ) && $_REQUEST[ 'result' ][ $cat ] != '-1' ? $_REQUEST[ 'result' ][ $cat ] : ''; // phpcs:ignore
			} else {
				$category = ! empty( $_REQUEST[ $cat ] ) && $_REQUEST[ $cat ] != - 1 ? $_REQUEST[ $cat ] : ''; // phpcs:ignore
			}

			if ( ! empty( $category ) ) {
				$term_args[ 'terms' ] = $category;
				$tax_query[]          = $term_args;
			}
		}

		if ( ! empty( $tax_query ) ) {
			$query_args[ 'tax_query' ]               = $tax_query; // phpcs:ignore
			$query_args[ 'tax_query' ][ 'relation' ] = 'AND';
		}

		$meta_query = array();
		// Check Price.
		if ( $ajax_request && isset( $_REQUEST[ 'mincost' ], $_REQUEST[ 'maxcost' ] ) ) {
			$min_cost = intval( $_REQUEST[ 'mincost' ] );
			$max_cost = intval( $_REQUEST[ 'maxcost' ] );
		} else {
			$cost_range = (array) self::get_price_range();
			$min_cost   = isset( $_REQUEST[ 'min-cost' ] ) ? intval( $_REQUEST[ 'min-cost' ] ) : (int) $cost_range[ 'min_price' ];
			$max_cost   = isset( $_REQUEST[ 'max-cost' ] ) ? intval( $_REQUEST[ 'max-cost' ] ) : (int) $cost_range[ 'max_price' ];
		}

		if ( isset( $max_cost ) && $max_cost > 0 ) {
			$meta_query[] = array(
				'key'     => apply_filters( 'wpte_advance_search_price_filter', '_s_price' ),
				'value'   => array( $min_cost - 1, $max_cost + 1 ),
				'compare' => 'BETWEEN',
				'type'    => 'numeric',
			);
		}

		// Check Duration.
		if ( $ajax_request && isset( $_REQUEST[ 'mindur' ], $_REQUEST[ 'maxdur' ] ) ) {
			$min_duration = intval( $_REQUEST[ 'mindur' ] );
			$max_duration = intval( $_REQUEST[ 'maxdur' ] );
		} else {
			$range        = (array) self::get_duration_range();
			$min_duration = isset( $_REQUEST[ 'min-duration' ] ) ? intval( $_REQUEST[ 'min-duration' ] ) : (int) $range[ 'min_duration' ];
			$max_duration = isset( $_REQUEST[ 'max-duration' ] ) ? intval( $_REQUEST[ 'max-duration' ] ) : (int) $range[ 'max_duration' ];
		}

        $max_duration = $max_duration <= 0 ? 0.9999 : $max_duration;
		$meta_query[] = array(
			'key'     => '_s_duration',
			'value'   => array( ( $min_duration * 24 ) - 1, ( $max_duration * 24 ) + 1 ),
			'compare' => 'BETWEEN',
			'type'    => 'numeric',
		);


		if ( ! empty( $_REQUEST[ 'trip-date-select' ] ) || ! empty( $_REQUEST[ 'date' ] ) ) {
			$date = $ajax_request ? wte_clean( wp_unslash( $_REQUEST[ 'date' ] ) ) : wte_clean( wp_unslash( $_REQUEST[ 'trip-date-select' ] ) );

			try {
				$min_date = new \DateTime( $date . '-01' );
				$date     = $min_date->format( 'ym' );
			} catch ( \Exception $e ) {
				$date = str_replace( '-', '', $date );
			}
			$meta_query[] = array(
				'key'     => 'trip_available_months',
				'value'   => $date,
				'compare' => 'LIKE',
			);
		}

		if ( ! empty( $meta_query ) ) {
			$query_args[ 'meta_query' ]               = $meta_query; // phpcs:ignore
			$query_args[ 'meta_query' ][ 'relation' ] = 'AND'; // phpcs:ignore
		}

		if ( isset( $_REQUEST[ 'sort' ] ) && ! empty( $_REQUEST[ 'sort' ] ) ) {
			$sortby_val = isset( $_REQUEST[ 'sort' ] ) && ! empty( $_REQUEST[ 'sort' ] ) ? wte_clean( wp_unslash( $_REQUEST[ 'sort' ] ) ) : 'menu_order';
			$sort_args  = wte_advanced_search_get_order_args( $sortby_val );
			$args       = array_merge( $query_args, $sort_args );
		}

		if ( ! empty( $_REQUEST[ 'wte_orderby' ] ) || ! empty( $_REQUEST[ 'sort' ] ) ) {
			$order_by   = $ajax_request ? $_REQUEST[ 'sort' ] : wte_clean( wp_unslash( $_REQUEST[ 'wte_orderby' ] ) );
			$sort_args  = wte_advanced_search_get_order_args( $order_by ); // phpcs:ignore
			$query_args = array_merge( $query_args, $sort_args );
		}

		// phpcs:enable

		return apply_filters( 'query_args_for_trip_filters', $query_args );
	}

	public static function template_redirect( $template ) {
		global $post;
		if ( is_null( $post ) ) {
			return $template;
		}

		if ( self::is_search_page() && ! has_shortcode( $post->post_content, 'WTE_Trip_Search' ) ) {
			$wp_travel_engine_settings = get_option( 'wp_travel_engine_settings', array() );
			$is_enabled_fse_template   = $wp_travel_engine_settings[ 'enable_fse_template' ] ?? 'no';
			if ( current_theme_supports( 'wptravelengine-templates' ) || ( wp_is_block_theme() && $is_enabled_fse_template == 'yes' ) ) {
				return $template;
			}
			wp_enqueue_script( 'wp-travel-engine' );
			wp_enqueue_style( 'wp-travel-engine' );
			\wte_get_template( 'template-trip-search-results.php' );
			exit;
		}
	}

	public static function get_duration_range() {
		global $wpdb;

		$range = wp_cache_get( 'wte_duration_range', 'options' );

		if ( ! $range ) {
			$query   = $wpdb->prepare(
				"SELECT MIN(pm.meta_value * 1) AS min_duration,
				MAX(pm.meta_value * 1) AS max_duration
				FROM {$wpdb->postmeta} pm
				INNER JOIN {$wpdb->posts} p ON pm.post_id = p.ID
				WHERE pm.meta_key = %s AND p.post_status = 'publish' ",
				'_s_duration'
			);
			$results = $wpdb->get_row( $query ); // phpcs:ignore
			$range   = array(
				'min_duration' => 0,
				'max_duration' => 0,
			);
			if ( ! empty( $results ) ) {
				$range               = $results;
				$range->min_duration = floor( (int) $range->min_duration / 24 );
				$range->max_duration = ceil( $range->max_duration / 24 );
			}

			wp_cache_add( 'wte_duration_range', $range, 'options' );
		}

		return (object) $range;
	}

	public static function get_filters_sections() {
		$settings = get_option( 'wp_travel_engine_settings', array() );

		return apply_filters(
			'trip_filters_sections',
			array(
				'destinations' => array(
					'label'  => __( 'Destination', 'wp-travel-engine' ),
					'show'   => empty( $settings[ 'trip_search' ][ 'destination' ] ),
					'render' => array( __CLASS__, 'filter_destinations_render' ),
				),
				'price'        => array(
					'label'  => __( 'Price', 'wp-travel-engine' ),
					'show'   => empty( $settings[ 'trip_search' ][ 'budget' ] ),
					'render' => array( __CLASS__, 'filter_price_render' ),
				),
				'duration'     => array(
					'label'  => __( 'Duration', 'wp-travel-engine' ),
					'show'   => empty( $settings[ 'trip_search' ][ 'duration' ] ),
					'render' => array( __CLASS__, 'filter_duration_render' ),
				),
				'activities'   => array(
					'label'  => __( 'Activities', 'wp-travel-engine' ),
					'show'   => empty( $settings[ 'trip_search' ][ 'activities' ] ),
					'render' => array( __CLASS__, 'filter_activities_render' ),
				),
				'trip_types'   => array(
					'label'  => __( 'Trip Types', 'wp-travel-engine' ),
					'show'   => empty( $settings[ 'trip_search' ][ 'trip_types' ] ),
					'render' => array( __CLASS__, 'filter_trip_types_render' ),
				),
				'trip_tag'     => array(
					'label'  => __( 'Tags', 'wp-travel-engine' ),
					'show'   => empty( $settings[ 'trip_search' ][ 'trip_tag' ] ),
					'render' => array( __CLASS__, 'filter_trip_tag_render' ),
				),
				'difficulty'   => array(
					'label'  => __( 'Difficulties', 'wp-travel-engine' ),
					'show'   => empty( $settings[ 'trip_search' ][ 'difficulty' ] ),
					'render' => array( __CLASS__, 'filter_difficulty_render' ),
				),
			)
		);
	}

	public static function taxonomy_filter_html( $terms, $children = false ) {

		$parent_count = 0;
		$term_count   = 0;
		if ( is_array( $terms ) && count( $terms ) > 0 ) {
			printf( '<ul class="%1$s">', $children ? 'children' : 'wte-search-terms-list' );
			$invisible_terms  = '';
			$queried_term     = get_queried_object();
			$possible_queries = array();
			if ( $queried_term instanceof \WP_Term ) {
				$possible_queries[] = $queried_term->slug;
			}
			foreach ( $terms as $term ) {
				if ( isset( $term->parent ) && $term->parent && ! $children ) {
					continue;
				}

				if ( ! isset( $term->taxonomy ) || ! isset( $term->slug ) || ! isset( $term->name ) ) {
					continue;
				}

				$possible_queries[] = wte_array_get( $_GET, $term->taxonomy, false );

				ob_start();
				printf( '<li class="%1$s">', $children ? 'has-children' : '' );
				printf(
					'<label>'
					. '<input type="checkbox" %1$s value="%2$s" name="%3$s" class="%3$s wte-filter-item"/>'
					. '<span>%4$s</span>'
					. '</label>',
					checked( true, in_array( $term->slug, $possible_queries ), false ), // phpcs:ignore
					esc_attr( $term->slug ),
					esc_attr( $term->taxonomy ),
					esc_html( $term->name )
				);

				if ( apply_filters( 'wte_advanced_search_filters_show_tax_count', true ) ) {
					printf( '<span class="count">%1$s</span>', $term->count );
				}
				if ( is_array( $term->children ) && count( $term->children ) > 0 ) {
					$_children = array();
					foreach ( $term->children as $term_child ) {
						if ( ! isset( $terms[ $term_child ] ) ) {
							continue;
						}
						$_children[ $term_child ] = $terms[ $term_child ];
					}
					call_user_func( array( __CLASS__, __FUNCTION__ ), $_children, true );
				}
				print( '</li>' );

				$list = ob_get_clean();
				if ( ( ++ $parent_count > 4 ) && ! $children ) {
					$invisible_terms .= $list;
				} else {
					$term_count += count( $term->children ) + 1;
					echo $list; // phpcs:ignore
				}
			}

			if ( $invisible_terms != '' && ! $children ) {
				$allowed_html = array(
					'input' => array(
						'type'  => array(),
						'value' => array(),
						'name'  => array(),
						'class' => array(),
					),
					'label' => array(),
					'span'  => array(
						'class' => array(),
					),
					'li'    => array(
						'class' => array(),
					),
					'ul'    => array(
						'class' => array(),
					),
				);
				printf(
					'<li class="wte-terms-more"><button class="show-more">%2$s</button><ul class="wte-terms-more-list">%1$s</ul><button class="show-less">%3$s</button></li>',
					wp_kses( $invisible_terms, $allowed_html ),
					sprintf( esc_html__( 'Show all %s', 'wp-travel-engine' ), count( $terms ) - $term_count ),
					esc_html__( 'Show less', 'wp-travel-engine' )
				);
			}
			print( '</ul>' );
		}
	}

	public static function filter_taxonomies_render( $taxonomy, $filter ) {
		if ( empty( $filter[ 'label' ] ) ) {
			return;
		}

		$categories = get_categories( "taxonomy={$taxonomy}" );
		if ( empty( $categories ) ) {
			return;
		}
		$terms = \wte_get_terms_by_id( $taxonomy );

		?>
        <div class='advanced-search-field search-trip-type'>
            <h3 class='filter-section-title trip-type'><?php echo esc_html( $filter[ 'label' ] ); ?></h3>
            <div class="filter-section-content">
				<?php self::taxonomy_filter_html( $terms ); ?>
            </div>
        </div>
		<?php
	}

	public static function filter_destinations_render( $filter ) {
		self::filter_taxonomies_render( 'destination', $filter );
	}

	public static function filter_activities_render( $filter ) {
		self::filter_taxonomies_render( 'activities', $filter );
	}

	/**
	 *
	 * @since 5.5.7
	 */
	public static function filter_trip_tag_render( $filter ) {
		self::filter_taxonomies_render( 'trip_tag', $filter );
	}

	/**
	 *
	 * @since 5.5.7
	 */
	public static function filter_difficulty_render( $filter ) {
		self::filter_taxonomies_render( 'difficulty', $filter );
	}

	public static function filter_duration_render( $filter ) {
		// phpcs:disable
		$min_duration = isset( $_GET[ 'min-duration' ] ) ? (int) $_GET[ 'min-duration' ] : '';
		$max_duration = isset( $_GET[ 'max-duration' ] ) ? (int) $_GET[ 'max-duration' ] : '';
		// phpcs:enable
		$duration_range = self::get_duration_range();
		if ( '' === $min_duration ) {
			$min_duration = (int) $duration_range->{'min_duration'};
			$max_duration = (int) $duration_range->{'max_duration'};
		}
		?>
        <div class="advanced-search-field search-duration search-trip-type"
             data-value-format="duration"
             data-suffix="<?php echo esc_attr__( 'Days', 'wp-travel-engine' ); ?>"
             data-min="<?php echo esc_attr( $duration_range->min_duration ); ?>"
             data-max="<?php echo esc_attr( $duration_range->max_duration ); ?>"
             data-range="<?php echo esc_attr( $min_duration . ',' . $max_duration ); ?>"
             data-range-slider="#duration-slider-range">
            <h3 class="filter-section-title"><?php echo esc_html( $filter[ 'label' ] ); ?></h3>
            <div class="filter-section-content">
                <div id="duration-slider-range" data-min-key="mindur" data-max-key="maxdur"></div>
                <input type="hidden" data-value-min class="wpte__input-min" name="mindur" />
                <input type="hidden" data-value-max class="wpte__input-max" name="maxdur" />

                <div class="duration-slider-value">
					<span id="min-duration" class="min-duration" name="min-duration">
						<?php printf( esc_html__( '%1$s Days', 'wp-travel-engine' ), esc_html( round( $duration_range->min_duration ) ) ); ?>
					</span>
                    <span class="max-duration" id="max-duration" name="max-duration">
						<?php printf( esc_html__( '%1$s Days', 'wp-travel-engine' ), esc_html( round( $duration_range->max_duration ) ) ); ?>
					</span>
                </div>
            </div>
        </div>
		<?php
	}

	public static function filter_price_render( $filter ) {
		// phpcs:disable
		$min_cost = ! empty( $_GET[ 'min-cost' ] ) ? (int) $_GET[ 'min-cost' ] : '';
		$max_cost = ! empty( $_GET[ 'max-cost' ] ) ? (int) $_GET[ 'max-cost' ] : '';
		// phpcs:enable
		$price_range = self::get_price_range();
		if ( $min_cost === '' ) {
			$min_cost = (int) $price_range->{'min_price'};
			$max_cost = (int) $price_range->{'max_price'};
		}

		print( '<div class="advanced-search-field search-cost search-trip-type" data-max="' . esc_attr( $price_range->{'max_price'} ) . '" data-min="' . esc_attr( $price_range->{'min_price'} ) . '" data-range="' . esc_attr( $min_cost ) . ',' . esc_attr( $max_cost ) . '" data-value-format="price" data-range-slider="#cost-slider-range">'
		       . '<h3 class="filter-section-title">' . esc_html( $filter[ 'label' ] ) . '</h3>'
		       . '<div class="filter-section-content">'
		       . '<input type="hidden" data-value-min class="wpte__input-min" name="mincost" />'
		       . '<input type="hidden" data-value-max class="wpte__input-max" name="maxcost"/>'
		       . '<div id="cost-slider-range" data-min-key="mincost" data-max-key="maxcost"></div>'
		       . '<div class="cost-slider-value"><span class="min-cost">'
		       . wp_kses( \wte_get_formated_price( (int) $price_range->{'min_price'} ), 'allowed_price_html' )
		       . '</span><span class="max-cost">'
		       . wp_kses( \wte_get_formated_price( (int) $price_range->{'max_price'} ), 'allowed_price_html' )
		       . '</span></div>'
		       . '</div>'
		       . '</div>'
		);
	}

	public static function filter_trip_types_render( $filter ) {
		self::filter_taxonomies_render( 'trip_types', $filter );
	}

	public static function get_price_range() {
		global $wpdb;

		$range = wp_cache_get( 'wte_price_range', 'options' );

		if ( ! $range ) {
			$query = "
				SELECT MIN(pm.meta_value * 1) as min_price, MAX(pm.meta_value * 1) as max_price
				FROM {$wpdb->postmeta} pm
				INNER JOIN {$wpdb->posts} p ON pm.post_id = p.ID
				WHERE pm.meta_key = '_s_price'
				AND p.post_status = 'publish'
			";

			$results = $wpdb->get_row( $query ); // phpcs:ignore
			$range   = array(
				'min_price' => 0,
				'max_price' => 0,
			);
			if ( ! empty( $results ) ) {
				$range = $results;
			}
			wp_cache_add( 'wte_price_range', $range, 'options' );
		}

		return (object) $range;
	}

	/**
	 * Shows filters sidebar on Archive Page.
	 */
	public static function archive_filter_sidebar() {
		\wp_enqueue_style( 'wte-trip-search' );
		\wp_enqueue_script( 'wte-trip-search' );
		\wte_get_template( 'template-trip-filters-sidebar.php' );
	}

	public function init() {
		add_shortcode( 'Wte_Advanced_Search_Form', array( __CLASS__, 'search_form' ) );
		add_shortcode( 'WTE_Trip_Search', function () {
			ob_start();
			wp_enqueue_script( 'wp-travel-engine' );
			wp_enqueue_style( 'wp-travel-engine' );
			\wte_get_template( 'content-trip-search-results.php' );

			return ob_get_clean();
		} );
	}

	/**
	 * Search Form Output.
	 */
	public static function search_form() {
		$is_rest_route = defined( 'REST_REQUEST' ) && REST_REQUEST;
		if ( ( is_admin() && ! $is_rest_route ) || ( ! is_admin() && $is_rest_route ) ) {
			return;
		}

		$cost_range     = self::get_price_range();
		$duration_range = self::get_duration_range();

		wp_enqueue_script( 'wte-trip-search' );
		wp_enqueue_style( 'wte-trip-search' );

		ob_start();
		\wte_get_template( 'template-trip-search-form.php', compact( 'duration_range', 'cost_range' ) );

		return ob_get_clean();
	}

	public static function is_search_page() {
		global $post;

		if ( ! is_object( $post ) ) {
			return false;
		}

		$options = get_option( 'wp_travel_engine_settings', array() );

		return isset( $options[ 'pages' ][ 'search' ] ) && ( (int) $post->ID === (int) $options[ 'pages' ][ 'search' ] );
	}

	public static function search_page() {
		// 404 do_action not found
	}

	public static function search_fields() {
	}

	public static function settings( $settings ) {
		$settings[ 'wte_trip_search' ] = array(
			'label'        => __( 'Trip Search', 'wp-travel-engine' ),
			'content_path' => plugin_dir_path( __FILE__ ) . 'trip-search/views/admin-settings.php',
			'current'      => true,
			'has_updates'  => 'wte_note_5.5.7',
		);

		return $settings;
	}

	public static function choose_page( $pages ) {
		$options = get_option( 'wp_travel_engine_settings', array() );
		$search  = isset( $options[ 'pages' ][ 'search' ] ) ? esc_attr( $options[ 'pages' ][ 'search' ] ) : wptravelengine_get_page_by_title( 'Trip Search Result' )->ID;

		$_pages = get_pages();
		$_pages = array_column( $_pages, 'post_title', 'ID' );

		$pages[ 'wte-search-page' ] = array(
			'label'         => __( 'Trip Search Results Page', 'wp-travel-engine' ),
			'label_class'   => 'wpte-field-label',
			'wrapper_class' => 'wpte-field wpte-select wpte-floated',
			'field_label'   => __( 'Trip Search Results Page', 'wp-travel-engine' ),
			'type'          => 'select',
			'options'       => $_pages,
			'class'         => 'wpte-enhanced-select',
			'name'          => 'wp_travel_engine_settings[pages][search]',
			'default'       => $search,
			'selected'      => $search,
			'tooltip'       => __( 'This is the trip search results page with search filters.', 'wp-travel-engine' ),
		);

		return $pages;
	}

	public static function get_page_id() {
		$page_id = get_option( 'wp_travel_engine_search_page_id', false );

		if ( ! $page_id ) {
			$settings = get_option( 'wp_travel_engine_settings', array() ); // Not used wp_travel_engine_get_settings due to infinite loop.
			$page_id  = isset( $settings[ 'pages' ][ 'search' ] ) ? $settings[ 'pages' ][ 'search' ] : - 1;
			update_option( 'wp_travel_engine_search_page_id', $page_id );
		}

		$page_id = apply_filters( 'wp_travel_engine_get_search_page_id', $page_id );

		return $page_id ? absint( $page_id ) : - 1;
	}

	/**
	 * Displays Icon for duration, price and date in search widget/block.
	 *
	 * @param array $args Arguments.
	 * @param string $tag Tag Name.
	 *
	 * @since 5.7.1
	 */
	public static function search_filter_icon( $args, $tag ) {
		?>
        <span class="icon">
		<?php
		if ( class_exists( 'Elementor\Icons_Manager' ) && isset( $args[ 'icon' ] ) && isset( $args[ 'icon' ][ 'value' ] ) && $args[ 'icon' ][ 'value' ] != '' ) {
			\Elementor\Icons_Manager::render_icon( $args[ 'icon' ] );
		} else {
			switch ( $tag ) {
				case 'duration':
					?>
                    <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path
                            d="M7.4375 0.125C5.99123 0.125 4.57743 0.553871 3.3749 1.35738C2.17236 2.16089 1.2351 3.30294 0.681634 4.63913C0.128168 5.97531 -0.0166435 7.44561 0.265511 8.8641C0.547665 10.2826 1.24411 11.5855 2.26678 12.6082C3.28946 13.6309 4.59242 14.3273 6.0109 14.6095C7.42939 14.8916 8.89969 14.7468 10.2359 14.1934C11.5721 13.6399 12.7141 12.7026 13.5176 11.5001C14.3211 10.2976 14.75 8.88377 14.75 7.4375C14.75 6.47721 14.5609 5.52632 14.1934 4.63913C13.8259 3.75193 13.2872 2.94581 12.6082 2.26678C11.9292 1.58775 11.1231 1.04912 10.2359 0.681631C9.34868 0.314143 8.39779 0.125 7.4375 0.125ZM7.4375 13.2875C6.28048 13.2875 5.14944 12.9444 4.18742 12.3016C3.22539 11.6588 2.47558 10.7451 2.03281 9.6762C1.59004 8.60725 1.47419 7.43101 1.69991 6.29622C1.92563 5.16143 2.48279 4.11906 3.30093 3.30092C4.11907 2.48279 5.16144 1.92563 6.29622 1.69991C7.43101 1.47418 8.60725 1.59003 9.6762 2.0328C10.7451 2.47558 11.6588 3.22539 12.3016 4.18741C12.9444 5.14944 13.2875 6.28048 13.2875 7.4375C13.2875 8.98901 12.6712 10.477 11.5741 11.5741C10.477 12.6712 8.98902 13.2875 7.4375 13.2875ZM9.70438 7.89819L8.16875 7.01337V3.78125C8.16875 3.58731 8.09171 3.40131 7.95457 3.26418C7.81744 3.12704 7.63144 3.05 7.4375 3.05C7.24356 3.05 7.05757 3.12704 6.92043 3.26418C6.78329 3.40131 6.70625 3.58731 6.70625 3.78125V7.4375C6.70625 7.4375 6.70625 7.496 6.70625 7.52525C6.71058 7.57563 6.72293 7.625 6.74282 7.6715C6.75787 7.71488 6.77748 7.75655 6.80131 7.79581C6.82132 7.83737 6.84585 7.87661 6.87444 7.91281L6.99144 8.00787L7.05725 8.07369L8.9585 9.17056C9.06995 9.23373 9.19603 9.26651 9.32413 9.26562C9.48604 9.26676 9.64375 9.21412 9.77252 9.11596C9.90129 9.01781 9.99385 8.8797 10.0357 8.72328C10.0775 8.56686 10.0662 8.40098 10.0036 8.25166C9.94101 8.10233 9.83062 7.97801 9.68975 7.89819H9.70438Z"
                            fill="currentColor" />
					</svg>
					<?php
					break;
				case 'price':
					?>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path
                            d="M6 11V15M18 9V13M17 4C19.4487 4 20.7731 4.37476 21.4321 4.66544C21.5199 4.70415 21.5638 4.72351 21.6904 4.84437C21.7663 4.91682 21.9049 5.12939 21.9405 5.22809C22 5.39274 22 5.48274 22 5.66274V16.4111C22 17.3199 22 17.7743 21.8637 18.0079C21.7251 18.2454 21.5914 18.3559 21.3319 18.4472C21.0769 18.5369 20.562 18.438 19.5322 18.2401C18.8114 18.1017 17.9565 18 17 18C14 18 11 20 7 20C4.55129 20 3.22687 19.6252 2.56788 19.3346C2.48012 19.2958 2.43624 19.2765 2.3096 19.1556C2.23369 19.0832 2.09512 18.8706 2.05947 18.7719C2 18.6073 2 18.5173 2 18.3373L2 7.58885C2 6.68009 2 6.2257 2.13628 5.99214C2.2749 5.75456 2.40859 5.64412 2.66806 5.55281C2.92314 5.46305 3.43803 5.56198 4.46783 5.75985C5.18862 5.89834 6.04348 6 7 6C10 6 13 4 17 4ZM14.5 12C14.5 13.3807 13.3807 14.5 12 14.5C10.6193 14.5 9.5 13.3807 9.5 12C9.5 10.6193 10.6193 9.5 12 9.5C13.3807 9.5 14.5 10.6193 14.5 12Z"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
					</svg>
					<?php
					break;
				case 'date':
					?>
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path
                            d="M8 9.5C8.14834 9.5 8.29334 9.45601 8.41668 9.3736C8.54002 9.29119 8.63614 9.17406 8.69291 9.03701C8.74968 8.89997 8.76453 8.74917 8.73559 8.60368C8.70665 8.4582 8.63522 8.32456 8.53033 8.21967C8.42544 8.11478 8.2918 8.04335 8.14632 8.01441C8.00083 7.98547 7.85003 8.00032 7.71299 8.05709C7.57594 8.11386 7.45881 8.20999 7.3764 8.33332C7.29399 8.45666 7.25 8.60166 7.25 8.75C7.25 8.94891 7.32902 9.13968 7.46967 9.28033C7.61032 9.42098 7.80109 9.5 8 9.5ZM11.75 9.5C11.8983 9.5 12.0433 9.45601 12.1667 9.3736C12.29 9.29119 12.3861 9.17406 12.4429 9.03701C12.4997 8.89997 12.5145 8.74917 12.4856 8.60368C12.4566 8.4582 12.3852 8.32456 12.2803 8.21967C12.1754 8.11478 12.0418 8.04335 11.8963 8.01441C11.7508 7.98547 11.6 8.00032 11.463 8.05709C11.3259 8.11386 11.2088 8.20999 11.1264 8.33332C11.044 8.45666 11 8.60166 11 8.75C11 8.94891 11.079 9.13968 11.2197 9.28033C11.3603 9.42098 11.5511 9.5 11.75 9.5ZM8 12.5C8.14834 12.5 8.29334 12.456 8.41668 12.3736C8.54002 12.2912 8.63614 12.1741 8.69291 12.037C8.74968 11.9 8.76453 11.7492 8.73559 11.6037C8.70665 11.4582 8.63522 11.3246 8.53033 11.2197C8.42544 11.1148 8.2918 11.0434 8.14632 11.0144C8.00083 10.9855 7.85003 11.0003 7.71299 11.0571C7.57594 11.1139 7.45881 11.21 7.3764 11.3333C7.29399 11.4567 7.25 11.6017 7.25 11.75C7.25 11.9489 7.32902 12.1397 7.46967 12.2803C7.61032 12.421 7.80109 12.5 8 12.5ZM11.75 12.5C11.8983 12.5 12.0433 12.456 12.1667 12.3736C12.29 12.2912 12.3861 12.1741 12.4429 12.037C12.4997 11.9 12.5145 11.7492 12.4856 11.6037C12.4566 11.4582 12.3852 11.3246 12.2803 11.2197C12.1754 11.1148 12.0418 11.0434 11.8963 11.0144C11.7508 10.9855 11.6 11.0003 11.463 11.0571C11.3259 11.1139 11.2088 11.21 11.1264 11.3333C11.044 11.4567 11 11.6017 11 11.75C11 11.9489 11.079 12.1397 11.2197 12.2803C11.3603 12.421 11.5511 12.5 11.75 12.5ZM4.25 9.5C4.39834 9.5 4.54334 9.45601 4.66668 9.3736C4.79001 9.29119 4.88614 9.17406 4.94291 9.03701C4.99968 8.89997 5.01453 8.74917 4.98559 8.60368C4.95665 8.4582 4.88522 8.32456 4.78033 8.21967C4.67544 8.11478 4.5418 8.04335 4.39632 8.01441C4.25083 7.98547 4.10003 8.00032 3.96299 8.05709C3.82594 8.11386 3.70881 8.20999 3.6264 8.33332C3.54399 8.45666 3.5 8.60166 3.5 8.75C3.5 8.94891 3.57902 9.13968 3.71967 9.28033C3.86032 9.42098 4.05109 9.5 4.25 9.5ZM13.25 2H12.5V1.25C12.5 1.05109 12.421 0.860322 12.2803 0.71967C12.1397 0.579018 11.9489 0.5 11.75 0.5C11.5511 0.5 11.3603 0.579018 11.2197 0.71967C11.079 0.860322 11 1.05109 11 1.25V2H5V1.25C5 1.05109 4.92098 0.860322 4.78033 0.71967C4.63968 0.579018 4.44891 0.5 4.25 0.5C4.05109 0.5 3.86032 0.579018 3.71967 0.71967C3.57902 0.860322 3.5 1.05109 3.5 1.25V2H2.75C2.15326 2 1.58097 2.23705 1.15901 2.65901C0.737053 3.08097 0.5 3.65326 0.5 4.25V13.25C0.5 13.8467 0.737053 14.419 1.15901 14.841C1.58097 15.2629 2.15326 15.5 2.75 15.5H13.25C13.8467 15.5 14.419 15.2629 14.841 14.841C15.2629 14.419 15.5 13.8467 15.5 13.25V4.25C15.5 3.65326 15.2629 3.08097 14.841 2.65901C14.419 2.23705 13.8467 2 13.25 2ZM14 13.25C14 13.4489 13.921 13.6397 13.7803 13.7803C13.6397 13.921 13.4489 14 13.25 14H2.75C2.55109 14 2.36032 13.921 2.21967 13.7803C2.07902 13.6397 2 13.4489 2 13.25V6.5H14V13.25ZM14 5H2V4.25C2 4.05109 2.07902 3.86032 2.21967 3.71967C2.36032 3.57902 2.55109 3.5 2.75 3.5H13.25C13.4489 3.5 13.6397 3.57902 13.7803 3.71967C13.921 3.86032 14 4.05109 14 4.25V5ZM4.25 12.5C4.39834 12.5 4.54334 12.456 4.66668 12.3736C4.79001 12.2912 4.88614 12.1741 4.94291 12.037C4.99968 11.9 5.01453 11.7492 4.98559 11.6037C4.95665 11.4582 4.88522 11.3246 4.78033 11.2197C4.67544 11.1148 4.5418 11.0434 4.39632 11.0144C4.25083 10.9855 4.10003 11.0003 3.96299 11.0571C3.82594 11.1139 3.70881 11.21 3.6264 11.3333C3.54399 11.4567 3.5 11.6017 3.5 11.75C3.5 11.9489 3.57902 12.1397 3.71967 12.2803C3.86032 12.421 4.05109 12.5 4.25 12.5Z"
                            fill="currentColor" /></svg>
					<?php
					break;
				default:
					break;
			}
		}
		?>
		</span>
		<?php
	}
}
