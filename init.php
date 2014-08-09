<?php

/**
 * NunezEngine
 * Micro-framework for rapid web application development.
 *
 * @author Raymond Nunez <rpnunez@gmail.com>
 * @version v0.1
 */

define('DS', DIRECTORY_SEPARATOR);
define('BASE_PATH', dirName(__FILE__));
define('APP_PATH', BASE_PATH . DS . 'app');
define('SYSTEM_PATH', BASE_PATH . DS . 'system');
define('ENV', '0'); // Environment - 0 = Dev, 1 = Production

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

// Include configuration files
$Config = new stdClass();
$files = array('engine', 'db');

foreach ($files as $file) {
    $filePath = APP_PATH . DS . 'config' . DS . $file .'.php';
    if (!file_exists($filePath)) {
        throw new Exception('Require config file missing: '. $file .'.php, file path: '. $filePath);
    } else {
        $Config->$file = require_once $filePath;
    }
}

// Include commonly used functions