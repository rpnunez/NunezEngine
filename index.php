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

try {
    // Bootstrap
    $initPath = SYSTEM_PATH . DS . 'init.php';
    if (!file_exists($initPath)) {
        throw new \Exception('Fatal Error: SYSTEM_PATH/init.php is missing.');
    } else {
        require_once SYSTEM_PATH . DS . 'init.php';
    }

    // Include NunezEngine
    $nePath = SYSTEM_PATH . DS . 'NunezEngine.php';

    if (!file_exists($nePath)) {
        throw new \Exception('Fatal Error: SYSTEM_PATH/NunezEngine.php is missing.');
    } else {
        require_once $nePath;
        $NunezEngine = new NunezEngine();
    }
} catch (\Exception $e) {
    echo 'Caught exception: '. $e->getMessage() .' on file '. $e->getFile() .', line '. $e->getLine() .'.';
}