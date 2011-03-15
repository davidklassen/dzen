<?php
/**
 * Description of url
 *
 * @author f0rk
 */

class ViewHelperUrl {

    public function url() {
        return ControllerFront::getInstance()->getBaseUrl();
    }
    
}
