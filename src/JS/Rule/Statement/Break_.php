<?php

namespace CodeStop\Proof\JS\Rule\Statement;

use CodeStop\Proof\JS\Rule\Rule;
use CodeStop\Proof\JS\Rule\RuleInterface;

class Break_ extends Rule implements RuleInterface
{
    public function getRule(): callable
    {
        return function($node) {
            return (
                $node['type'] == 'BreakStatement'
            );
        };
    }

    public function allowedOptionalFilter()
    {
        return array();
    }
}