<?php

namespace App\Models;

use App\Traits\HasOrder;
use Illuminate\Database\Eloquent\Model;

class Column extends Model
{
    use HasOrder;
    protected $fillable = [
        'board_id',
        'title',
        'color',
        'order',
    ];

    public function board()
    {
        return $this->belongsTo(Board::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
