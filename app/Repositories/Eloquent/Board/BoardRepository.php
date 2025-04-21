<?php

namespace App\Repositories\Eloquent\Board;

use App\Models\Board;
use App\Repositories\Contracts\Board\BoardRepositoryInterface;

class BoardRepository implements BoardRepositoryInterface
{
    public function create(array $data)
    {
        return Board::create($data);
    }
}