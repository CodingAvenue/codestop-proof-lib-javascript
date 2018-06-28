<?php

namespace CodeStop\Proof\JS\Traverser;

class NodeTraverser
{
    /** @var array $visitors an array of visitors that will be called each time the class enter a new node. */
    private $visitors;

    public function __construct()
    {
        $this->visitors = [];
    }

    public function addVisitor($visitor)
    {
        $this->visitors[] = $visitor;
    }

    public function traverse(array $nodes): array
    {
        $outNodes = [];

        $nodes = isset($nodes['body']) ? $nodes['body'] : $nodes;

        foreach ($nodes as $i => &$node) {
            foreach ($this->visitors as $visitor) {
                $return = $visitor->enter($node);

                if ($return != null) {
                    $outNodes[] = $return;
                }
            }
        }

        return $outNodes;
    }
}