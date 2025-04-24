<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasSlug
{
    public static function bootHasSlug()
    {
        static::creating(function ($model) {
            if (empty($model->slug) && !empty($model->title)) {
                $model->slug = Str::slug($model->title);
            }
        });
    }
}