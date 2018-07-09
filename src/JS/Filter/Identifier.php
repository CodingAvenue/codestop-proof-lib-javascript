<?php

namespace CodeStop\Proof\JS\Filter;

use CodeStop\Proof\JS\Rule\RuleFactory;

class Identifier extends Filter implements FilterInterface
{
    public function getRuleClass()
    {
        return RuleFactory::createRule('identifier', $this->getRuleFilter());
    }

    public function getRuleFilter()
    {
        return $this->attributes;
    } 
}