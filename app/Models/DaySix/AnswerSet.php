<?php 

namespace App\Models\DaySix;

use Exception;

class AnswerSet
{
    private $answers = [
         97 => 0,
         98 => 0,
         99 => 0,
        100 => 0,
        101 => 0,
        102 => 0,
        103 => 0,
        104 => 0,
        105 => 0,
        106 => 0,
        107 => 0,
        108 => 0,
        109 => 0,
        110 => 0,
        111 => 0,
        112 => 0,
        113 => 0,
        114 => 0,
        115 => 0,
        116 => 0,
        117 => 0,
        118 => 0,
        119 => 0,
        120 => 0,
        121 => 0,
        122 => 0,
    ];

    public function __construct(array $chars_and_occurrences = [])
    {
        $this->setAnswers($chars_and_occurrences);
    }

    private function setAnswers(array $chars_and_occurrences): void
    {
        if (count($chars_and_occurrences) > 0) {

            $answers = [];

            foreach ($this->answers as $char => $occurrences) {
                $answers[$char] = $chars_and_occurrences[$char];
            }

            $this->answers = $answers;
        }
    }

    public function answers(): array
    {
        return $this->answers;
    }

}
