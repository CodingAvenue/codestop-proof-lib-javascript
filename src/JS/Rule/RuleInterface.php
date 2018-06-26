<?php

namespace CodeStop\Proof\JS\Rule;

interface RuleInterface
{
    public function applyRule(array $nodes);
}