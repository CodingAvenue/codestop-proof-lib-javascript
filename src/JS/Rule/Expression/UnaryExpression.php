<?php

namespace CodeStop\Proof\JS\Rule\Expression;

use CodeStop\Proof\JS\Rule\Rule;
use CodeStop\Proof\JS\Rule\RuleInterface;

class UnaryExpression extends Rule implements RuleInterface
{
    public function getRule(): callable
    {
        $filter = $this->filter;

        return function($node) use($filter) {
            return (
                $node['type'] == 'UnaryExpression'
                && $node['operator'] == '-'
            );
        };
    }

    public function allowedOptionalFilter()
    {
        return array();
    }
}
