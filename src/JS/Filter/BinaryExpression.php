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
        } else if ($this->attributes['operator'] === '<=') {
            return 'less-equal';
        } else if ($this->attributes['operator'] === '>=') {
            return 'greater-equal';
        } else {
            throw new \Exception("Unknown operator {$this->attributes['operator']} ");
        }
    }

    public function getRuleFilter()
    {
        $attributes = $this->attributes;

        unset($attributes['operator']);
        return $attributes;
    }
}