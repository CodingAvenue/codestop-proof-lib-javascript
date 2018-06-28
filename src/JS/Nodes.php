<?php

namespace CodeStop\Proof\JS;

use CodeStop\Proof\SelectorParser\Parser;
use CodeStop\Proof\SelectorParser\Transformer\ArrayTransformer;
use CodeStop\Proof\JS\Traverser\NodeTraverser;
use CodeStop\Proof\JS\Traverser\Visitor;
use CodeStop\Proof\JS\Filter\FilterFactory;

/**
 * JS Proof library Finder class. Traverse through the parsed JS code
 * and returns the elements that satisfy the filter
 */

class Nodes
{
    /** @var array $parsed the parsed JS code */
    private $parsed;

    public function __construct(array $parsed)
    {
        $this->parsed = $parsed;
    }

    public function find(string $rawSelector)
    {
        $selector = $this->parseSelector($rawSelector);

        $filter = FilterFactory::createFilter($selector['node'], isset($selector['attribute']) ? $selector['attribute'] : array());
        $filteredNodes = $filter->applyFilter($this->parsed);

        return new self($filteredNodes);
    }

    public function parseSelector(string $rawSelector)
    {
        $parser = new Parser($rawSelector);
        $stream = $parser->parse();

        $transformer = new ArrayTransformer($stream);
        return $transformer->transform();
    }
}