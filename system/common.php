<?php

/**
 * NunezEngine
 * Micro-framework for rapid web application development.
 *
 * @author Raymond Nunez <rpnunez@gmail.com>
 * @version v0.1
 */

function debugInline($data) {
    if (ENV == 1) {
        echo '<div style="background-color: #ddd; padding: 5px;">';
        echo '<pre>' . print_r($data, true) . '</pre>';
        echo '</div';
    }
}