<?php

namespace App\Models;

class Expense
{
    private $value;

    public function __construct(int $value) {
        $this->value = $value;
    }

    public function value(): int
    {
        return $this->value;
    }
    
}
