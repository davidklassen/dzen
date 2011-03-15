<?php
/**
 * Description of loader
 *
 * @author f0rk
 */

class Autoloader {

    /**
     * Singletone instance
     * 
     * @var Autoloader
     */
    private static $_instance;
    
    /**
     *
     * @var array
     */
    private $_source_dirs = array (
        'controller' => '/controllers',
        'model' => '/models',
    );
    
    /**
     *
     * @var array
     */
    private $_extensions = array (
        'controller' => '.controller.php',
        'model' => '.model.php',
    );

    /**
     * Singletone implementation
     * 
     * @return Autoloader
     */
    public static function init() {
        if (self::$_instance == null) {
            self::$_instance = new self();
        }
        
        return self::$_instance;
    }

    private function  __construct() {
        spl_autoload_register(array($this, 'autoload'));
    }

    private function autoload($class) {
        $pattern = '/(?<=[a-z])(?=[A-Z])|(?<=[A-Z])(?=[A-Z][a-z])/';
        $matches = preg_split($pattern, $class);

        if ((count($matches) == 2) && 
            (($matches[1] == 'Controller') || ($matches[1] == 'Model'))) {
            $directory = APPLICATION_PATH . $this->_source_dirs[strtolower($matches[1])];
            $extension = $this->_extensions[strtolower($matches[1])];
            $class = $matches[0];
        } else {
            $extension = '.php';
            $class = end($matches);
            $dir_array = array_map('strtolower', array_slice($matches, 0, count($matches) - 1));
            $directory = LIBRARY_PATH . '/' . implode('/', $dir_array) . PATH_SEPARATOR .
                         APPLICATION_PATH . '/' . implode('/', $dir_array);
        }
        
        set_include_path($directory);
        spl_autoload_extensions($extension);
        spl_autoload($class);
    }

}

class AutoloaderException extends Exception {}