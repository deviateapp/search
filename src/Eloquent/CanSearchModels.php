<?php

namespace Deviate\Search\Eloquent;

use Deviate\Search\SearchContainerInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

trait CanSearchModels
{
    public function search(SearchContainerInterface $search): LengthAwarePaginator
    {
        return $this
            ->applyQueryApplicators($search->getFilters())
            ->applyQueryApplicators($search->getSorts())
            ->applyDefaultOrders()
            ->paginate($search->getLimitPerPage(), ['*'], 'page', $search->getPage());
    }

    private function applyQueryApplicators(array $applicators = []): Builder
    {
        foreach ($applicators as $applicator) {
            $applicator->apply($this);
        }

        return $this;
    }
}
