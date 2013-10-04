<?php


class joind_in_api {
    private $_api_target = 'https://api.joind.in/v2.1/';
    private $_method = '';

    private $_response = '';
    private $_info = array();

    private $_target;

    /**
    args

verbose: set to yes to see a more detailed set of data in the responses. This works for individual records and collections.
start: for responses which return lists, this will offset the start of the result set which is returned. The default is zero; use in conjuction with resultsperpage
resultsperpage: for responses which return lists, set how many results will be returned. The default is currently 20 records; use with start to get large result sets in manageable chunks
format: set this to html or json to specify what format the response should be in (preferably use the Accept Header, alternatively you can pass this param)

    resultsperpage
    start

    filter=hot/upcoming/past/cfp
    (cfp = call for papers)
    */

    function __construct() {
    }

    private function _request() {
        $target = $this->_api_target . $this->_method . '/';

        if ($this->_target) {
            $target .= $this->_target;
        }

        // @todo: args
        $ch = curl_init($target);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Barrys Joindin API Requester');

//        curl_setopt($ch, CURLOPT_VERBOSE, 1);

        $headers = array(
            'Accept: application/json'
        );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $r = curl_exec($ch);
        $i = curl_getinfo($ch);
        curl_close($ch);

        $this->_response = $r;
        $this->_info = $i;

        return $this;
    }

    /**
    util
    */
    function getResponse($array = false) {
        return json_decode($this->_response, $array);
    }

    /**
    functions
    */
    function events() {
        $this->_method ='events';

    }

    function getEvent($id) {
        $this->_method = 'events';
        $this->_target = $id;

        $this->_request();

        // return that what was reuqested
        $events = $this->getResponse();
        $event = $events->events[0];
        return $event;

        return $this;
    }

    function getEventTalks($id) {
        $this->_method = 'events';
        $this->_target = $id . '/talks';

        $this->_request();

        return $this;
    }
}
