<?php

namespace App\Models;

class Password {

    private $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public static function fromPasswordAndPolicyArray(array $password_and_policy): Password
    {
        return new Password($password_and_policy[2]);
    }

    public function value(): string
    {
        return $this->value;
    }

}