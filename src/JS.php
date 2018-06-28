<?php

namespace CodeStop\Proof;

use CodeStop\Proof\Config;
use CodeStop\Proof\JS\Nodes;
use CodeStop\Sandbox\Code\Api;
use CodeStop\Sandbox\Endpoint;

/**
 * JS Proof library main class
 */

class JS
{
    /** @var Config $config the Config class. */
    private $config;

    /** @var array $parsed the parsed JS Code */

    public function __construct(string $code)
    {
        $this->config = new Config();

        if (!file_exists($code)) {
            throw new \Exception("Answer file {$code} not found.");
        }

        $content = file_get_contents($code);
        if (!$content) {
            throw new \Exception("Unable to read answer file {$content}.");
        }

        $api = new Api(new Endpoint());
        $this->parsed = json_decode($api->parse($content)['output'], true);
    }

    public function find(string $rawSelector)
    {
        $finder = new Nodes($this->parsed);
        return $finder->find($rawSelector);
    }
}
