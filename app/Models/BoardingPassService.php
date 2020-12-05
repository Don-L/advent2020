<?php 

namespace App\Models;

class BoardingPassService
{
    private $row_bounds = [0];
    private $col_bounds = [0];

    public function __construct(array $row_and_col_numbers)
    {
        $this->row_bounds[] = $row_and_col_numbers['rows'] - 1;
        $this->col_bounds[] = $row_and_col_numbers['cols'] - 1;
    }

    public function createNewPassFromString(string $string): BoardingPass
    {
        $row_string_length = (int) log($this->row_bounds[1] + 1, 2);
        $row_string        = substr($string, 0, $row_string_length);
        $col_string        = substr($string, $row_string_length);
        $pass              = new BoardingPass($row_string, $col_string);

        return $pass;
    }

    public function seatIdForPass(BoardingPass $pass): int
    {
        $row_index = $this->rowIndexForPass($pass);
        $col_index = $this->colIndexForPass($pass);
        echo 'row' . $row_index.PHP_EOL;
        echo 'col' . $col_index.PHP_EOL;
        $seat_id   = ($row_index * 8) + $col_index;

        return $seat_id;
    }

    private function rowIndexForPass(BoardingPass $pass): int
    {
        $row_string = $pass->row();
        $row_index  = $this->iterateBounds($row_string, $this->row_bounds);

        return $row_index;
    }

    private function colIndexForPass(BoardingPass $pass): int
    {
        $col_string = $pass->col();
        $col_index  = $this->iterateBounds($col_string, $this->col_bounds);

        return $col_index;
    }

    private function iterateBounds(string $row_or_col_string, array $bounds): int
    {
        echo 'string: ' . $row_or_col_string . ' bounds: ' . $bounds[0] . ',' . $bounds[1] . PHP_EOL;
        if (strlen($row_or_col_string) === 0) {return $bounds[0];}

        $current_row_or_col_string = substr($row_or_col_string, 0, 1);
        $next_row_or_col_string    = substr($row_or_col_string, 1);

        return  $this->iterateBounds(
                    $next_row_or_col_string,
                    $this->getBoundsForIndexAndRowOrColumnString(
                        $bounds,
                        $current_row_or_col_string
                    )
                );
    }

    private function getBoundsForIndexAndRowOrColumnString(array $bounds, string $string): array
    {
        return [
            'F' => function($bounds){return $this->lowerHalfBounds($bounds);},
            'B' => function($bounds){return $this->upperHalfBounds($bounds);},
            'L' => function($bounds){return $this->lowerHalfBounds($bounds);},
            'R' => function($bounds){return $this->upperHalfBounds($bounds);},
        ][$string]($bounds);
    }

    private function lowerHalfBounds(array $bounds): array
    {
        $mid = $bounds[0] + (int) (($bounds[1] - $bounds[0]) / 2);
        return [$bounds[0], $bounds[0] + $mid];
    }

    private function upperHalfBounds(array $bounds): array
    {
        $mid = $bounds[0] + (int) (($bounds[1] - $bounds[0]) / 2);
        return [$bounds[0] + $mid, $bounds[1]];
    }

}
