<?php

namespace App\Models\DayFour;

class Passport
{
    private $field_values = [];

    public function __construct(array $field_values)
    {
        if (count($field_values) === 0) {
            throw new \Exception('No field values in Passport constructor');
        }

        $this->field_values = $field_values;
    }

    public function fieldValue(string $field): string
    {
        $value = $this->field_values[$field] ?? '';  
        return $value;
    }

}
