<?php

namespace CodeStop\Proof\JS\Filter;

interface FilterInterface
{
    public function applyFilter(array $nodes): array;
}