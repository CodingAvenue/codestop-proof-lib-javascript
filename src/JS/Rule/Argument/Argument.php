<?php

namespace CodeStop\Proof\JS\Rule\Argument;

class Argument extends Rule implements RuleInterface
{
    public function getRule(): callable
    {
        $filter = $this->filter;
        $getIndex = $this->getTypeIndex();

        return function($node) use ($filter, $getIndex) {
            $index = is_null($getIndex) ? null : call_userFUnc($getIndex);

            return (
                ($node['type'] == 'ExpressionStatement'
                && isset($node['expression']['arguments'])
                && $node['expression']['arguments'].length > 0)
                && (
                    isset($filter['type'])
                        ? !is_null($index)
                            ? true
                            : false
                        : true
                )
                && (
                    isset($filter['name'])
                        ? !is_null($index)
                            ? $node['expression']['arguments'][$index]['name'] == $filter['name']
                            : false
                        : true
                )
                && (
                    isset($filter['value'])
                        ? !is_null($index)
                            ? $node['expression']['arguments'][$index]['value'] == $filter['name']
                            : false
                        : true
                )
            );
        };
    }

    private function getTypeIndex(): callable
    {
        $type = $this->filter['type'];

        return function($node) use($type) {
            $foundIndex = null;

            foreach ($node['expression']['arguments'] as $index => $arg) {
                if (strtolower($arg['type']) == $type) {
                    $foundIndex = $index;
                    break;
                }
            }

            return $foundIndex;
        };
    }

    public function allowedOptionalFilter()
    {
        return array('type', 'name', 'value');
    }
}