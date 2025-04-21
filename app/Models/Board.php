<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'is_public'
    ];

    protected $hidden = [
        'user_id',
        'created_at',
        'updated_at'
    ];

    protected static function booted()
    {
        static::creating(function ($board) {
            $board->user_id = auth()->id();
        });
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function columns()
    {
        return $this->hasMany(Column::class);
    }
}
