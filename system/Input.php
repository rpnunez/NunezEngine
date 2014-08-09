<?php

/**
 * NunezEngine
 * Micro-framework for rapid web application development.
 *
 * @author Raymond Nunez <rpnunez@gmail.com>
 * @version v0.1
 */

/**
 * Class Input
 * @package NunezEngine
 */
class Input {

    private $Engine = null;

    public function __construct(Engine $Engine) {
        $this->Engine = $Engine;
    }
} 