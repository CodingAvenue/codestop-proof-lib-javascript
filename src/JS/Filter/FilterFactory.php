<?php

namespace CodeStop\Proof\JS\Filter;

/**
 * Factory class for JS Filter classes
 * maps a filter name to a filter class, if exists
 * Returns the instance of the filter class
 * Throws an error if no filter found
 */

class FilterFactory
{
    public static function createFilter(string $name, array $attributes)
    {
        $filters = self::getFilters();

        $filter = isset($filters[$name]) ? $filters[$name] : null;

        if (is_null($filter)) {
            throw new \Exception ("No Filter class found to handle {$name}");
        }

        return new $filter($name, $attributes);
    }

    public static function getFilters()
    {
        return array(
            'call-expression'   => '\CodeStop\Proof\JS\Filter\CallExpression',
            'variable'          => '\CodeStop\Proof\JS\Filter\Variable',
            'argument'          => '\CodeStop\Proof\JS\Filter\Argument',
            'binary-expression' => '\CodeStop\Proof\JS\Filter\BinaryExpression',
            'if-statement'      => '\CodeStop\Proof\JS\Filter\IfStartement',
            'switch'            => '\CodeStop\Proof\JS\Filter\Switch_'
        );
    }
}