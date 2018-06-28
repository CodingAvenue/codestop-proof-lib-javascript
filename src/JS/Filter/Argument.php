<?php

namespace CodeStop\Proof\JS\Filter;

class Argument extends Filter implements FilterInterface
{
    public function getRuleClass()
    {
        return RuleFactory::createRule('argument', $this->getRuleFilter());
    }

    public function getRuleFilters()
    {
        $this->attributes;
    } 
}