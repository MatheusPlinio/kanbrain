<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskResource;
use App\Models\Column;

class TaskController extends Controller
{
    public function show(Column $column)
    {
        return new TaskResource($column->tasks);
    }
}
