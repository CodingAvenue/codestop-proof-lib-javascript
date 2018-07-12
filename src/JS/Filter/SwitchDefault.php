<?php

namespace CodeStop\Proof\JS\Filter;

use CodeStop\Proof\JS\Rule\RuleFactory;

class SwitchDefault extends Filter implements FilterInterface
{
    public function getRuleClass()
    {
        return RuleFactory::createRule('switch-default', $this->getRuleFilter());
    }

    public function getRuleFilter()
    {
        return $this->attributes;
    }
}