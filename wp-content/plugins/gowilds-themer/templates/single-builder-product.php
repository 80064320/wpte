<?php 
	use Elementor\Plugin;
	$protocol = is_ssl() ? 'https' : 'http';
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="<?php echo esc_attr($protocol) ?>://gmpg.org/xfn/11">
</head>

<body <?php body_class('product single-product woocommerce woocommerce-page'); ?>>
  	<?php get_header(); ?>
	 	<section id="wp-main-content" class="clearfix main-page">
		  	<header class="container-full single-product-builder">  
				<div class="product-single-main">
					<div class="product-single-inner">
						<?php
							while ( have_posts() ) :
								the_post();
								the_content();
							endwhile;
						?>
					</div>   
				</div>    
		  	</header>
		</section>
<?php wp_footer(); ?>
</body>
</html>
