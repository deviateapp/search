<?php

namespace Deviate\Search\Tests;

use Deviate\Search\Filters\EqualsExact;
use Deviate\Search\Sorting\RegularSort;
use PHPUnit\Framework\TestCase;

class SortingTest extends TestCase
{
    /** @var BuilderSpy */
    private $builder;

    /** @test */
    public function it_can_add_regular_ascending_sorting()
    {
        $filter = RegularSort::ascending('field');

        $return = $filter->apply($this->builder);

        $this->assertEquals($this->builder, $return);
        $this->builder->assertWasCalled('orderBy', ['field', 'asc']);
    }

    /** @test */
    public function it_can_add_regular_descending_sorting()
    {
        $filter = RegularSort::descending('field');

        $return = $filter->apply($this->builder);

        $this->assertEquals($this->builder, $return);
        $this->builder->assertWasCalled('orderBy', ['field', 'desc']);
    }

    protected function setUp()
    {
        parent::setUp();

        $this->builder = new BuilderSpy;
    }
}
