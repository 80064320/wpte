<?php

   $this->add_render_attribute( 'block', 'class', [ $settings['breakpoint_menu_mobile'], 'gva-navigation-menu', ' menu-align-' . $settings['align'], $settings['style'] ] );
   $args = [
      'echo'        => false,
      'menu'        => !empty($settings['menu']) ? $settings['menu'] : 'main-menu',
      'menu_class'  => 'gva-nav-menu gva-main-menu',
      'menu_id'     => 'menu-' . wp_rand(5),
      'container'   => 'div',
      'fallback_cb' => false
   ];

   if(class_exists('Gowilds_Walker')){
      $args['walker' ]     = new Gowilds_Walker();
   }
   
   $menu_html = wp_nav_menu($args);

   if (empty($menu_html)) {
      return;
   }
?>

<div <?php echo $this->get_render_attribute_string( 'block' ) ?>>
   <div class="nav-one__default nav-screen__default">
      <?php echo $menu_html; ?>
   </div>
   <div class="nav-one__mobile nav-screen__mobile">
      <div class="canvas-menu gva-offcanvas">
         <a class="dropdown-toggle" data-canvas=".mobile" href="#"><i class="icon las la-bars"></i></a>
      </div>
   </div>
</div>