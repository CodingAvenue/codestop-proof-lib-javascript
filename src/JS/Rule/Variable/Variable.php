<?php

namespace CodeStop\Proof\JS\Rule\Variable;

class Variable extends Rule implements RuleInterface
{
    public function getRule(): callable
    {
        $filter = $this->filter;
        $getIndex = $this->getIndentifierIndex();

        return function($node) use ($filter, $getIndex) {
            $index = call_user_func($getIndex, $node);

            return (
                ($node['type'] == "VariableDeclaration"
                && (!is_null($index)))
                && (isset($filter['kind']) ? $node['kind'] === $filter['kind'] : true)
            );
        };
    }

    private function getIdentifierIndex(): callable
    {
        $name = $this->filter['name'];

        return function($node) use ($name) {
            $foundIndex = null;
            foreach ($node['declarations'] as $index => $declaration) {
                if ($declaration['id']['name'] === $name) {
                    $foundIndex = $index;
                    break;
                }
            }

            return $foundIndex;
        };
    }

    public function allowedOptionalFilter()
    {
        $attributes = $this->filters;
        unset($attributes['name']);

        return $attributes;
    }
}