<?php

namespace CodeStop\Proof\JS\Rule\Expression;

use CodeStop\Proof\JS\Rule\Rule;
use CodeStop\Proof\JS\Rule\RuleInterface;

class Assignment extends Rule implements RuleInterface
{
    public function getRule(): callable
    {
        $filter = $this->filter;

        return function($node) use($filter) {
            return (
                ($node['type'] == 'ExpressionStatement')
                && $node['expression']['type'] == 'AssignmentExpression'
                && (
                    isset($filter['operator'])
                        ? $filter['operator'] == $node['expression']['operator']
                        : true
                )
            );
        };
    }

    public function allowedOptionalFilter()
    {
        return array('operator');
    }
}
