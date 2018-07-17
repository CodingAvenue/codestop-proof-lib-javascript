<?php

namespace CodeStop\Proof\JS\Rule\BinaryOperator;

use CodeStop\Proof\JS\Rule\Rule;
use CodeStop\Proof\JS\Rule\RuleInterface;

class LessEqual extends Rule implements RuleInterface
{
    public function getRule(): callable
    {
        $filter = $this->filter;

        return function($node) use($filter) {
            return (
                ($node['type'] == 'BinaryExpression')
                && ($node['operator'] == '<=')
            );
        };
    }

    public function allowedOptionalFilter()
    {
        return array();
    }
}