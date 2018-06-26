<?php

namespace CodeStop\Proof\JS\Rule\Argument;

class Argument extends Rule implements RuleInterface
{
    public function getRule(): callable
    {
        $filter = $this->filter;

        return function($node) use ($filter) {
            return (
                ($node['type'] == 'ExpressionStatement'
                && isset($node['expression']['arguments'])
                && $node['expression']['arguments'].length > 0)
                && (
                    isset($filter['type'])
                        ? strtolower($node['type']) == $filter['type']
                        : true
                )
                && (
                    isset($filter['name'])
                        ? true
                        : false
                )
            );
        };
    }

    public function allowedOptionalFilter()
    {
        return array('type', 'name', 'value');
    }
}