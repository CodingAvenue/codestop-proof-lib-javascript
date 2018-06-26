<?php

namespace CodeStop\Proof\JS\Filter;

use CodeStop\Proof\JS\Rule\RuleFactory;

class Variable extends Filter implements FilterFactory
{
    public function getRuleClass()
    {
        return RuleFactory::createRule('variable', $this->getRuleFilters());
    }

    public function getRuleFilters()
    {
        return $this->attributes;
    }
}