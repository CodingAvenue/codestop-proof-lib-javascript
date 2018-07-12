<?php

namespace CodeStop\Proof\JS\Rule\Statement;

use CodeStop\Proof\JS\Rule\Rule;
use CodeStop\Proof\JS\Rule\RuleInterface;

class SwitchDefault extends Rule implements RuleInterface
{
    public function getRule(): callable
    {
        return function($node) {
            return (
                $node['type'] == 'SwitchCase'
                && !is_array($node['test'])
            );
        };
    }

    public function allowedOptionalFilter()
    {
        return array();
    }
}