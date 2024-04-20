<?php

namespace Yormy\CoreToolsLaravel\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class NotActiveScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->where('active_from', '>', now());
    }
}
