<?php

namespace App\Repositories\Contracts\Column;

interface ColumnRepositoryInterface
{
    public function store(array $data, $board_id);
}