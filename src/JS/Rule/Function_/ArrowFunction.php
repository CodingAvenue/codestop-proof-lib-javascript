<?php

namespace CodeStop\Proof\JS\Rule\Function_;

use CodeStop\Proof\JS\Rule\Rule;
use CodeStop\Proof\JS\Rule\RuleInterface;

class ArrowFunction extends Rule implements RuleInterface
{
    public function getRule(): callable
    {
        $filter = $this->filter;
        return function($node) use ($filter) {
            return (
                $node['type'] == 'ArrowFunctionExpression'
            );
        };
    }

    public function allowedOptionalfilter()
    {
        return array();
    }
}