<?php
/**
 * Single Trip Content
 *
 * Closing entry-content div is left out on purpose!.
 *
 * This template can be overridden by copying it to yourtheme/wp-travel-engine/single-trip/trip-content.php.
 *
 * @package Wp_Travel_Engine
 * @subpackage Wp_Travel_Engine/includes/templates
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$post_meta = get_post_meta( get_the_ID(), 'wp_travel_engine_setting', true );
$data = array(
	'cost' => $post_meta[ 'cost' ]
);

?>

<div class="entry-content">
	<?php
	if ( isset( $settings['departure']['section'] ) ) {
		if ( ! isset( $post_meta['departure_dates']['section'] ) ) {
			do_action( 'Wte_Fixed_Starting_Dates_Action' );
		}
	}
	?>

	<div class="trip-post-content">
		<?php the_content(); ?>
		<?php wte_get_template( 'single-trip/trip-tabs/cost.php', $data ); ?>
	</div>
	<!-- ./trip-post-content -->
	<?php
