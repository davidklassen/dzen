<?php
/**
 * Description of config
 *
 * @author f0rk
 */

class ApplicationConfig {
    
    /**
     *
     * @var ApplicationConfig
     */
    private static $_instance;
    
    /**
     *
     * @var string
     */
    private $_configFile = 'application.yml';
    
    /**
     *
     * @var array
     */
    private $_configuration = array();
    
    /**
     * 
     */
    private function __construct() {
        $this->_configuration = $this->readConfig($this->_configFile);
    }
    
    /**
     * Singletone implementation
     * 
     * @return ApplicationConfig
     */
    public static function init() {
        if (self::$_instance == null) {
            self::$_instance = new self();
        }
        
        return self::$_instance;
    }
    
    /**
     * 
     * @return array
     */
    public function getRoutes() {
        return isset ($this->_configuration['routes']) 
            ? $this->_configuration['routes']
            : array();
    }
    
    /**
     *
     * @param type $config_file 
     */
    public function readConfig($config_file) {
        //
        
        return Spyc::YAMLLoad(APPLICATION_PATH . '/config/' . $config_file);
    }
    
}
