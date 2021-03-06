<?php

namespace CodeStop\Proof\JS\Rule\Expression\Call;

use CodeStop\Proof\JS\Rule\Rule;
use CodeStop\Proof\JS\Rule\RuleInterface;

/**
 * Console Rule class
 */

class Console extends Rule implements RuleInterface
{
    public function getRule(): callable
    {
        $filter = $this->filter;

        return function($node) use($filter) {
            return (
                ($node['type'] == 'ExpressionStatement'
                && $node['expression']['type'] == 'CallExpression'
                && $node['expression']['callee']['object']['name'] == 'console')
                && (isset($filter['property']) ? ($node['expression']['callee']['property']['name'] == $filter['property']) : true)
            );
        };
    }

    public function allowedOptionalFilter()
    {
        return array('property');
    }
}
