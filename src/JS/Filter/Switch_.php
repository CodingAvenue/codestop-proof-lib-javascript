<?php

namespace CodeStop\Proof\JS\Filter;

use CodeStop\Proof\JS\Rule\RuleFactory;

class Switch_ extends Filter implements FilterInterface
{
    public function getRuleClass()
    {
        return RuleFactory::createRule('switch', $this->getRuleFilter());
    }

    public function getRuleFilter()
    {
        return $this->attributes;
    }
}