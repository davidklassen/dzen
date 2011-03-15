<?php
/**
 * Description of registry
 *
 * @author f0rk
 */

class Registry {
    
    /**
     *
     * @var Registry
     */
    private static $_instance;
    
    /**
     *
     * @var Router
     */
    private $_router;
    
    /**
     *
     * @var View
     */
    private $_view;
    
    /**
     *
     * @var DbAdapter
     */
    private $_dbAdapter;

    /**
     * 
     */
    public static function init() {
        self::getInstance();
    }
    
    /**
     * Singletone implementation
     *
     * @return Registry
     */
    public static function getInstance() {
        if (self::$_instance == null) {
            self::$_instance = new self();
        }
        
        return self::$_instance;
    }

    /**
     *
     * @param Router $router 
     */
    public function setRouter($router) {
        $this->_router = $router;
    }

    /**
     *
     * @return Router
     */
    public function getRouter() {
        return $this->_router;
    }
    
    /**
     *
     * @param View $view 
     */
    public function setView($view) {
        $this->_view = $view;
    }
   
    /**
     *
     * @return View
     */
    public function getView() {
        return $this->_view;
    }
    
    /**
     *
     * @param DbAdapter $db_adapter 
     */
    public function setDbAdapter($db_adapter) {
        $this->_dbAdapter = $db_adapter;
    }
    
    /**
     *
     * @return DbAdapter
     */
    public function getDbAdapter() {
        return $this->_dbAdapter;
    }

}
