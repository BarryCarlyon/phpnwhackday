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

class joind_in_api {
    private $_api_target = 'https://api.joind.in/v2/';
    private $_method = '';

    private $_response = '';
    private $_info = array();

    private $_target;

    /**
    args

    resultsperpage
    start

    filter=hot/upcoming/past/cfp
    (cfp = call for papers)
    */

    function __construct() {
    }

    private function $_request() {
        $target = $this->_api_target . $this->_method . '/';

        if ($this->_target) {
            $target .= $this->_target;
        }

        // @todo: args
        $ch = curl_init($target);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Barrys Joindin API Requester');
        $r = curl_exec($ch);
        $i = curl_getinfo($ch);
        curl_close($ch);

        $this->_response($r);
        $this->_info($r):

        return $this;
    }

    function events()) {
        $this->_method ='events';

    }

    function getEvent($id) {
        $this->_emthod = 'events';
        $this->_target = $id;

        $this->_reqest();
    }

    function getEventTalks($id) {
        $this->_emthod = 'events';
        $this->_target = $id . '/talks';

        $this->_reqest();
    }
}
