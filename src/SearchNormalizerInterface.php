<?php

namespace Deviate\Search;

interface SearchNormalizerInterface
{
    public function normalize(SearchContainerInterface $search): SearchContainerInterface;
}
