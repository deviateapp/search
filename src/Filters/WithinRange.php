<?php

namespace Deviate\Search\Filters;

use Deviate\Search\AbstractQueryApplicator;

class WithinRange extends AbstractQueryApplicator implements FilterInterface
{
    protected $start;
    protected $end;
    protected $inclusive;

    public function __construct(string $field, $start, $end, bool $inclusive = true)
    {
        $this->field     = $field;
        $this->start     = $start;
        $this->end       = $end;
        $this->inclusive = $inclusive;
    }

    public function apply($query)
    {
        if ($this->inclusive) {
            return $this->build($query, '>=', '<=');
        }

        return $this->build($query, '>', '<');
    }

    private function build($query, string $startOperator, string $endOperator)
    {
        return $query->where($this->field, $startOperator, $this->start)
            ->where($this->field, $endOperator, $this->end);
    }
}
