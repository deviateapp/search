<?php

namespace Deviate\Search\Filters;

use Deviate\Search\AbstractQueryApplicator;

class MustBeIn extends AbstractQueryApplicator implements FilterInterface
{
    protected $values;

    public function __construct(string $field, $values)
    {
        $this->field  = $field;
        $this->values = $values;
    }

    public function apply($query)
    {
        return $query->whereIn($this->field, $this->values);
    }
}
