<?php
  use Elementor\Group_Control_Image_Size;
  use Elementor\Icons_Manager;

  $settings = $this->get_settings_for_display();
  $skin = $settings['style'];
  $title_text = $settings['title_text'];
  $description_text = $settings['description_text'];
  $this->add_render_attribute( 'block', 'class', [ 'gsc-image-content', $settings['style'] ] );
  $header_tag = 'h2';
	
  $this->add_render_attribute( 'title_text', 'class', 'title' );
  $this->add_render_attribute( 'description_text', 'class', 'desc' );

  $this->add_inline_editing_attributes( 'title_text', 'none' );
  $this->add_inline_editing_attributes( 'description_text' );

?>
		
	<?php if($skin == 'skin-v1'){ ?>
		<div class="about-one__single">
		  	<div class="about-one__box-content">
			 	<?php 
			 		if( !empty($settings['image']['url']) ){
						echo '<div class="about-one__image">';
							$image_html = Group_Control_Image_Size::get_attachment_image_html($settings, 'image');
							echo $image_html;
							echo '<span class="about-one__shape-1"></span>';
							echo '<span class="about-one__shape-2"></span>';
							echo '<span class="about-one__shape-3"></span>';
							echo '<span class="about-one__shape-4"></span>';
						echo '</div>';
			 		}

			 		if( $settings['title_text'] || $settings['description_text'] ){
			 			echo '<div class="about-one__content-inner">';
			 				if($settings['title_text']){
			 					echo '<div class="about-one__title">' . esc_html($settings['title_text']) . '</div>';
			 				}
			 				if($settings['description_text']){
			 					echo '<div class="about-one__desc">' . esc_html($settings['description_text']) . '</div>';
			 				}
			 			echo '</div>';
			 		}
			 	?>
			</div> 	

			<?php $this->gva_render_link_overlay($settings['link']); ?>
		</div>
	<?php } ?>  
	 

	<?php if($skin == 'skin-v2'){ ?>
		<div class="about-two__single">
		  	<?php 
		  		if( !empty($settings['image']['url']) ){
				 	echo '<div class="about-two__image">';
				 		echo '<div class="content-inner">';
						  $image_url = $settings['image']['url']; 
						  $image_html = '<img src="' . esc_url($image_url) .'" alt="'. esc_attr($settings['title_text']) . '" />';
						  $this->gva_render_link_html($image_html, $settings['link']);
				 		echo '</div>';
				 		if(!empty($settings['image_logo']['url'])){
				 			echo '<div class="about-two__logo">';
				 				echo '<img src="'.esc_url($settings['image_logo']['url']).'" alt="'. esc_attr($settings['title_text']) . '" />';
				 			echo '</div>';
				 		}
				 	echo '</div>';
		  		} 
		  		if( !empty($settings['image_second']['url']) ){
				 	echo '<div class="about-two__image-second">';
						echo '<div class="content-inner">';
						 	$image_url_second = $settings['image_second']['url']; 
						 	$image_html = '<img src="' . esc_url($image_url_second) .'" alt="'. esc_attr($settings['title_text']) . '" />';
					  		$this->gva_render_link_html($image_html, $settings['link']);
						echo '</div>';
				 	echo '</div>';
			 	}

		  		if( $settings['title_text'] || $settings['description_text'] ){
		 			echo '<div class="about-two__box-content">';
		 				echo '<div class="about-two__box-content-inner">';
		 					if($settings['title_text']){
			 					echo '<div class="about-two__title">' . htmlspecialchars($settings['title_text']) . '</div>';
			 				}
			 				if($settings['description_text']){
			 					echo '<div class="about-two__desc">' . htmlentities($settings['description_text']) . '</div>';
			 				}
			 			echo '</div>';	
		 			echo '</div>';
		 		}
			?>
		</div>
	<?php } ?> 

	<?php if($skin == 'skin-v3'){ ?>
		<div class="about-three__single">
		  	<?php 
		  		if( !empty($settings['image']['url']) ){
				 	echo '<div class="about-three__image">';
				 		echo '<div class="content-inner">';
						  $image_url = $settings['image']['url']; 
						  $image_html = '<img src="' . esc_url($image_url) .'" alt="'. esc_attr($settings['title_text']) . '" />';
						  $this->gva_render_link_html($image_html, $settings['link']);
				 		echo '</div>';
				 	echo '</div>';
		  		} 
		  		if( !empty($settings['image_second']['url']) ){
				 	echo '<div class="about-three__image-second">';
						echo '<div class="content-inner">';
						 	$image_url_second = $settings['image_second']['url']; 
						 	$image_html = '<img src="' . esc_url($image_url_second) .'" alt="'. esc_attr($settings['title_text']) . '" />';
					  		$this->gva_render_link_html($image_html, $settings['link']);
						echo '</div>';
				 	echo '</div>';
			 	}
		  		if( $settings['title_text'] || $settings['description_text'] ){
		 			echo '<div class="about-three__box-content">';
		 				echo '<div class="about-three__box-content-inner">';
		 					if($settings['title_text']){
			 					echo '<div class="about-three__title">' . html_entity_decode($settings['title_text']) . '</div>';
			 				}
			 				if($settings['description_text']){
			 					echo '<div class="about-three__desc">' . html_entity_decode($settings['description_text']) . '</div>';
			 				}
			 			echo '</div>';	
		 			echo '</div>';
		 		}
			?>
		</div>
	<?php } ?>

	<?php if($skin == 'skin-v4'){ ?>
		<div class="about-four__single">
			<div class="about-four__wrap">
			  	<?php 
			  		if( !empty($settings['image_second']['url']) || $settings['title_text'] || $settings['description_text'] ){
		  				echo '<div class="about-four__left">';
			  				if($settings['image_second']['url']){
							 	echo '<div class="about-four__image-second">';
									echo '<div class="content-inner">';
									 	$image_url_second = $settings['image_second']['url']; 
									 	$image_html = '<img src="' . esc_url($image_url_second) .'" alt="'. esc_attr($settings['title_text']) . '" />';
								  		$this->gva_render_link_html($image_html, $settings['link']);
									echo '</div>';
							 	echo '</div>';
							 }
							 if($settings['title_text'] || $settings['description_text']){
							 	echo '<div class="about-four__box-content">';
					 				echo '<div class="about-four__box-content-inner">';
					 					if($settings['title_text']){
						 					echo '<div class="about-four__title">' . html_entity_decode($settings['title_text']) . '</div>';
						 				}
						 				if($settings['description_text']){
						 					echo '<div class="about-four__desc">' . html_entity_decode($settings['description_text']) . '</div>';
						 				}
						 			echo '</div>';	
					 			echo '</div>';
					 		}
				 		echo '</div>';
				 	}

			  		if( !empty($settings['image']['url']) ){
		  				echo '<div class="about-four__right">';
						 	echo '<div class="about-four__image">';
						 		echo '<div class="content-inner">';
								  $image_url = $settings['image']['url']; 
								  $image_html = '<img src="' . esc_url($image_url) .'" alt="'. esc_attr($settings['title_text']) . '" />';
								  $this->gva_render_link_html($image_html, $settings['link']);
						 		echo '</div>';
						 	echo '</div>';
			  			echo '</div>';	
			  		} 
				?>
			</div>	
		</div>
	<?php } ?> 
  
