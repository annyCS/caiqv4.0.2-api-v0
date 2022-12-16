<?php

namespace App\Models\Traits;

use Illuminate\Support\Str;

trait HasUuid
{
    public function getKeyType()
    {
        return 'string';
    }

    public function getIncrementing()
    {
        return false;
    }

    protected static function bootHasUuid()
    {
        static::creating(function($model) {
            $model->{$model->getKeyName()} = Str::uuid()->toString();
        });
    }
}
