<?php

namespace App\Models;

class Directions {

    private $right;
    private $down;

    public function __construct(array $directions)
    {
        $this->right = $directions['right'];
        $this->down  = $directions['down'];
    }

    public function right(): int
    {
        return $this->right;
    }

    public function down(): int
    {
        return $this->down;
    }

}
