<?php

namespace App\Models;

class SlopePath {

    private $positions = [];

    public function __construct(SlopeMap $map, array $positions)
    {
        $this->map       = $map;
        $this->positions = $positions;
    }

    public function map(): SlopeMap
    {
        return $this->map;
    }

    public function positions(): array
    {
        return $this->positions;
    }

}
