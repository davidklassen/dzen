<?php

class Router {

    /**
     * Router configuration
     * 
     * @var array
     */
    private $_routes = array(
        'error' => array(
            'pattern' => '/^.*$/', 
            'args' => array(
                'controller' => array(
                    'default' => 'error',
                ),
                'action' => array(
                    'default' => 'index',
                ),
                'code' => array(
                    'default' => 404,
                ),
            ),
        ),        
        'default' => array(
            'pattern' => '/^\/([^\/]+)?\/?([^\/]+)?\/?$/', 
            'args' => array(
                'controller' => array(
                    'default' => 'index',
                    'ref' => 1
                ),
                'action' => array(
                    'default' => 'index',
                    'ref' => 2,
                ),
            ),
        ),
    );

    /**
     * Router constructor
     *
     * @param array $routes
     *   Array with route regexps
     */
    public function __construct($routes = array()) {
         $this->_routes = array_merge($this->_routes, $routes);
    }

    /**
     * Route method builds request array
     * e.g.
     * array(
     *     'controller' => 'default_controller',
     *     'action' => 'default_action',
     *     'param1' => 'default_param1_value',
     *     'param2' => 'default_param2_value',
     * )
     *
     * @param string $request
     *   Request part of the URL string
     * @return array
     *    Returns array with controller and action names and action params
     */
    public function route($request) {
        $routes = array_reverse($this->_routes);
        $matches = array();
        foreach ($routes as $route_name => $route_opts) {
            if (preg_match($route_opts['pattern'], $request, $matches)) {
                $route_hit = $route_name;
                break;
            }
        }
        
        foreach ($routes[$route_hit]['args'] as $arg => $arg_opts) {
            $ref = @$arg_opts['ref'];
            $result[$arg] = (!isset($ref) || !isset($matches[$ref])) 
                ? $arg_opts['default'] 
                : $matches[$ref];
        }
        
        return $result;
    }

}