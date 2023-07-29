<?php

namespace Yormy\CoreToolsLaravel\Traits\Scopes;

use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;

//todo: or to date package
trait DateScope
{
    public function scopeNotExpired(Builder $builder): Builder
    {
        return $builder->where(function ($q) {
            $q->where('expires_at', '>', Carbon::now())
                ->orWhereNull('expires_at');
        });
    }
}
