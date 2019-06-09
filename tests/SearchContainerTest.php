<?php

namespace Deviate\Search\Tests;

use Deviate\Search\Filters\EqualsExact;
use Deviate\Search\SearchContainer;
use Deviate\Search\Sorting\RegularSort;
use PHPUnit\Framework\TestCase;
use function serialize;
use function unserialize;

class SearchContainerTest extends TestCase
{
    /** @test */
    public function it_can_set_the_page()
    {
        $container = new SearchContainer;

        $container->forPage(10);

        $this->assertEquals(10, $container->getPage());
    }

    /** @test */
    public function it_can_set_the_number_of_records_per_page()
    {
        $container = new SearchContainer;

        $container->perPage(100);

        $this->assertEquals(100, $container->getLimitPerPage());
    }

    /** @test */
    public function it_can_add_a_filter()
    {
        $container = new SearchContainer;
        $filter = new EqualsExact('field', 'value');

        $container->addFilter($filter);

        $filters = $container->getFilters();
        $this->assertEquals($filter, $filters[0]);
    }

    /** @test */
    public function it_can_add_sorting()
    {
        $container = new SearchContainer;
        $sort = RegularSort::ascending('field');

        $container->addSort($sort);

        $sorts = $container->getSorts();
        $this->assertEquals($sort, $sorts[0]);
    }

    /** @test */
    public function it_can_serialize_and_unserialize_a_search_container()
    {
        $container = new SearchContainer;

        $serialized = serialize($container);
        $unserialized = unserialize($serialized);

        $this->assertEquals($container, $unserialized);
    }
}
