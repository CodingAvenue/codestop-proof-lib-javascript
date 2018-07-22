<?php

namespace CodeStop\Proof\JS\Rule\Function_;

use CodeStop\Proof\JS\Rule\Rule;
use CodeStop\Proof\JS\Rule\RuleInterface;

class FunctionExpression extends Rule implements RuleInterface
{
    public function getRule(): callable
    {
        $filter = $this->filter;
        return function($node) use ($filter) {
            return (
                $node['type'] == 'FunctionExpression'
                && (
                    isset($filter['name'])
                        ? $node['id']['name'] == $filter['name']
                        : true
                )
            );
        };
    }

    public function allowedOptionalfilter()
    {
        return array('name');
    }
}