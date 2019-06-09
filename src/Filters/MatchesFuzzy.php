<?php

namespace Deviate\Search\Filters;

use Deviate\Search\AbstractQueryApplicator;

class MatchesFuzzy extends AbstractQueryApplicator implements FilterInterface
{
    protected $value;

    public function __construct(string $field, $value)
    {
        $this->field = $field;
        $this->value = $value;
    }

    public function apply($query)
    {
        return $query->where($this->field, 'LIKE', '%' . $this->value . '%');
    }
}
