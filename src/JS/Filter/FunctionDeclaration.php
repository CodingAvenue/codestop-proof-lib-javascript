<?php

namespace CodeStop\Proof\JS\Filter;

use CodeStop\Proof\JS\Rule\RuleFactory;

class FunctionDeclaration extends Filter implements FilterInterface
{
    public function getRuleClass()
    {
        return RuleFactory::createRule('function-declaration', $this->getRuleFilter());
    }

    public function getRuleFilter()
    {
        return $this->attributes;
    }
}