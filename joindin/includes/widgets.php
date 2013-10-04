<?php

include(__DIR__ . '/widgets/event.php');

class Joind_In_Widget extends WP_Widget {
    function __construct($id, $name, $widgets) {
        $this->_api = new joind_in_api();
         parent::__construct($id, $name, $widgets);
    }
}
