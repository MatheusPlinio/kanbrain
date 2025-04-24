<?php

namespace App\Repositories\Eloquent\Column;

use App\Models\Board;
use App\Repositories\Contracts\Column\ColumnRepositoryInterface;

class ColumnRepository implements ColumnRepositoryInterface
{
    public function store($data, $board_id): bool
    {
        return Board::find($board_id)->
            columns()->create(
                [
                    'title' => $data['title'],
                    'color' => $data['color'] ?? null
                ]
            );
    }
}