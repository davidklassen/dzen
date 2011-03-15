<?php
/**
 * Description of view
 *
 * @author f0rk
 */

class View {

    /**
     * Layout filename
     * 
     * @var string
     */
    private $_layout;
    
    /**
     * Template filename
     * 
     * @var string
     */
    private $_template;
    
    /**
     * Template vars
     * 
     * @var array
     */
    private $_vars;

    /**
     *
     * @param string $template
     * @param array $vars 
     */
    public function  __construct($template, $vars = array()) {
        $this->_template = APPLICATION_PATH . '/views/' . $template;
        $this->_vars = $vars;
    }
    
    /**
     *
     * @param type $name
     * @param type $arguments 
     */
    public function __call($name, $args) {
        $helper_name = 'ViewHelper' . ucfirst($name);
        $helper = new $helper_name;
        
        if (count($args)== 1) {
            return $helper->$name($args[0]);
        } elseif (count($args)== 2) {
            return $helper->$name($args[0], $args[1]);
        } elseif (count($args)== 3) {
            return $helper->$name($args[0], $args[1], $args[2]);
        }
            
        
        return $helper->$name();
    }


    /**
     *
     * @param string $template 
     */
    public function setTemplate($template) {
        $this->_template = APPLICATION_PATH . '/views/' . $template;
    }
    
    /**
     *
     * @param string $layout 
     */
    public function setLayout($layout) {
        $this->_layout = APPLICATION_PATH . '/layouts/' . $layout;
    }
    
    /**
     *
     * @param array $vars 
     */
    public function setVars($vars) {
        $this->_vars = $vars;
    }

    /**
     * Render template
     */
    public function render() {
        extract($this->_vars);
        
        if (!empty($this->_layout)) {
            include $this->_layout;
        } else
            include $this->_template;
            
    }

}
