<?php

namespace CodeStop\Proof\JS\Filter;

use CodeStop\Proof\JS\Rule\RuleFactory;

class ArrowFunction extends Filter implements FilterInterface
{
    public function getRuleClass()
    {
        return RuleFactory::createRule('arrow-function', $this->getRuleFilter());
    }

    public function getRuleFilter()
    {
        return $this->attributes;
    }
}