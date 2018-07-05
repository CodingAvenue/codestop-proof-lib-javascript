<?php

namespace CodeStop\Proof\JS\Filter;

use CodeStop\Proof\JS\Rule\RuleFactory;

class Argument extends Filter implements FilterInterface
{
    public function getRuleClass()
    {
        return RuleFactory::createRule('argument', $this->getRuleFilter());
    }

    public function getRuleFilter()
    {
        return $this->attributes;
    } 
}