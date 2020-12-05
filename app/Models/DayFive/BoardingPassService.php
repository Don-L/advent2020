<?php 

namespace App\Models\DayFive;

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
        if ($bounds[0] === $bounds[1]) {return $bounds[0];}

        $upper_or_lower_signifier = substr($row_or_col_string, 0, 1);
        $next_row_or_col_string   = substr($row_or_col_string, 1);

        return  $this->iterateBounds(
                    $next_row_or_col_string,
                    $this->getBoundsForIndexAndRowOrColumnString(
                        $bounds,
                        $upper_or_lower_signifier
                    )
                );
    }

    private function getBoundsForIndexAndRowOrColumnString(
         array $bounds,
        string $upper_or_lower_signifier
    ): array
    {
        return [
            'F' => function($bounds){return $this->lowerHalfBounds($bounds);},
            'B' => function($bounds){return $this->upperHalfBounds($bounds);},
            'L' => function($bounds){return $this->lowerHalfBounds($bounds);},
            'R' => function($bounds){return $this->upperHalfBounds($bounds);},
        ][$upper_or_lower_signifier]($bounds);
    }

    private function lowerHalfBounds(array $bounds): array
    {
        return [$bounds[0], $bounds[0] + ((int) floor(($bounds[1] - $bounds[0]) / 2))];
    }

    private function upperHalfBounds(array $bounds): array
    {
        return [$bounds[1] - ((int) floor(($bounds[1] - $bounds[0]) / 2)), $bounds[1]];
    }

}
