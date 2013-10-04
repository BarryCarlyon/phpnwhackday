<?php

/*
Plugin Name: joind.in | WordPress
Description: Joind in
Author: Barry Carlyon
Author URI: http://www.barrycarlyon.co.uk
Version: 0.0.1
*/

class joindin {
    function __construct() {
        include(dirname(__FILE__) . '/includes/joined.in.php');

        add_action('widgets_init', array($this, 'widgets_init'));
    }

    function widgets_init() {
        include(dirname(__FILE__) . '/includes/widgets.php');
    }
}
new joindin();
