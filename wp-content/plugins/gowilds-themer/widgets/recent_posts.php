<?php
/**
 * Widget API: WP_Widget_Recent_Posts class
 *
 * @package WordPress
 * @subpackage Widgets
 * @since 4.4.0
 */

/**
 * Core class used to implement a Recent Posts widget.
 *
 * @since 2.8.0
 *
 * @see WP_Widget
 */

class Gowilds_Themer_Widget_Recent_Posts extends WP_Widget {
   
   public function __construct() {
      $widget_ops = array(
         'classname'                   => 'gva_widget_recent_entries',
         'description'                 => __( 'Your site&#8217;s most recent Posts.' ),
         'customize_selective_refresh' => true,
      );
      parent::__construct( 'gva-recent-posts', __( 'GVA Recent Posts' ), $widget_ops );
      $this->alt_option_name = 'gva_widget_recent_entries';
   }

   /**
    * Outputs the content for the current Recent Posts widget instance.
    *
    * @since 2.8.0
    *
    * @param array $args     Display arguments including 'before_title', 'after_title',
    *                        'before_widget', and 'after_widget'.
    * @param array $instance Settings for the current Recent Posts widget instance.
   */

   public function widget( $args, $instance ) {
      if ( ! isset( $args['widget_id'] ) ) {
         $args['widget_id'] = $this->id;
      }
      $default_title = esc_html__( 'Recent Posts', 'gowilds-themer' );
      $title         = ( ! empty( $instance['title'] ) ) ? $instance['title'] : $default_title;

      /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
      $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

     $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
      if ( ! $number ) {
         $number = 5;
      }
      $show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

      $r = new WP_Query(
         /**
          * Filters the arguments for the Recent Posts widget.
          *
          * @since 3.4.0
          * @since 4.9.0 Added the `$instance` parameter.
          *
          * @see WP_Query::get_posts()
          *
          * @param array $args     An array of arguments used to retrieve the recent posts.
          * @param array $instance Array of settings for the current widget.
          */
         apply_filters(
            'widget_posts_args',
            array(
               'posts_per_page'      => $number,
               'no_found_rows'       => true,
               'post_status'         => 'publish',
               'ignore_sticky_posts' => true,
            ),
            $instance
         )
      );

      if ( ! $r->have_posts() ) {
         return;
      }
      ?>

     <?php echo $args['before_widget']; ?>

      <?php
      if ( $title ) {
         echo $args['before_title'] . $title . $args['after_title'];
      }

      $format = current_theme_supports( 'html5', 'navigation-widgets' ) ? 'html5' : 'xhtml';

      /** This filter is documented in wp-includes/widgets/class-wp-nav-menu-widget.php */
      $format = apply_filters( 'navigation_widgets_format', $format );

      if ( 'html5' === $format ) {
         // The title may be filtered: Strip out HTML and make sure the aria-label is never empty.
         $title      = trim( strip_tags( $title ) );
         $aria_label = $title ? $title : $default_title;
         echo '<nav role="navigation" aria-label="' . esc_attr( $aria_label ) . '">';
      }
      ?>

      <ul>
         <?php foreach ( $r->posts as $recent_post ) : ?>
            <?php
            $post_title   = get_the_title( $recent_post->ID );
            $title        = ( ! empty( $post_title ) ) ? $post_title : __( '(no title)' );
            $aria_current = '';

            if ( get_queried_object_id() === $recent_post->ID ) {
               $aria_current = ' aria-current="page"';
            }
            ?>
            <li>
               <div class="clearfix post-list-item <?php echo (has_post_thumbnail($recent_post->ID) ? 'has-thumbnail' : 'no-thumbnail' )  ?>">
                  <?php if( has_post_thumbnail($recent_post->ID) ){ ?>
                     <div class="post-thumbnail">
                        <a href="<?php the_permalink($recent_post->ID); ?>">
                           <?php echo get_the_post_thumbnail($recent_post->ID, 'thumbnail') ?>
                        </a>
                     </div>
                  <?php } ?>   
                  <div class="post-content">
                     <?php
                        $comments_number = get_comments_number_text( esc_html__('0 Comments', 'gowilds-themer'), esc_html__('1 Comment', 'gowilds-themer'), esc_html__('% Comments', 'gowilds-themer'), $recent_post->ID);
                        printf( 
                           '<span class="post-comments"><i class="icon far fa-comments"></i>%1$s</span>',
                           $comments_number
                        ); 
                     ?>
                     <h3 class="post-title"><a href="<?php the_permalink( $recent_post->ID ); ?>"<?php echo $aria_current; ?>><?php echo $title; ?></a></h3>
                     <?php if ( $show_date ) : ?>
                        <span class="post-date"><?php echo get_the_date( '', $recent_post->ID ); ?></span>
                     <?php endif; ?>
                  </div>   
               </div>   
            </li>
         <?php endforeach; ?>
      </ul>

      <?php
      if ( 'html5' === $format ) {
         echo '</nav>';
      }

      echo $args['after_widget'];
   }

   public function update( $new_instance, $old_instance ) {
      $instance              = $old_instance;
      $instance['title']     = sanitize_text_field( $new_instance['title'] );
      $instance['number']    = (int) $new_instance['number'];
      $instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
      return $instance;
   }

   /**
    * Outputs the settings form for the Recent Posts widget.
    *
    * @since 2.8.0
    *
    * @param array $instance Current settings.
    */
   public function form( $instance ) {
      $title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
      $number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
      $show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
      ?>
      <p>
         <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
         <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
      </p>

      <p>
         <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
         <input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" />
      </p>

      <p>
         <input class="checkbox" type="checkbox"<?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
         <label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display post date?' ); ?></label>
      </p>
      <?php
   }
}

function gowilds_themer_widget_recent_posts(){
   return register_widget('Gowilds_Themer_Widget_Recent_Posts');
}

add_action('widgets_init', 'gowilds_themer_widget_recent_posts');
