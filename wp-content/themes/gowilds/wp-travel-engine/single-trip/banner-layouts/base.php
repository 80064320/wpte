<?php
/**
 * Base layout for banner.
 *
 * @since 6.3.3
 */

/**
 * @var string $specific_layout Layouts other than layout-1 and layout-5.
 * @var bool $is_mobile_view
 */
$wptravelengine_settings 	= get_option( 'wp_travel_engine_settings', array() );
$banner_layout           	= $wptravelengine_settings[ 'trip_banner_layout' ] ?? 'banner-default';
$meta_layout 					= get_post_meta( get_the_ID(), 'gowilds_banner_layout', true );
$banner_layout 				=! empty($meta_layout) && $meta_layout != '_default_' ? $meta_layout : $banner_layout;

echo '<div class="'.esc_attr($banner_layout).'__wrap">';
	$specific_layout && print( '<div class="trip-content-area">' );

	if ( $is_mobile_view ) {
		wptravelengine_get_template( "single-trip/banner-layouts/list.php" );
	} else {
		wptravelengine_get_template( "single-trip/banner-layouts/list.php" );
	}

	$specific_layout && print( '</div>' );
echo '</div>';
?>
