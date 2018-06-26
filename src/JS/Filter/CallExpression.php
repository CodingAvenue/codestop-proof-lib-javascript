<?php

namespace CodeStop\Proof\JS\Filter;

use CodeStop\Proof\JS\Rule\RuleFactory;

/**
 * JS Call Expression Filter class
 */

class CallExpression extends Filter implements FilterFactory
{
    public function getRuleClass()
    {
        return RuleFactory::createRule($this->attributes['name'], $this->getRuleFilters());
    }

    public function getRuleFilters()
    {
        $attributes = $this->attributes;

        unset($attributes['name']);
        return $attributes;
    }
}