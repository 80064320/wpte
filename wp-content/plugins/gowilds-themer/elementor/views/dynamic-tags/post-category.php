<?php
	if (!defined('ABSPATH')) {
		exit; 
	}
	global $gowilds_post;
	if (!$gowilds_post){
		return;
	}
	?>
	
	<div class="post-category">
		<?php 
			if($settings['show_icon']){ 
				echo '<i class="fas fa-folder-open"></i>';
			}
			echo '<span>' . get_the_category_list( ", ", '', $gowilds_post->ID ) . '</span>';
		?>
	</div>      

