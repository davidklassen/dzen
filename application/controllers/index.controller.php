<?php
/**
 * Description of Index
 *
 * @author f0rk
 */

class IndexController {

    public function  __construct() {
        //
    }

    public function index($request) {
        
        $i = 'sdfsdfsdfsdf';
        
        return array(
            'message1' => 'test message 1',
            'message2' => $i,
        );
    }

}
