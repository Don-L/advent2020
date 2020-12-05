<?php

namespace App\Models;

class PasswordValidatorService
{
    private $validator;

    public function __construct(PasswordValidatorInterface $validator)
    {
        $this->validator = $validator;
    }
    
    public function countValidPasswords(array $passwords_and_policies): int
    {
        $count = 0;

        foreach ($passwords_and_policies as $password_and_policy) {
            $password = Password::fromPasswordAndPolicyArray($password_and_policy);
            $policy   = PasswordPolicy::fromPasswordAndPolicyArray($password_and_policy);
            if ($this->validator->passwordSatisfiesPolicy($password, $policy)) {
                $count++;
            }
        }

        return $count;
    }

}
