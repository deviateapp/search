<?php

namespace Deviate\Search\Filters;

use Deviate\Search\AbstractQueryApplicator;

class NotWithinRange extends AbstractQueryApplicator implements FilterInterface
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
            return $this->build($query, '<=', '>=');
        }

        return $this->build($query, '<', '>');
    }

    private function build($query, string $startOperator, string $endOperator)
    {
        return $query->where(function ($query) use ($startOperator, $endOperator) {
            return $query->where($this->field, $startOperator, $this->start)
                ->orWhere($this->field, $endOperator, $this->end);
        });
    }
}
