<?php

/**
 * NunezEngine
 * Micro-framework for rapid web application development.
 *
 * @author Raymond Nunez <rpnunez@gmail.com>
 * @version v0.1
 */

/**
 * Class Router
 * @package NunezEngine
 */
class Router {

    private $Engine;

    public function __construct(Engine $Engine) {
        $this->Engine = $Engine;
    }

    public function dispatch($query) {
        if (empty($query)) {
            // Dispatch home controller
            $controllerFile = APP_PATH . DS . 'controllers' . DS . $this->Engine->Config->engine['homeController'] .'Controller.php';
            $controllerName = $this->Engine->Config->engine['homeController'] .'Controller';
        } else {
            // Split the query by /
            $parts = explode('/', $query);

            // [0] = Controller, [1] = Method, [3] = GET/Additional parameters

            // Check if controller exists
            $controllerName = strToLower($parts[0]);
            $controllerName = uCFirst($controllerName);
            $controllerFile = APP_PATH . DS . 'controllers' . DS . $controllerName . 'Controller.php';
        }

        if (!file_exists($controllerFile)) {
            throw new \Exception('Requested controller doest not exist: '. $controllerName .', file: '. $controllerFile .'.');
        } else {
            // Include controller
            require_once($controllerFile);
            $this->Engine->$controllerName = new $controllerName();

            debugInline('Controller '. $controllerName .' loaded!');
        }
    }
} 