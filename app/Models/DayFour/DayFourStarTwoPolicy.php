<?php

namespace App\Models\DayFour;

class DayFourStarTwoPolicy implements PassportPolicy
{
    public function fieldPolicies(): array
    {
        return [
            'byr' => function(){return $this->validByr();},
            'iyr' => function(){return $this->validIyr();},
            'eyr' => function(){return $this->validEyr();},
            'hgt' => function(){return $this->validHgt();},
            'hcl' => function(){return $this->validHcl();},
            'ecl' => function(){return $this->validEcl();},
            'pid' => function(){return $this->validPid();},
            'cid' => function(){return $this->validCid();},
        ];
    }

    private function validByr(): callable
    {
        return function($val) {
            $valid =    $this->stringXCharactersLong($val, 4)
                        && $this->allNumbers($val)
                        && $this->intBetween((int) $val, 1920, 2002);

            return $valid;
        };
    }

    private function validIyr(): callable
    {
        return function($val) {
            $valid =    $this->stringXCharactersLong($val, 4)
                        && $this->allNumbers($val)
                        && $this->intBetween((int) $val, 2010, 2020);

            return $valid;
        };
    }

    private function validEyr(): callable
    {
        return function($val) {
            $valid =    $this->stringXCharactersLong($val, 4)
                        && $this->allNumbers($val)
                        && $this->intBetween((int) $val, 2020, 2030);

            return $valid;
        };
    }

    private function validHgt(): callable
    {
        return function($val) {
            $valid =    $this->endsInCmOrIn($val)
                        && ($this->validCmHgt($val) || $this->validInHgt($val));

            return $valid;
        };
    }

    private function validHcl(): callable
    {
        return function($val) {
            $valid =    strlen($val) === 7
                        && $val[0] === '#'
                        && ctype_xdigit(explode('#', $val)[1]);

            return $valid;
        };
    }

    private function validEcl(): callable
    {
        return function($val) {
            $valid = in_array($val, ['amb','blu','brn','gry','grn','hzl','oth']);
            return $valid;
        };
    }

    private function validPid(): callable
    {
        return function($val) {
            $valid = $this->stringXCharactersLong($val, 9) && $this->allNumbers($val);
            return $valid;
        };
    }

    private function validCid(): callable
    {
        return function($val) {
            return true;
        };
    }

    private function validCmHgt(string $val): bool
    {
        if (!$this->endsInCm($val)) { return false; }

        $height_str = explode('cm', $val)[0];

        if (!$this->allNumbers($height_str)) { return false; }

        return $this->intBetween((int) $height_str, 150, 193);
    }

    private function validInHgt(string $val): bool
    {
        if (!$this->endsInIn($val)) { return false; }

        $height_str = explode('in', $val)[0];

        if (!$this->allNumbers($height_str)) { return false; }

        return $this->intBetween((int) $height_str, 59, 76);
    }

    private function endsInCmOrIn($val): bool
    {
        return $this->endsInCm($val) || $this->endsInIn($val);
    }

    private function endsInCm(string $val): bool
    {
        return substr($val, -2) === 'cm';
    }

    private function endsInIn(string $val): bool
    {
        return substr($val, -2) === 'in';
    }

    private function stringXCharactersLong(string $val, int $length): bool
    {
        return strlen($val) === $length;
    }

    private function allNumbers(string $val): bool
    {
        return ctype_digit($val);
    }

    private function intBetween(int $int, int $lower, int $higher): bool
    {
        return $int >= $lower && $int <= $higher;
    }

}
