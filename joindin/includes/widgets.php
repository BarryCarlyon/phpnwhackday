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

        echo $before_widget;
        echo '<h2>Joind In</h2>';
        echo $after_widget;[]
    }
}
register_widget('Joind_In_Widget');
