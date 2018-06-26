<?php

namespace CodeStop\Proof\JS\Filter;

class Argument extends Filter implements FilterInterface
{
    public function getRuleClass()
    {
        return RuleFactory::createRule('argument', $this->getRuleFilters());
    }

    public function getRuleFilters()
    {
        $this->attributes;
    } 
}