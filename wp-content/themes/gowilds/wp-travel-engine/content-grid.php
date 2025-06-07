<?php
/**
 * Template part for displaying grid posts
 *
 * This template can be overridden by copying it to yourtheme/wp-travel-engine/content-grid.php.
 *
 * @package Wp_Travel_Engine
 * @subpackage Wp_Travel_Engine/includes/templates
 * @since @release-version //TODO: change after travel muni is live
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $post;

echo '<div class="category-trips-single">';
get_template_part('templates/content/item-trip', 'style-1');
echo '</div>';