<?php
/**
 * Description of application
 *
 * @author f0rk
 */

require_once 'autoloader.php';

class Application {

    /**
     * 
     */
    public function  __construct() {
        Autoloader::init();
        ApplicationConfig::init();
    }

    /**
     *
     * @return Application
     */
    public function bootstrap() {
        $bootstrap = new Bootstrap();
        $bootstrap->init();

        return $this;
    }

    /**
     * Main application method
     */
    public function run() {
        $front = ControllerFront::getInstance();
        $front->dispatch();
    }
    
}

class ApplicationException extends Exception {}