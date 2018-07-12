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

    public function getSubNode(string $subNode, bool $is_empty = false)
    {
        if (array_key_exists($subNode, $this->parsed)) {
            return new self([$this->parsed[$subNode]]);
        } else {
            $nodes = array();
            foreach ($this->parsed as $node) {
                if (array_key_exists($subNode, $node) && is_array($node[$subNode])) {
                    if ($subNode == 'declarations' || $subNode == 'body' || $subNode == 'cases') {
                        $nodes = array_merge($nodes, $node[$subNode]);
                    } else {
                        $nodes[] = $node[$subNode];
                    }
                } else if (array_key_exists('expression', $node) && array_key_exists($subNode, $node['expression']) && is_array($node['expression'][$subNode])) {
                    if ($subNode == 'arguments') {
                        $nodes = array_merge($nodes, $node['expression'][$subNode]);
                    } else {
                        $nodes[] = $node['expression'][$subNode];
                    }
                }
            }
        }

        return new self($nodes);
    }

    public function count()
    {
        return count($this->parsed);
    }
}
