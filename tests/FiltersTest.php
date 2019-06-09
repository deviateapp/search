<?php

namespace Deviate\Search\Tests;

use Deviate\Search\Filters\EqualsExact;
use Deviate\Search\Filters\GreaterThan;
use Deviate\Search\Filters\GreaterThanOrEqualTo;
use Deviate\Search\Filters\LessThan;
use Deviate\Search\Filters\LessThanOrEqualTo;
use Deviate\Search\Filters\MatchesFuzzy;
use Deviate\Search\Filters\MustBeIn;
use Deviate\Search\Filters\NotWithinRange;
use PHPUnit\Framework\TestCase;

class FiltersTest extends TestCase
{
    /** @var BuilderSpy */
    private $builder;

    /** @test */
    public function it_can_filter_exact_values()
    {
        $filter = new EqualsExact('field', 'value');

        $return = $filter->apply($this->builder);

        $this->assertEquals($this->builder, $return);
        $this->builder->assertWasCalled('where', ['field', '=', 'value']);
    }

    /** @test */
    public function it_can_filter_greater_than_values()
    {
        $filter = new GreaterThan('field', 5);

        $return = $filter->apply($this->builder);

        $this->assertEquals($this->builder, $return);
        $this->builder->assertWasCalled('where', ['field', '>', 5]);
    }

    /** @test */
    public function it_can_filter_greater_than_or_equal_to_values()
    {
        $filter = new GreaterThanOrEqualTo('field', 5);

        $return = $filter->apply($this->builder);

        $this->assertEquals($this->builder, $return);
        $this->builder->assertWasCalled('where', ['field', '>=', 5]);
    }

    /** @test */
    public function it_can_filter_less_than_values()
    {
        $filter = new LessThan('field', 5);

        $return = $filter->apply($this->builder);

        $this->assertEquals($this->builder, $return);
        $this->builder->assertWasCalled('where', ['field', '<', 5]);
    }

    /** @test */
    public function it_can_filter_less_than_or_equal_to_values()
    {
        $filter = new LessThanOrEqualTo('field', 5);

        $return = $filter->apply($this->builder);

        $this->assertEquals($this->builder, $return);
        $this->builder->assertWasCalled('where', ['field', '<=', 5]);
    }

    /** @test */
    public function it_can_filter_using_fuzzy_matching()
    {
        $filter = new MatchesFuzzy('field', 'value');

        $return = $filter->apply($this->builder);

        $this->assertEquals($this->builder, $return);
        $this->builder->assertWasCalled('where', ['field', 'LIKE', '%value%']);
    }

    /** @test */
    public function it_can_filter_by_a_value_being_in_an_array()
    {
        $filter = new MustBeIn('field', [1, 2, 3]);

        $return = $filter->apply($this->builder);

        $this->assertEquals($this->builder, $return);
        $this->builder->assertWasCalled('whereIn', ['field', [1, 2, 3]]);
    }

    /** @test */
    public function it_can_filter_by_a_value_not_being_in_a_range()
    {
        $filter = new NotWithinRange('field', 1, 5, true);

        $return = $filter->apply($this->builder);

        $this->assertEquals($this->builder, $return);

        $this->builder->assertWasCalled('where');
    }

    /** @test */
    public function it_can_filter_by_a_value_being_in_a_range()
    {
        $filter = new NotWithinRange('field', 1, 5, true);

        $return = $filter->apply($this->builder);

        $this->assertEquals($this->builder, $return);

        $this->builder->assertWasCalled('where');
    }

    protected function setUp()
    {
        parent::setUp();

        $this->builder = new BuilderSpy;
    }
}
