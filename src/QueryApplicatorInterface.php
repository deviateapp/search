<?php

namespace Deviate\Search;

interface QueryApplicatorInterface
{
    public function apply($query);
    public function transformField(array $map): QueryApplicatorInterface;
    public function isWhitelisted(array $whitelist): bool;
}
