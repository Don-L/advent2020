<?php

namespace App\Models;

class PasswordValidatorTwo implements PasswordValidatorInterface {

    public function passwordSatisfiesPolicy(Password $password, PasswordPolicy $policy): bool
    {
        $letter                    = $policy->letter();
        $first_position            = $policy->min() - 1;
        $second_position           = $policy->max() - 1;
        $password_value            = $password->value();
        $letter_at_first_position  = $password_value[$first_position] === $letter;
        $letter_at_second_position = $password_value[$second_position] === $letter;
        $letter_at_both_positions  = $letter_at_first_position && $letter_at_second_position;
        $satisfies                 = !$letter_at_both_positions
                                     && ($letter_at_first_position || $letter_at_second_position);

        return $satisfies;
    }

}