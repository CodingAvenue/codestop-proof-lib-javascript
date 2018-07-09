<?php

namespace CodeStop\Proof\JS\Filter;

use CodeStop\Proof\JS\Rule\RuleFactory;

class BinaryExpression extends Filter implements FilterInterface
{
    public function getRuleClass()
    {
        return RuleFactory::createRule($this->getOperator(), $this->getRuleFilter());
    }

    private function getOperator()
    {
        if ($this->attributes['name'] === '+') {
            return 'plus';
        } else if ($this->attributes['name'] === '>') {
            return 'greater-than';
        } else if ($this->attributes['name'] === '<') {
            return 'less-than';
        }
    }

    public function getRuleFilter()
    {
        $attributes = $this->attributes;

        unset($attributes['name']);
        return $attributes;
    }
}