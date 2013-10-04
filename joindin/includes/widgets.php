<?php

class Joind_In_Widget extends WP_Widget {
    function __construct() {
        $widget_ops = array(
            'classname' => 'joind_in_widget',
            'description' => 'API PULL',
        );
        parent::__construct('joindin', __('Joind In Widget'), $widget_ops);

        $this->_api = new joind_in_api();
    }

    function widget($args, $instance) {
        extract($args);
        $event_id = isset($instance['event_id']) ? $instance['event_id'] : false;

        if (!$event_id) {
            return;
        }

        echo $before_widget;
        echo '<h2>Joind In</h2>';

        // @Todo: caching
        $data = $this->_api->getEvent($id)->getResponse();
        echo print_r($data, true);

        echo $after_widget;
    }


    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $new_instance = wp_parse_args( (array) $new_instance, array(
            'event_id' => 0,
        ));
        $instance['event_id'] = $new_instance['event_id'];

        return $instance;
    }
    function form ($instance) {
        $instance = wp_parse_args( (array) $instance, array(
            'event_id' => 0,
        ));

        ?>
        <p><label for="<?php echo $this->get_field_id('event_id'); ?>">Event ID</label>
            <input type="text" id="<?php echo $this->get_field_id('event_id'); ?>" name="<?php echo $this->get_field_name('event_id'); ?>" value="<?php echo $instance['event_id']; ?>" />
        </p>
        <?php
    }
}
register_widget('Joind_In_Widget');
