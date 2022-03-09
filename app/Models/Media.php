<?php

namespace App\Models;

use Ramsey\Uuid\Uuid;
use Spatie\MediaLibrary\MediaCollections\Models\Media as BaseMedia;

class Media extends BaseMedia
{
    protected $keyType = 'string';
    public $incrementing = false;

    public static function bootHasUuid()
    {
        static::creating(function ($model) {
            $keyName = $model->getKeyName();
            if (!isset($model->{$keyName}) || empty($model->{$keyName})) {
                $model->{$keyName} = Uuid::uuid4();
            }
        });
    }
}
