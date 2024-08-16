<?php

namespace Conecto\SearchBundle;

interface SearchServiceInterface {
    public function getResults(string $query): array;
}
