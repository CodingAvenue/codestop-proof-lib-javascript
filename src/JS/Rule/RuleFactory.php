<?php

namespace CodeStop\Proof\JS\Rule;

class RuleFactory
{
    public static function createRule(string $name, array $filters = array())
    {
        $rules = self::getRules();

        $ruleClass = isset($rules[$name]) ? $rules[$name] : null;

        if (is_null($ruleClass)) {
            throw new \Exception("No Rule class to handle rule {$name}");
        }

        return new $ruleClass($filters);
    }

    public static function getRules()
    {
        return array(
            'console'   => '\CodeStop\Proof\JS\Rule\Expression\Call\Console',
            'variable'  => '\CodeStop\Proof\JS\Rule\Variable\Variable',
            'argument'  => '\CodeStop\Proof\JS\Rule\Argument\Arugment'
        );
    }
}