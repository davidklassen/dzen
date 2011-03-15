<?php
/**
 * Description of error
 *
 * @author f0rk
 */

class ErrorController {
    
    public function __construct() {
        //
    }
    
    public function index($request) {        
        switch ($request['code']) {
            case 404:
                header("HTTP/1.0 404 Not Found");
                $message = 'sdfsdf';
                break;
        }

        return array(
            'error_message' => $message,
            'error_code' => $request['code'],
        );
    }
    
}
