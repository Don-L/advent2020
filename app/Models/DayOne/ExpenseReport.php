<?php

// use App\Models\ExpenseReport;

namespace App\Models;

class ExpenseReport
{
    private $expenses = [];
    private $expense_values;

    public function __construct(array $expense_values)
    {
        $this->expense_values = $expense_values;
        $this->expenses       = $this->setExpenses($expense_values);
    }

    private function setExpenses(array $expense_values): void
    {
        $expenses = [];

        foreach ($expense_values as $ev) {
            $expenses[] = new Expense($ev);
        }

        $this->expenses = $expenses;
    }

    public function expenseValues(): array
    {
        return $this->expense_values;
    }

    public function expenses(): array
    {
        return $this->expenses;
    }

}
