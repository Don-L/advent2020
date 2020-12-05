<?php 

namespace App\Models\DayFive;

class BoardingPass
{
    private $row_string;
    private $col_string;

    public function __construct(string $row_string, string $col_string)
    {
        $this->row_string = $row_string;
        $this->col_string = $col_string;
    }

    public function row(): string
    {
        return $this->row_string;
    }

    public function col(): string
    {
        return $this->col_string;
    }

    public function rowAndCol(): string
    {
        return $this->row_string . $this->col_string;
    }

}
