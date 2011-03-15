<?php
/**
 * Description of news
 *
 * @author f0rk
 */

class NewsController {
    
    public function index($request) {
        return array();
    }
    
    public function view($request) {
        return array('news_id' => $request['id']);
    }
    
}
