<?php

namespace Deviate\Search\Eloquent;

use Deviate\Search\SearchContainerInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

interface SearchBuilderInterface
{
    public function search(SearchContainerInterface $search): LengthAwarePaginator;
    public function applyDefaultOrders(): Builder;
}
