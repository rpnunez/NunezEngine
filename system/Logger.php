<?php

/**
 * NunezEngine
 * Micro-framework for rapid web application development.
 *
 * @author Raymond Nunez <rpnunez@gmail.com>
 * @version v0.1
 */

class Logger {

    /**
     * Logs logged throughout script execution
     *
     * @var array
     */
    private $logs = array();

    /**
     * Warnings logged throughout script execution
     * @var array
     */
    private $warnings = array();

    /**
     * Errors logged throughout script execution
     *
     * @var array
     */
    private $errors = array();

    private $Engine = null;

    public function __construct(Engine $Engine) {
        $this->Engine = $Engine;
    }

    public function log($data) {
        $bt = debug_backtrace();
        $caller = array_shift($bt);

        $this->logs[] = array($data, 'file' => $caller['file'], 'line' => $caller['line']);
    }

    public function warning($data) {
        // @TODO: Implement same file and line backtrace from this->log()
        $this->warnings[] = $data;
    }

    public function error($data) {
        // @TODO: Implement same file and line backtrace from this->log()
        $this->errors[] = $data;
    }

    public function display() {
        echo '<div style="padding: 5px; background-color: #333; border: 1px solid #ddd;">';
        echo '<h2>NunezEngine Logger</h3>';

        echo '<h3>Logs</h3>';
        echo '<div style="padding: 5px; background-color: yellow; border: 1px solid #ddd;">';

        if (sizeOf($this->logs) == 0) {
            echo 'No logs to display.';
        } else {
            echo '<ol>';
            foreach ($this->logs as $id => $data) {
                $log = $data[0];
                $file = $data['file'];
                $line = $data['line'];

                echo '<li>In file <em>'. $file .'</em>, on line <em>'. $line .'</em>:<br />';

                if (is_array($log)) {
                    echo 'print_r():<br />';
                    echo '<pre>';
                    print_r($log);
                    echo '</pre>';

                    echo '<pre>';
                    var_dump($log);
                    echo '</pre>';
                } else {
                    echo '<pre>';
                    var_dump($log);
                    echo '</pre>';
                }

                echo '</li>';
            }
            echo '</ol>';
        }

        echo '</div>';
    }
} 