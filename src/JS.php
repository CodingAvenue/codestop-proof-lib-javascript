<?php

namespace CodeStop\Proof;

use CodeStop\Proof\Config;

/**
 * JS Proof library main class
 */

class JS
{
    /** @var Config $config the Config class. */
    private $config;

    public function __construct()
    {
        $this->config = new Config();
    }
}
