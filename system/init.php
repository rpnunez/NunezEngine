<?php

/**
 * NunezEngine
 * Micro-framework for rapid web application development.
 *
 * @author Raymond Nunez <rpnunez@gmail.com>
 * @version v0.1
 */

spl_autoload_register(function($className) {
    $className = ltrim($className, '\\');
    $fileName  = '';
    $namespace = '';
    if ($lastNsPos = strrpos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

    echo 'Attempting to require_once: '. $className .' ('. $fileName .').<br />';
    require_once $fileName;
});