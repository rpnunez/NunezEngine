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
        $this->Engine->Logger->log('Router->dispatch() called.');

        if (empty($query)) {
            // Dispatch home controller
            $controllerFile = APP_PATH . DS . 'controllers' . DS . $this->Engine->Config->engine['homeController'] .'Controller.php';
            $controllerName = $this->Engine->Config->engine['homeController'] .'Controller';
            $action = 'index';
        } else {
            // Split the query by /
            $parts = explode('/', $query);

            $this->Engine->Logger->log($parts);

            // [0] = Controller, [1] = Action, [3] = GET/Additional parameters

            // Check if controller exists
            $controllerName = strToLower($parts[0]);
            $controllerName = uCFirst($controllerName);
            $controllerFile = APP_PATH . DS . 'controllers' . DS . $controllerName . 'Controller.php';
            $action = (!empty($parts[1]) ? $parts[1] : 'index');
        }

        if (!file_exists($controllerFile)) {
            throw new Exception('Requested controller doest not exist: '. $controllerName .', file: '. $controllerFile .'.');
        } else {
            // Include controller
            require_once($controllerFile);
            $controller = $this->Engine->$controllerName = new $controllerName();

            $this->Engine->Logger->log('Controller '. $controllerName .' initialized.');

            if (method_exists($controller, $action)) {
                $controller->$action(/* Need to pass $parts[3] here */);
                $this->Engine->Logger->log('Action '. $action .' executed.');

                // @TODO: Display the view file in views/$controllerName/$action.php
                $controllerName = str_replace('Controller', '', $controllerName);
                $viewPath = APP_PATH . DS . 'views' . DS . $controllerName . DS . $action .'.php';

                if (file_exists($viewPath)) {
                    ob_start();
                    include($viewPath);
                    $output = ob_get_contents();
                    ob_end_flush();

                    //echo $output;
                } else {
                    throw new Exception('Requested view file does not exist: '. $viewPath .'.');
                }
            } else {
                throw new Exception('Requested action does not exist: '. $action .'.');
            }
        }
    }
} 