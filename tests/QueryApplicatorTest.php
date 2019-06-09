<?php

namespace Deviate\Search\Tests;

use Deviate\Search\AbstractQueryApplicator;
use PHPUnit\Framework\TestCase;

class QueryApplicatorTest extends TestCase
{
    /** @test */
    public function it_can_check_to_see_if_a_supplied_field_is_within_a_whitelist()
    {
        $sut = new FilterFixture('test_field');

        $this->assertTrue($sut->isWhitelisted(['test_field']));
        $this->assertFalse($sut->isWhitelisted(['invalid_field']));
    }

    /** @test */
    public function it_can_map_fields()
    {
        $sut = new FilterFixture('test_field');

        $response = $sut->transformField(['test_field' => 'test_real_field']);

        $this->assertEquals($sut, $response);
        $this->assertEquals('test_real_field', $sut->getField());
    }
}

class FilterFixture extends AbstractQueryApplicator
{
    public function __construct($field)
    {
        $this->field = $field;
    }

    public function apply($query)
    {
        //
    }

    public function getField()
    {
        return $this->field;
    }
}
