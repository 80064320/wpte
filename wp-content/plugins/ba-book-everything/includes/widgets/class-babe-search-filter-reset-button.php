<?php

function babe_load_widget_search_filter_reset_button() {
    register_widget( 'BABE_Search_filter_reset_button' );
}
add_action( 'widgets_init', 'babe_load_widget_search_filter_reset_button' );

class BABE_Search_filter_reset_button extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'babe_widget_search_filter_reset_button',
            __('BA Search filter reset button', 'ba-book-everything'),
            array( 'description' => __('Show Search filter reset button', 'ba-book-everything'), )
        );
    }

    public function widget( $args, $instance ) {

        if ( !isset($_GET['request_search_results']) && !isset($_POST['request_search_results']) ){
            return;
        }

        if ( ! isset( $args['widget_id'] ) ) {
            $args['widget_id'] = $this->id;
        }

        extract( $args );
        $title = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);

        echo $before_widget;

        echo BABE_html::get_search_filter_reset_button($title);

        echo $after_widget;
    }

    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        return $instance;
    }

    public function form( $instance ) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Button title:', 'ba-book-everything'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <?php
    }
}
