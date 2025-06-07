<?php 
    use Elementor\Plugin;
    
    $protocol = is_ssl() ? 'https' : 'http';
    $document = Plugin::instance()->documents->get(get_the_ID());
    $header_bg_black = $document->get_settings('header_background_black') ? 'header-bg-black' : '';
    
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width">
    <link rel="profile" href="<?php echo esc_attr($protocol) ?>://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <section id="wp-main-content" class="clearfix main-page">
        <h1 class="hidden">Header Builder</h1>
        <?php do_action( 'gowilds_header_mobile' );  ?>
        <header class="container-full header-builder <?php echo esc_attr($header_bg_black) ?>">  
            <div class="header-inner">
                <?php
                    while ( have_posts() ) :
                        the_post();
                        the_content();
                    endwhile;
                ?>
            </div>    

        </header>

    </section>
<?php wp_footer(); ?>
</body>
</html>
