<?php

namespace CodeStop\Proof\JS\Filter;

use CodeStop\Proof\JS\Rule\RuleFactory;

class UpdateExpression extends Filter implements FilterInterface
{
    public function getRuleClass()
    {
        return RuleFactory::createRule($this->getOperator(), $this->getRuleFilter());
    }

    private function getOperator()
    {
        if ($this->attributes['operator'] === '++') {
            return 'increment';
        } else if ($this->attributes['operator'] === '--') {
            return 'decrement';
        } else {
            throw new \Exception("Unknown operator {$this->attributes['operator']}");
        }
    }

    public function getRuleFilter()
    {
        return $this->attributes;
    }
}