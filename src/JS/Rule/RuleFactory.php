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
            'variable-declaration'  => '\CodeStop\Proof\JS\Rule\Variable\VariableDeclaration',
            'identifier' => '\CodeStop\Proof\JS\Rule\Variable\Identifier',
            'literal'   => '\CodeStop\Proof\JS\Rule\String\Literal',
            'argument'  => '\CodeStop\Proof\JS\Rule\Argument\Argument',
            'assignment' => '\CodeStop\Proof\JS\Rule\Expression\Assignment',
            'plus'      => '\CodeStop\Proof\JS\Rule\BinaryOperator\Plus_',
            'greater-than' => '\CodeStop\Proof\JS\Rule\BinaryOperator\Greater',
            'if'        => '\CodeStop\Proof\JS\Rule\Statement\If_',
            'switch'    => '\CodeStop\Proof\JS\Rule\Statement\Switch_',
            'switch-default' => '\CodeStop\Proof\JS\Rule\Statement\SwitchDefault'
        );
    }
}