<?php

/**
 * NunezEngine
 * Micro-framework for rapid web application development.
 *
 * @author Raymond Nunez <rpnunez@gmail.com>
 * @version v0.1
 */

function debugInline($data) {
    if (ENV == 0) {
        $bt = debug_backtrace();
        $caller = array_shift($bt);

        echo '<div style="background-color: #ddd; padding: 5px; margin-bottom: 5px;">';

        if (isSet($caller)) {
            echo '<p>In file '. $caller['file'] .', on line '. $caller['line'] .': </p>';
        }

        echo '<pre>' . print_r($data, true) . '</pre>';
        echo '</div>';
    }
}