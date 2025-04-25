<?php

namespace App\Traits;
use Illuminate\Database\Eloquent\Model;
trait HasOrder
{
    public static function bootHasOrder()
    {
        static::creating(function (Model $model) {
            if (!isset($model->order)) {
                $maxOrder = static::where('board_id', $model->board_id)->max('order');
                $model->order = $maxOrder ? $maxOrder + 1 : 1;
            }
        });
    }
}
