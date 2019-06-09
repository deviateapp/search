<?php

namespace Deviate\Search\Tests;

use PHPUnit\Framework\Assert as PHPUnit;

class BuilderSpy
{
    private $calls = [];

    public function __call($name, $arguments)
    {
        $this->calls[] = [$name, $arguments];

        return $this;
    }

    public function assertWasCalled($name, ?array $arguments = null)
    {
        $found = array_filter($this->calls, function ($item) use ($name, $arguments) {
            return $item[0] === $name
                && (($arguments && $item[1] === $arguments) || is_null($arguments));
        });

        PHPUnit::assertTrue((bool) $found);
    }
}
