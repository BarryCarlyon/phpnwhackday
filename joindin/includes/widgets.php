<?php

class Joind_In_Widget extends WP_Widget {
    function __construct() {
        $widget_ops = array(
            'classname' => 'joind_in_widget',
            'description' => 'API PULL',
        );
        parent::__construct('joindin', __('Joind In Widget'), $widget_ops);
    }

    function widget($args, $instance) {
        extract($args);

        if (!$event_id) {
            return;
        }

        echo $before_widget;
        echo '<h2>Joind In</h2>';
        echo $after_widget;
    }


    function update($new, $old) {
        $instance = $old;
        $new = wp_parse_args( (array) $new, array(
            'event_id' => 0,
        ));
        $new['event_id'] = $new['event_id'];

        return $new;
    }
    function form ($instace) {
        $instance = wp_parse_args( (array) $instance, array(
            'event_id' => 0,
        ));

        ?>
        <p><label for="event_id">Event ID</label>
            <input type="text" id="event_id" name="event_id" value="<?php echo $instance['event_id']; ?>" />
        </p>
        <?php
    }
}
register_widget('Joind_In_Widget');
