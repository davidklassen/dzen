<?php
/**
 * Description of test
 *
 * @author f0rk
 */

class MytestController {
    
    public function __construct() {
        //
    }
    
    public function index() {
        
        return array(
            'message' => 'test message',
        );
    }
    
    public function test() {
        
        return array(
            'message' => 'test message in test action',
        );
    }
    
}
