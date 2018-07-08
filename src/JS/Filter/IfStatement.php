<?php

namespace CodeStop\Proof\JS\Filter;

use CodeStop\Proof\JS\Rule\RuleFactory;

class IfStatement extends Filter implements FilterInterface
{
    public function getRuleClass()
    {
        return RuleFactory::createRule('if', $this->getRuleFilter());
    }

    public function getRuleFilter()
    {
        return $this->attribute;
    }
}
