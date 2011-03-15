<?php
/**
 * Description of abstract
 *
 * @author f0rk
 */

abstract class BootstrapAbstract {
    
    public function __construct() {
        //;
    }

    final function bootstrap() {
        Registry::init();
        
        $this->initRouter();
        $this->initView();
        $this->initDb();
    }
    
    protected function initRouter() {
        $routes = ApplicationConfig::init()->getRoutes();
        $router = new Router($routes);
        Registry::getInstance()->setRouter($router);
    }
    
    protected function initView() {
        
    }
    
    protected function initDb() {
        
    }
    
}
