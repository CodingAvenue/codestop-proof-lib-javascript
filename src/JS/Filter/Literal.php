<?php

namespace CodeStop\Proof\JS\Filter;

use CodeStop\Proof\JS\Rule\RuleFactory;

class Literal extends Filter implements FilterInterface
{
    public function getRuleClass()
    {
        return RuleFactory::createRule('literal', $this->getRuleFilter());
    }

    public function getRuleFilter()
    {
        return $this->attributes;
    }
}