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
            'minus'     => '\CodeStop\Proof\JS\Rule\BinaryOperator\Minus_',
            'mul'       => '\CodeStop\Proof\JS\Rule\BinaryOperator\Mul',
            'div'       => '\CodeStop\Proof\JS\Rule\BinaryOperator\Div',
            'mod'       => '\CodeStop\Proof\JS\Rule\BinaryOperator\Mod',
            'greater-than' => '\CodeStop\Proof\JS\Rule\BinaryOperator\Greater',
            'less-than' => '\CodeStop\Proof\JS\Rule\BinaryOperator\Less_',
            'equals'    => '\CodeStop\Proof\JS\Rule\BinaryOperator\Equals',
            'increment' => '\CodeStop\Proof\JS\Rule\Expression\Increment_',
            'decrement' => '\CodeStop\Proof\JS\Rule\Expression\Decrement_',
            'if'        => '\CodeStop\Proof\JS\Rule\Statement\If_',
            'switch'    => '\CodeStop\Proof\JS\Rule\Statement\Switch_',
            'switch-default' => '\CodeStop\Proof\JS\Rule\Statement\SwitchDefault',
            'for-statement' => '\CodeStop\Proof\JS\Rule\Statement\For_'
        );
    }
}