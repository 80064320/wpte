<?php
   if ( ! defined( 'ABSPATH' ) ) exit;
   $query = $this->query_posts();
  	$_random = gaviasthemer_random_id();

	$this->add_render_attribute('wrapper', 'class', ['all-tour listings-grid clearfix']);

	//add_render_attribute grid
	$this->get_grid_settings();
?>
<div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
   	<div class="listing-main-items">
         <div <?php echo $this->get_render_attribute_string('grid') ?>>
           	<?php 
					global $post;
					$count = 0;
					if($query->found_posts){
						while ( $query->have_posts() ) { 
							$query->the_post();
							echo '<div class="item-columns">';
							
								$this->gowilds_get_template_part('templates/content/item', $settings['card_style'], array(
								  'thumbnail_size' => $settings['image_size'],
								  'excerpt_words'	 => $settings['excerpt_words']
								));
							echo '</div>';
						}
					}else{
						echo '<div class="directorist-archive-notfound">' . esc_html__( 'No listings found.', 'gowilds-themer' ) . '</div>';
					}
            ?>
         </div>
   	</div>
</div>

<?php
/* Restore original Post Data */
wp_reset_postdata();