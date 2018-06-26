<?php

namespace CodeStop\Proof\JS\Traverser;

class Visitor
{
    public function __construct(callable $filterCallback)
    {
        $this->filterCallback = $filterCallback;
    }

    public function enter(array $node)
    {
        $filterCallback = $this->filterCallback;

        if ($filterCallback($node)) {
            $this->foundNodes[] = $node;
        }
    }

    public function getFoundNodes()
    {
        return $this->foundNodes;
    }
}