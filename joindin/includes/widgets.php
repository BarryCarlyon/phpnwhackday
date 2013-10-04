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
//        echo '<h2>Joind In</h2>';

        // @Todo: caching
        $event = $this->_api->getEvent($event_id);//->getResponse(false);
        // I expect only 1 event

/**
temp style hack
*/
?>
<style type="text/css">
    .joindin_event_icon {
        float: left;
        width: 75px;
    }
</style>
<?php

        // if icon
        echo '<img src="https://joind.in/inc/img/event_icons/' . $event->icon . '" class="joindin_event_icon/>';

        echo '<h3 class="joindin_event_name">
            <a href="' . $event->href . '">
            ' . $event->name . '
            </a>
            </h3>';
        $tos = strtotime($event->start_date);
        echo '<p class="joindin_event_start">' . date(get_option('date_format'), $tos) . '</p>';

        echo '<p class="joindin_event_desc">' . $event->description . '</p>';

        echo '<p>';
        echo '<span class="joindin_on_website">
            <a href="' . $event->href  . '">Website</a>
        </span>';
        echo '<span class="joindin_on_joindin">
            <a href="' . $event->humane_website_uri  . '">On Joind.in</a>
        </span>';
        echo '</p>';

//        echo print_r($event, true);

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
