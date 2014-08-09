<?php

/**
 * NunezEngine
 * Micro-framework for rapid web application development.
 *
 * @author Raymond Nunez <rpnunez@gmail.com>
 * @version v0.1
 */

error_reporting(E_ALL);

try {
    // Bootstrap
    $initPath = './init.php';

    if (!file_exists($initPath)) {
        throw new \Exception('Fatal Error:/init.php is missing.');
    } else {
        require_once './init.php';
    }

    // Include NunezEngine
    $nePath = SYSTEM_PATH . DS . 'NunezEngine.php';

    if (!file_exists($nePath)) {
        throw new \Exception('Fatal Error: SYSTEM_PATH/NunezEngine.php is missing.');
    } else {
        require_once $nePath;
        $Engine = new Engine($Config);
    }
} catch (\Exception $e) {
    echo '<p style="border: 1px solid #333; padding: 5px;">Caught exception: '. $e->getMessage() .' on file '. $e->getFile() .', line '. $e->getLine() .'.</p>';
}

echo '<pre>'. print_r($Engine, true) .'</pre>';