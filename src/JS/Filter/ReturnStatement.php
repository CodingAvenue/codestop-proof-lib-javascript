<?php

namespace CodeStop\Proof\JS\Filter;

use CodeStop\Proof\JS\Rule\RuleFactory;

class ReturnStatement extends Filter implements FilterInterface
{
    public function getRuleClass()
    {
        return RuleFactory::createRule('return', $this->getRuleFilter());
    }

    public function getRuleFilter()
    {
        return $this->attributes;
    }
}