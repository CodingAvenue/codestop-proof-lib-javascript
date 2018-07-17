<?php

namespace CodeStop\Proof\JS\Rule\Expression\Call;

use CodeStop\Proof\JS\Rule\Rule;
use CodeStop\Proof\JS\Rule\RuleInterface;

/**
 * Call_ Rule class
 */

class Call_ extends Rule implements RuleInterface
{
    public function getRule(): callable
    {
        $filter = $this->filter;

        return function($node) use($filter) {
            if ($node['type'] == 'ExpressionStatement') {
                $node = $node['expression'];
            }

            if (isset($node['callee']['type']) && $node['callee']['type'] == 'MemberExpression') {
                return (
                    ($node['type'] == 'CallExpression'
                    && $node['callee']['object']['name'] == $filter['name'])
                    && (isset($filter['property']) ? ($node['callee']['property']['name'] == $filter['property']) : true)
                );
            } else {
                return (
                    $node['type'] == 'CallExpression'
                    && (
                        isset($filter['name'])
                            ? $filter['name'] == $node['callee']['name']
                            : true
                    )
                );
            }
        };
    }

    public function allowedOptionalFilter()
    {
        return array();
    }
}
