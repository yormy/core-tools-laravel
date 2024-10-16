<?php

namespace Yormy\CoreToolsLaravel\Helpers;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class TranslatableModelHelper extends Model
{
    use HasTranslations;

    protected $guarded = [];

    /**
     * @var string[]
     */
    protected $translatable = ['value'];

    public static function fromJsonFields(string $jsonLanguages): string
    {
        $object = new self;

        /** @var string[] $translations */
        $translations = json_decode($jsonLanguages, true);
        $object->setTranslations('value', $translations);

        return $object->value; //@phpstan-ignore-line

    }
}
