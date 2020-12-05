<?php

// use App\Models\ExpenseReportService;

namespace App\Models;

class ExpenseReportService
{
    public function findProductOfTwoExpensesWithValuesThatSumTo2020(ExpenseReport $report)
    {
        $expense_values = $report->expenseValues();
        $pair           = $this->findValuePairsThatSumTo2020($expense_values);
        $product        = $pair[0] * $pair[1];

        return $product;
    }

    public function findProductOfThreeExpensesWithValuesThatSumTo2020(ExpenseReport $report)
    {
        $expense_values = $report->expenseValues();
        $triplet        = $this->findValueTripletsThatSumTo2020($expense_values);
        $product        = $triplet[0] * $triplet[1] * $triplet[2];

        return $product;
    }

    private function findValuePairsThatSumTo2020(array $expense_values): array
    {
        $pair_that_sums_to_2020 = [];

        foreach ($this->generateExpenseValuePairs($expense_values) as $pair) {
            if ($pair[0] + $pair[1] === 2020) {
                $pair_that_sums_to_2020 = $pair;
                break;
            }
        }

        $this->throwErrorIfExpensesSetNotFound($pair_that_sums_to_2020);

        return $pair_that_sums_to_2020;
    }

    private function findValueTripletsThatSumTo2020(array $expense_values): array
    {
        $triplet_that_sums_to_2020 = [];

        foreach ($this->generateExpenseValueTriplets($expense_values) as $triplet) {
            // echo $triplet[0] . ',' . $triplet[1] . ',' . $triplet[2] . PHP_EOL;
            if ($triplet[0] + $triplet[1] + $triplet[2] === 2020) {
                $triplet_that_sums_to_2020 = $triplet;
                break;
            }
        }

        $this->throwErrorIfExpensesSetNotFound($triplet_that_sums_to_2020);

        return $triplet_that_sums_to_2020;
    }

    private function generateExpenseValueTriplets(array $expense_values): iterable
    {
        $i = 0;
        while ($i < (count($expense_values) - 2)) {
            $remainder = array_slice($expense_values, $i + 1);
            foreach ($this->generateExpenseValuePairs($remainder) as $pair) {
                yield [$expense_values[$i], $pair[0], $pair[1]];
            }
            $i++;
        }
    }

    private function generateExpenseValuePairs(array $expense_values): iterable
    {
        $i = 0;
        $j = 1;
        while ($i < (count($expense_values) - 1)) {
            while ($j < count($expense_values)) {
                yield [$expense_values[$i], $expense_values[$j]];
                $j++;
            }
            $i++;
            $j = $i + 1;
        }
    }

    private function throwErrorIfExpensesSetNotFound(array $set): void
    {
        if (count($set) === 0) {
            throw new \Exception('No valid expenses set found');
        }
    }

}
