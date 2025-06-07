<?php
/**
 * Trip Cost Widget Demo.
 *
 * @since 1.3.9
 * @package wptravelengine-elementor-widgets
 */

$attributes   = (object) $attributes;
$include_icon = isset( $attributes->{'include_icon'} ) ? $attributes->{'include_icon'} : 'fas fa-check';
$exclude_icon = isset( $attributes->{'exclude_icon'} ) ? $attributes->{'exclude_icon'} : 'fas fa-times';

global $post;

$post_meta = get_post_meta( $post->ID, 'wp_travel_engine_setting', true );

// Cost excludes items
$cost_excludes_content = array(
	'International flights',
	'Travel insurance',
	'Nepal entry visa',
	'Personal expenses',
);
$costexcludes  = array();

// Cost includes items
$cost_includes_content = array(
	'Airport transfers.',
	'Accommodation.',
	'Meals.',
	'Internal flights',
);
$costincludes  = array();
?>

<div id="wte-cost" class="post-data cost">
	<div class="content">
		<?php
		// Process cost includes
		if ( !empty( $cost_includes_content ) && isset( $attributes->{'showCostInclude'} ) && 'yes' === $attributes->{'showCostInclude'} ) {
			$costincludes = array();
			foreach ( $cost_includes_content as $include ) {
				if ( ! empty( trim( $include ) ) ) {
					$costincludes[] = sprintf(
						'<li>%s%s</li>',
						!empty($include_icon) ? sprintf('<i class="%s"></i>', esc_attr($include_icon)) : '',
						esc_html( trim( $include ) )
					);
				}
			}
		}
		?>
		
		<?php
		// Process cost excludes
		if ( !empty( $cost_excludes_content ) && isset( $attributes->{'showCostExclude'} ) && 'yes' === $attributes->{'showCostExclude'} ) {
			$costexcludes = array();
			foreach ( $cost_excludes_content as $exclude ) {
				if ( ! empty( trim( $exclude ) ) ) {
					$costexcludes[] = sprintf(
						'<li>%s%s</li>',
						!empty($exclude_icon) ? sprintf('<i class="%s"></i>', esc_attr($exclude_icon)) : '',
						esc_html( trim( $exclude ) )
					);
				}
			}
		}

		if ( ! empty( $costincludes ) && is_array( $costincludes ) ) : ?>
			<div class="cost-includes">
				<h3><?php esc_html_e( 'Cost Includes', 'wptravelengine-elementor-widgets' ); ?></h3>
				<ul <?php echo empty( $include_icon['value'] ) ? 'id="include-result"' : 'class="custom-icon"'; ?>>
					<?php 
					$includes_html = is_array($costincludes) ? implode('', $costincludes) : '';
					echo wp_kses_post($includes_html);
					?>
				</ul>
			</div>
		<?php endif;

		if ( ! empty( $costexcludes ) && is_array( $costexcludes ) ) : ?>
			<div class="cost-excludes">
				<h3><?php esc_html_e( 'Cost Excludes', 'wptravelengine-elementor-widgets' ); ?></h3>
				<ul <?php echo empty( $exclude_icon['value'] ) ? 'id="exclude-result"' : 'class="custom-icon"'; ?>>
					<?php 
					$excludes_html = is_array($costexcludes) ? implode('', $costexcludes) : '';
					echo wp_kses_post($excludes_html);
					?>
				</ul>
			</div>
		<?php endif; ?>

	</div>
</div>
