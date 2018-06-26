<?php

namespace CodeStop\Proof\JS\Filter;

abstract class Filter implements FilterInterface
{
    /** @var string $name the name of the filter class */
    protected $name;

    /** @var array $attributes An array of attributes that will use to determine the Rule Class to apply */
    protected $attributes;

    public function __construct(string $name, array $attributes)
    {
        $this->name = $name;
        $this->attributes = $attributes;
    }

    public function applytFilter(array $nodes): array
    {

    }

    abstract function getRuleClass();

    abstract function getRuleFilter();
}