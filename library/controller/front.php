<?php
/**
 * Description of front
 *
 * @author f0rk
 */

class ControllerFront {
    
    /**
     * Singletone instance
     * 
     * @var ControllerFront 
     */
    private static $_instance;
    
    /**
     *
     * @var string 
     */
    private $_requestUri;
    
    /**
     *
     * @var array
     */
    private $_request;
    
    /**
     *
     * @var Router
     */
    private $_router;
    
    /**
     *
     * @var string
     */
    private $_baseUrl;
    
    /**
     *
     * @var array
     */
    private $_errorRequest = array(
        'controller' => 'error',
        'action' => 'index',
        'code' => 404,
    );
    
    /**
     *
     * @return ControllerFront
     */
    public static function getInstance() {
        if (self::$_instance == null) {
            self::$_instance = new self();
        }
        
        return self::$_instance;
    }
    
    /**
     * 
     */
    private function __construct() {
        $this->setRouter();
        $this->setRequest();
        $this->_baseUrl = 'http://' . $_SERVER['SERVER_NAME'];
    }
 
    /**
     *
     * @param type $router 
     */
    public function setRouter($router = null) {
        $this->_router = ($router) 
            ? $router 
            : Registry::getInstance()->getRouter();
    }

    /**
     *
     * @param string $request 
     */
    public function setRequest($request = null) {
        $this->_requestUri = ($request)? $request : $_SERVER['REQUEST_URI'];
        $this->_request = $this->_router->route($this->_requestUri);
    }
    
    /**
     *
     * @return string
     */
    public function getRequestUri() {
        return $this->_requestUri;
    }
    
    /**
     *
     * @return array
     */
    public function getRequest() {        
        return $this->_request;
    }
    
    /**
     *
     * @param array $request 
     */
    public function dispatch($request = null, $router = null) {
        if ($router) $this->setRouter($router);
        if ($request) $this->setRequest($request);
        
        
        $request = ($this->checkRequest($this->_request)) 
            ? $this->_request 
            : $this->getErrorRequest();
        
        $controllerClass = $this->getController($request);
        $controller = new $controllerClass;
        $action = $this->getAction($request);
        
        $view_vars = $controller->$action($request);
        
        $template = $request['controller'] . '/' . $action . '.phtml';
        $view = new View($template, $view_vars);
        $view->setLayout('default.phtml');
        $view->render();
    }
    
    /**
     *
     * @return array
     */
    public function getErrorRequest() {
        return $this->_errorRequest;
    }
    
    /**
     *
     * @param array $request
     * @return string
     */
    public function getController($request) {
        return ucfirst($request['controller']) . 'Controller';
    }
    
    /**
     *
     * @param array $request
     * @return string
     */
    public function getAction($request) {
        return $request['action'];
    }
    
    /**
     *
     * @return string
     */
    public function getBaseUrl() {
        return $this->_baseUrl;
    }
    
    /**
     *
     * @param array $request
     * @return boolean
     */
    public function checkRequest($request) {
        $controller = $this->getController($request);
        $action = $this->getAction($request); 
        
        return class_exists($controller) && method_exists($controller, $action);
    }
    
}