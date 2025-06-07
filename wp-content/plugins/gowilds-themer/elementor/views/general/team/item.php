<?php 
	use Elementor\Group_Control_Image_Size;

	$style = $settings['style'];
	$image_id = isset($item['image']['id']) && $item['image']['id'] ? $item['image']['id'] : 0; 
	$image_url = isset($item['image']['url']) && $item['image']['url'] ? $item['image']['url'] : '';
	$image_alt = $item['name'];
	if($image_id){
		$attach_url = wp_get_attachment_image_src( $image_id, $settings['image_size']);
		if(isset($attach_url[0]) && $attach_url[0]){
			$image_url = $attach_url[0];
		}
		$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', TRUE);
	}
	$name = $item['name'];
	
	$image = '<img src="' . esc_url($image_url) . '" alt="' . esc_html($image_alt) . '" />';

?>

<?php if($style == 'style-1'){ ?>
	<div class="team-one__single elementor-repeater-item-<?php echo $item['_id'] ?>">
		<?php 
			if($image_url){ 
				echo '<div class="team-one__image">';
					echo $this->gva_render_link_html($image, $item['link'], 'link-content'); 
					echo '<div class="team-one__social">';
						echo '<div class="team-one__social-control"><i class="fas fa-share-alt"></i></div>';
						echo '<div class="team-one__social-link">';
							$this->gva_render_link_html_2('<i class="fa fa-facebook"></i>', $item['facebook']);
							$this->gva_render_link_html_2('<i class="fa fa-twitter"></i>', $item['twitter']);
							$this->gva_render_link_html_2('<i class="fa fa-instagram"></i>', $item['instagram']);
							$this->gva_render_link_html_2('<i class="fa fa-pinterest"></i>', $item['pinterest']);
						echo '</div>';	
					echo '</div>';
			 	echo '</div>';
			} 
		?>	
		<div class="team-one__content">
			<div class="team-one__content-inner">
				<?php 
					if($item['name']){ 
						echo '<h3 class="team-one__name">';
							echo $this->gva_render_link_html($item['name'], $item['link']);
						echo '</h3>';
					} 
					if($item['position']){
						echo '<div class="team-one__job">' . $item['position'] . '</div>';
					} 
				?>
			</div>   
		</div>
	</div>		
<?php } ?>

<?php if($style == 'style-2'){ ?>
	<div class="gsc-team-item-2">
		<?php if($image_url){ ?>
			<div class="team-image">
				<div class="image-content">
					<?php echo $this->gva_render_link_html($image, $item['link'], 'link-content') ?>  
				</div>
				<div class="socials-team">
					<div class="socials-control"><i class="fa-solid fa-plus"></i></div>
					<div class="social-link">
						<?php $this->gva_render_link_html_2('<i class="fa fa-facebook"></i>', $item['facebook']) ?>
						<?php $this->gva_render_link_html_2('<i class="fa fa-twitter"></i>', $item['twitter']) ?>
						<?php $this->gva_render_link_html_2('<i class="fa fa-instagram"></i>', $item['instagram']) ?>
						<?php $this->gva_render_link_html_2('<i class="fa fa-pinterest"></i>', $item['pinterest']) ?>
					</div>
				</div>
			</div>
		<?php } ?>  
		<div class="team-content">
			<div class="content-inner">
				<?php if($item['name']){ ?>
					<h3 class="team-name">
						<?php echo $this->gva_render_link_html($item['name'], $item['link']) ?>   
					</h3>
				<?php } ?>

				<?php if($item['position']){ ?>
					<div class="team-job"><?php echo $item['position'] ?></div>
				<?php } ?>

				<?php if($item['desc']){ ?>
					<div class="team-desc"><?php echo $item['desc'] ?></div>
				<?php } ?>

				
			</div>   
		</div>
	</div>      
<?php } ?>