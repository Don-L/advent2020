<?php

namespace App\Models;

class SlopeMap {

    private $map_array;

    public function __construct(array $map_array)
    {
        $this->map_array = $map_array;
    }

    public function treeCountAtPosition(SlopePosition $position): int
    {
        $content_at_position    = $this->contentAtPosition($position);
        $tree_count_at_position = $content_at_position === '#' ? 1 : 0;

        return $tree_count_at_position;
    }

    public function contentAtPosition(SlopePosition $position): string
    {
        $row = $position->row();

        if ($row >= $this->rows()) {
            throw new \Exception('Position is below bottom of map');
        }

        $col     = $position->col() % strlen($this->map_array[$row]);
        $content = $this->map_array[$row][$col];

        return $content;
    }

    public function rows(): int
    {
        return count($this->map_array);
    }

}
