<?php

namespace App\Models\DayFour;

class PassportService
{
    public function createPassportFromInputArray(array $fields_and_values): Passport
    {
        $nice_fields_and_values = [];

        foreach ($fields_and_values as $field_and_value) {
            $exploded                       = explode(':', $field_and_value);
            $field                          = (string) $exploded[0];
            $value                          = (string) $exploded[1];
            $nice_fields_and_values[$field] = $value;
        }

        return new Passport($nice_fields_and_values);
    }

    public function passportValidForPolicy(Passport $passport, PassportPolicy $policy): int
    {
        $valid = 1;

        foreach ($policy->fieldPolicies() as $field => $validator) {
            if (!$validator()($passport->fieldValue($field))) {
                $valid = 0;
                break;
            }
        }

        return $valid;
    }

    public function passportValidForPolicies(Passport $passport, array $policies): int
    {
        $valid = 1;

        foreach ($policies as $policy) {
            if (!$this->passportValidForPolicy($passport, $policy)) {
                $valid = 0;
                break;
            }
        }

        return $valid;
    }

}