<?php if($skin == 'skin-v5'){ ?>
  	<div class="about-five__single">
  		<div class="about-five__content">
		 	<?php 
		 		if(!empty($settings['image']['url'])){
					echo '<div class="about-five__image">';
						echo '<div class="about-five__image-inner">';
							$image_html = Group_Control_Image_Size::get_attachment_image_html($settings, 'image');
							echo ($image_html);
						echo '</div>';	
					echo '</div>';
		 		}
		 	
	 			echo '<div class="about-five__content-inner">';
					if($title_text){
						echo '<'.esc_attr($header_tag) . ' class="about-five__title">';
							echo html_entity_decode($title_text);
						echo '</'.esc_attr($header_tag).'>';
					} 
					if($description_text){
						echo '<div class="about-five__desc">' . wp_kses($description_text, true) . '</div>';
					}
				echo '</div>';

			 	$this->gva_render_link_overlay($settings['link'], 'about-five__link'); 
			?>
	 </div>  
  </div>
<?php } ?> 


<?php if($skin == 'skin-v6'){ ?>
	<div class="about-six__single">
	  	<?php 
			echo '<div class="about-six__content">';
	  		if( !empty($settings['image']['url']) ){
		 		echo '<div class="about-six__image">';
				  	$image_url = $settings['image']['url']; 
				  	$image_html = '<img src="' . esc_url($image_url) .'" alt="'. esc_attr($settings['title_text']) . '" />';
				  	$this->gva_render_link_html($image_html, $settings['link']);
		 		echo '</div>';
	  		} 
	  		if(!empty($settings['image_logo']['url'])){
	 			echo '<div class="about-six__logo">';
	 				echo '<img src="'.esc_url($settings['image_logo']['url']).'" alt="'. esc_attr($settings['title_text']) . '" />';
	 			echo '</div>';
	 		}
			echo '</div>';
		?>
	</div>
<?php } ?> 