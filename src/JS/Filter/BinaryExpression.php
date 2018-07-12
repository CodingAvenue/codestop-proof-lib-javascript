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
        if ($this->attributes['operator'] === '+') {
            return 'plus';
        } else if ($this->attributes['operator'] === '-') {
            return 'minus';
        } else if ($this->attributes['operator'] === '*') {
            return 'mul';
        } else if ($this->attributes['operator'] === '/') {
            return 'div';
        } else if ($this->attributes['operator'] === '%') {
            return 'mod';
        } else if ($this->attributes['operator'] === '>') {
            return 'greater-than';
        } else if ($this->attributes['operator'] === '<') {
            return 'less-than';
        } else if ($this->attributes['operator'] === '==') {
            return 'equals';
        }
    }

    public function getRuleFilter()
    {
        $attributes = $this->attributes;

        unset($attributes['operator']);
        return $attributes;
    }
}