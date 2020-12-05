<?php

namespace App\Models;

class SlopePositionService
{
    public function next(SlopePosition $position, Directions $directions): SlopePosition
    {
        $next_row = $position->row() + $directions->down();
        $next_col = $position->col() + $directions->right();
        $next     = new SlopePosition($next_row, $next_col);

        return $next;
    }
}
