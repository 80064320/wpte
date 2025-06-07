<?php
	use Elementor\Icons_Manager;

	if (!defined('ABSPATH')){ exit; }

	global $gowilds_post;

	if (!$gowilds_post){ return; }

	if ($gowilds_post->post_type != BABE_Post_types::$booking_obj_post_type){ return;}

	$post_id = $gowilds_post->ID;

	$ba_post = BABE_Post_types::get_post($gowilds_post->ID);

	$total_rating = BABE_Rating::get_post_total_rating($post_id);
	$total_votes  = BABE_Rating::get_post_total_votes($post_id);

	if(!$total_rating){
		echo '<div class="gowilds-no-rating">'.esc_html__('No reviews yet', 'gowilds-themer').'</div>';
		return;
	}

	$rating_arr = BABE_Rating::get_post_rating($post_id);

	$rating_criteria = BABE_Settings::get_rating_criteria();
	$stars_num       = BABE_Settings::get_rating_stars_num();

	$criteria_num = sizeof($rating_arr);
	$step         = $stars_num / 5;
	$text         = '';

	if ($total_rating <= $step) {
		$text = esc_html__('Bad', 'gowilds-themer');
	}elseif ($total_rating > $step && $step * 2 >= $total_rating) {
		$text = esc_html__('Not Bad', 'gowilds-themer');
	}elseif ($total_rating > $step * 2 && $step * 3 >= $total_rating) {
		$text = esc_html__('Good', 'gowilds-themer');
	}elseif ($total_rating > $step * 3 && $step * 4 >= $total_rating) {
		$text = esc_html__('Very Good', 'gowilds-themer');
	}elseif ($total_rating > $step * 4) {
		$text = esc_html__('Wonderful', 'gowilds-themer');
	}



?>

<div class="gowilds-single-rating-criteria">
	<div class="box-content">
		
		<div class="rating-value">
			<div class="rating-score">
				<?php echo round($total_rating, 2) . '<span>/' . $stars_num . '</span>'; ?>
			</div>
			<div class="vote-text">
				<?php echo esc_html($text); ?>
			</div>
			<div class="vote-number"><?php printf('%s ' . _n('verified review', 'verified reviews', $total_votes, 'gowilds-themer'), $total_votes); ?></div>
		</div>

	  	<div class="all-review-progress">
			<?php
				if($criteria_num > 1){
					foreach ($rating_criteria as $rating_name => $rating_title) {
						if(isset($rating_arr[$rating_name])){
							
							echo '<div class="review-progress">';
								$rating = floatval($rating_arr[$rating_name]);
								$width  = $rating / $stars_num * 100; ?>
									<div class="progress-meta">
										<span class="item-title"><?php echo esc_html($rating_title) ?></span>
										<span class="item-value"><?php echo round($rating, 2) . '/' . $stars_num; ?></span>
									</div>	
									<div class="progress">
										<div class="progress-bar" data-progress-animation="<?php echo esc_attr(round($width) . '%') ?>"></div>
									</div>
								<?php
							echo '</div>';

						}
					}
				}
			?>
	  	</div>

	</div>
</div>

