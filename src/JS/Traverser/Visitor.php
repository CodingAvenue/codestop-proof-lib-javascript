<?php

namespace CodeStop\Proof\JS\Traverser;

class Visitor
{
    public function __construct(callable $filterCallback)
    {
        $this->filterCallback = $filterCallback;
        $this->foundNodes = [];
    }

    public function enter(array $node)
    {
        $filterCallback = $this->filterCallback;

        if ($filterCallback($node)) {
            $this->foundNodes[] = $node;
            return $node;
        }

        return null;
    }

    public function getFoundNodes()
    {
        return $this->foundNodes;
    }
}