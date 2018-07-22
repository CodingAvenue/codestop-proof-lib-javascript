<?php

namespace CodeStop\Proof\JS\Filter;

use CodeStop\Proof\JS\Rule\RuleFactory;

class ContinueStatement extends Filter implements FilterInterface
{
    public function getRuleClass()
    {
        return RuleFactory::createRule('continue', $this->getRuleFilter());
    }

    public function getRuleFilter()
    {
        return $this->attributes;
    }
}