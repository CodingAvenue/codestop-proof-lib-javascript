<?php

namespace CodeStop\Proof\JS\Filter;

use CodeStop\Proof\JS\Rule\RuleFactory;

class ForStatement extends Filter implements FilterInterface
{
    public function getRuleClass()
    {
        return RuleFactory::createRule('while-statement', $this->getRuleFilter());
    }

    public function getRuleFilter()
    {
        return $this->attributes;
    }
}
