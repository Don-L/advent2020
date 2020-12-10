<?php 

namespace App\Models\DaySix;

class AnswerSetService
{
    public function fromString(string $answer_string): AnswerSet
    {
        return new AnswerSet(count_chars($answer_string));
    }

    public function setsFromArray(array $answer_strings): array
    {
        $answer_sets = [];

        foreach ($answer_strings as $answer_string) {
            $answer_set    = $this->fromString($answer_string);
            $answer_sets[] = $answer_set;
        }

        return $answer_sets;
    }

    public function mergeMultiple(array $answer_sets): AnswerSet
    {
        $merged_chars_and_occurrences = (new AnswerSet())->answers();
        $i                            = 0;

        while ($i < count($answer_sets)) {
            $merged_chars_and_occurrences = $this->mergeAnswers($merged_chars_and_occurrences, $answer_sets[$i]->answers());
            $i++;
        }

        $merged = new AnswerSet($merged_chars_and_occurrences);

        return $merged;
    }

    private function mergeAnswers(array $answer_set_1_answers, array $answer_set_2_answers): array
    {
        $merged_chars_and_occurrences = [];

        foreach ($answer_set_1_answers as $char => $occurrences) {
            $merged_chars_and_occurrences[$char] = $occurrences + $answer_set_2_answers[$char];
        }

        return $merged_chars_and_occurrences;
    }

    public function countCharsWithOccurrencesGreaterThanN(AnswerSet $answer_set, int $n): int
    {
        $count = 0;

        foreach ($answer_set->answers() as $char => $occurrences) {
            if ($occurrences > $n) {
                $count++;
            }
        }

        return $count;
    }

}
