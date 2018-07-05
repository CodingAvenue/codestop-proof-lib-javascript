<?php

namespace CodeStop\Proof\JS\Filter;

use CodeStop\Proof\JS\Rule\RuleFactory;

class Variable extends Filter implements FilterInterface
{
    public function getRuleClass()
    {
        return RuleFactory::createRule('variable', $this->getRuleFilter());
    }

    public function getRuleFilter()
    {
        return $this->attributes;
    }
}