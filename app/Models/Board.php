<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    use HasSlug;
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'is_public',
        'slug'
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

    public function getRouteKeyName()
    {
        return 'slug';
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
