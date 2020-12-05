<?php

namespace App\Models\DayFour;

class DayFourStarOnePolicy implements PassportPolicy
{
    public function fieldPolicies(): array
    {
        return [
            'byr' => function(){return function($val){return (bool) $val;};},
            'iyr' => function(){return function($val){return (bool) $val;};},
            'eyr' => function(){return function($val){return (bool) $val;};},
            'hgt' => function(){return function($val){return (bool) $val;};},
            'hcl' => function(){return function($val){return (bool) $val;};},
            'ecl' => function(){return function($val){return (bool) $val;};},
            'pid' => function(){return function($val){return (bool) $val;};},
            'cid' => function(){return function($val){return true;};},
        ];
    }

}
