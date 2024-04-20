<?php


namespace Yormy\CoreToolsLaravel\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class NotExpiredScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->where('expires_at', '>', now());
    }
}