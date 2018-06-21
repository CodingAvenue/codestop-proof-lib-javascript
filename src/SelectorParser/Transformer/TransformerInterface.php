<?php

namespace CodeStop\Proof\SelectorParser\Transformer;

use CodeStop\Proof\SelectorParser\Rule\RuleInterface;

interface TransformerInterface
{
    public function transform();

    public function addRule(RuleInterface $rule);
}
