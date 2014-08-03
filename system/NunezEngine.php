<?php
/**
 * NunezEngine
 * Micro-framework for rapid web application development.
 *
 * @author Raymond Nunez <rpnunez@gmail.com>
 * @version v0.1
 */

/**
 * Class NunezEngine
 *
 * Core NunezEngine dispatching, routing and everything happens in this class.
 * @package NunezEngine
 * @since v.0.1
 */
class NunezEngine {

    /**
     * Accessible objects
     */
    //public $Dispatcher = null;
    public $Router = null;
    public $Input = null;
    public $DB = null;

    /**
     * Private variables
     */
    private $config = null;

    /**
     * Current request variables
     */
    private $controller = null;
    private $model = null;
    private $view = null;

    public function __construct() {
        // Include config
        $files = array('Config', /*'Dispatcher',*/ 'Router', 'Input'/*, 'DB'*/);

        foreach ($files as $file) {
            $filePath = SYSTEM_PATH . DS . $file .'.php';

            if (!file_exists($filePath)) {
                throw new \Exception('Fatal error: Required file '. $filePath .' missing.');
            } else {
                require_once($filePath);
                $this->$file = new $file();
            }
        }
    }
} 