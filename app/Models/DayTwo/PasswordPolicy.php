<?php

namespace App\Models;

class PasswordPolicy {

    private $letter;
    private $min;
    private $max;

    public function __construct(string $counts, string $letter)
    {
        $this->setCounts($counts);
        $this->letter = $letter;
    }

    private function setCounts(string $counts): void
    {
        $exploded  = explode('-', $counts);
        $this->min = (int) $exploded[0];
        $this->max = (int) $exploded[1];
    }

    public static function fromPasswordAndPolicyArray(array $password_and_policy): PasswordPolicy
    {
        return new PasswordPolicy($password_and_policy[0], $password_and_policy[1]);
    }

    public function min(): int
    {
        return $this->min;
    }

    public function max(): int
    {
        return $this->max;
    }

    public function letter(): string
    {
        return $this->letter;
    }

}