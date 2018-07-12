<?php

namespace CodeStop\Proof\JS\Rule\String;

use CodeStop\Proof\JS\Rule\Rule;
use CodeStop\Proof\JS\Rule\RuleInterface;

class Literal extends Rule implements RuleInterface
{
    public function getRule(): callable
    {
        $filter = $this->filter;

        return function($node) use ($filter) {
            return (
                $node['type'] == 'Literal'
                && (
                    isset($filter['value'])
                        ? $filter['value'] == $node['value']
                        : true
                )
            );
        };
    }

    public function allowedOptionalFilter()
    {
        return array('type', 'value', 'quoted');
    }
}