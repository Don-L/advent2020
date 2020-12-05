<?php

namespace App\Models;

class SlopePathService
{
    private $slope_positions;

    public function __construct(SlopePositionService $slope_positions)
    {
        $this->slope_positions = $slope_positions;
    }

    public function createPathFromMapAndStartingPosition(
             SlopeMap $map,
        SlopePosition $position
    ): SlopePath
    {
        $path = new SlopePath($map, [$position]);
        return $path;
    }

    public function countTreesForPath(SlopePath $path): int
    {
        $trees = 0;
        $map   = $path->map();

        foreach ($path->positions() as $position) {
            $trees += $map->treeCountAtPosition($position);
        }

        return $trees;
    }

    public function expandPathWithRepeatedDirections(
         SlopePath $path,
        Directions $directions
    ): SlopePath
    {
        $path_map         = $path->map();
        $path_positions   = $path->positions();
        $max_row_index    = $path_map->rows() - 1;
        $current_position = $path_positions[count($path_positions) - 1];

        while ($current_position->row() < $max_row_index) {
            $next_position = $this->slope_positions->next($current_position, $directions);
            if ($next_position->row() <= $max_row_index) {
                $path_positions[] = $next_position;
                $current_position = $next_position;
            }
        }

        $expanded = new SlopePath($path_map, $path_positions);

        return $expanded;
    }

}
