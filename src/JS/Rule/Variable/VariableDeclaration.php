<?php

namespace CodeStop\Proof\JS\Rule\Variable;

use CodeStop\Proof\JS\Rule\Rule;
use CodeStop\Proof\JS\Rule\RuleInterface;

class VariableDeclaration extends Rule implements RuleInterface
{
    public function getRule(): callable
    {
        return function($node) {
            return (
                $node['type'] == "VariableDeclaration"
            );
        };
    }

    public function allowedOptionalFilter()
    {
        return array();
    }
}