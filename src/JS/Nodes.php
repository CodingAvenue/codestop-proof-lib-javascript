<?php

namespace CodeStop\Proof\JS;

use CodeStop\Proof\SelectorParser\Parser;
use CodeStop\Proof\SelectorParser\Transformer\ArrayTransformer;

/**
 * JS Proof library Finder class. Traverse through the parsed JS code
 * and returns the elements that satisfy the filter
 */

class Nodes
{
    /** @var array $parsed the parsed JS code */
    private $parsed;

    public function __construct()
    {
    }

    public function find(string $rawSelector)
    {
        $selector = $this->parseSelector($rawSelector);

        print_r($selector);
    }

    public function parseSelector(string $rawSelector)
    {
        $parser = new Parser($rawSelector);
        $stream = $parser->parse();

        $transformer = new ArrayTransformer($stream);
        return $transformer->transform();
    }
}
