<?php

namespace Yormy\CoreToolsLaravel\Scopes;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class NotExpiredScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->where(function ($q) {
            $q->where('expires_at', '>', Carbon::now())
                ->orWhereNull('expires_at');
        });
    }
}
