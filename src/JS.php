<?php

namespace CodeStop\Proof;

use CodeStop\Proof\Config;
use CodeStop\Proof\JS\Nodes;

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

    public function find(string $rawSelector)
    {
        $finder = new Nodes();
        $finder->find($rawSelector);
    }
}
