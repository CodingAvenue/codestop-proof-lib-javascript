<?php

namespace CodeStop\Proof\JS\Rule\BinaryOperator;

use CodeStop\Proof\JS\Rule\Rule;
use CodeStop\Proof\JS\Rule\RuleInterface;

class Plus_ extends Rule implements RuleInterface
{
    public function getRule(): callable
    {
        $filter = $this->filter;

        return function($node) use($filter) {
            return (
                ($node['operator'] == '+')
                && (
                    isset($filter['leftType'])
                        ? strtolower($node['left']['type']) == strtolower($filter['leftType'])
                        : true
                )
                && (
                    isset($filter['leftName'])
                        ? array_key_exists('name', $node['left'])
                            ? $filter['leftName'] == $node['left']['name']
                            : false
                        : true
                )
                && (
                    isset($filter['leftValue'])
                        ? array_key_exists('value', $node['left'])
                            ? $filter['leftValue'] == $node['left']['value']
                            : false
                        : true
                )
                && (
                    isset($filter['rightType'])
                        ? strtolower($node['right']['type']) == strtolower($filter['rightType'])
                        : true
                )
                && (
                    isset($filter['rightName'])
                        ? array_key_exists('name', $node['right'])
                            ? $filter['rightName'] == $node['right']['name']
                            : false
                        : true
                )
                && (
                    isset($filter['rightValue'])
                        ? array_key_exists('value', $node['right'])
                            ? $filter['rightValue'] == $node['right']['value']
                            : false
                        : true
                )
            );
        };
    }

    public function allowedOptionalFilter()
    {
        return array('leftType', 'leftName', 'leftValue', 'rightType', 'rightName', 'rightValue');
    }
}
