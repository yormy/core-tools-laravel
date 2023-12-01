<?php

namespace Yormy\CoreToolsLaravel\Helpers;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class TranslatableModelHelper extends Model
{
    use HasTranslations;

    protected $guarded = [];

    protected $translatable = ['value'];

    public static function fromJsonFields(string $jsonLanguages): string
    {
        $object = new self;
        $object->setTranslations('value', json_decode($jsonLanguages, true));

        return $object->value;

    }
}
