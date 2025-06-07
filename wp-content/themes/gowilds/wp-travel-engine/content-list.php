<?php

/**
 * Template part for displaying list posts
 *
 * This template can be overridden by copying it to yourtheme/wp-travel-engine/content-list.php.
 *
 * @package Wp_Travel_Engine
 * @subpackage Wp_Travel_Engine/includes/templates
 * @since @release-version //TODO: change after travel muni is live
 */
wp_enqueue_script( 'wte-popper' );
wp_enqueue_script( 'wte-tippyjs' );

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $post;

echo '<div class="category-trips-single">';
get_template_part('templates/content/item-trip', 'style-list');
echo '</div>';