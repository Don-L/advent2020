<?php

namespace App\Models;

class PasswordValidator implements PasswordValidatorInterface {

    public function passwordSatisfiesPolicy(Password $password, PasswordPolicy $policy): bool
    {
        $letter = $policy->letter();
        $letter_occurrences = substr_count($password->value(), $letter);
        $satisfies =    $letter_occurrences >= $policy->min()
                        && $letter_occurrences <= $policy->max();

        return $satisfies;
    }

}