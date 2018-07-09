<?php

namespace CodeStop\Proof\JS\Rule\Variable;

use CodeStop\Proof\JS\Rule\Rule;
use CodeStop\Proof\JS\Rule\RuleInterface;

class Identifier extends Rule implements RuleInterface
{
    public function getRule(): callable
    {
        $filter = $this->filter;

        return function($node) use ($filter) {
            return (
                (
                    $node['type'] == "VariableDeclarator"
                    && (
                        isset($filter['name'])
                            ? $node['id']['name'] == $filter['name']
                            : true
                    )
                )
                ||
                (
                    $node['type'] == 'Identifier'
                    && (
                        isset($filter['name'])
                            ? $node['name'] == $filter['name']
                            : true
                    )
                )
            );
        };
    }

    public function allowedOptionalFilter()
    {
        return array('name');
    }
}