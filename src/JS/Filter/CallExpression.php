<?php

namespace CodeStop\Proof\JS\Filter;

use CodeStop\Proof\JS\Rule\RuleFactory;

/**
 * JS Call Expression Filter class
 */

class CallExpression extends Filter implements FilterInterface
{
    public function getRuleClass()
    {
        return RuleFactory::createRule($this->attributes['name'], $this->getRuleFilter());
    }

    public function getRuleFilter()
    {
        $attributes = $this->attributes;

        unset($attributes['name']);
        return $attributes;
    }
}