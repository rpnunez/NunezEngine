<?php
/**
 * NunezEngine
 * Micro-framework for rapid web application development.
 *
 * @author Raymond Nunez <rpnunez@gmail.com>
 * @version v0.1
 */

/**
 * Class Engine
 *
 * Core NunezEngine dispatching, routing and everything happens in this class.
 * @package NunezEngine
 * @since v.0.1
 */
class Engine {

    /**
     * Accessible objects
     */
    //public $Dispatcher = null;
    public $Router = null;
    public $Input = null;
    public $DB = null;

    /**
     * Core variables
     */
    public $Config = null;

    /**
     * Current request variables
     */
    private $controller = null;
    private $model = null;
    private $view = null;

    public function __construct(stdClass $Config) {
        // @TODO: This should be handled by an autoloader, seriously.
        // Include config
        $this->Config = $Config;
        $files = array(/*'Dispatcher',*/ 'Router', 'Input', 'Logger'/*, 'DB'*/);

        foreach ($files as $file) {
            $filePath = SYSTEM_PATH . DS . $file .'.php';

            if (!file_exists($filePath)) {
                throw new \Exception('Fatal error: Required file '. $filePath .' missing.');
            } else {
                require_once($filePath);
                $this->$file = new $file($this);
            }
        }
    }
} 