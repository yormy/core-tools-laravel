<?php

namespace Yormy\CoreToolsLaravel\Traits\Requests;

trait RequestDefaultsTrait
{
    protected function prepareForValidation()
    {
        // add default values
        if (method_exists($this, 'defaults')) {
            foreach ($this->defaults() as $key => $defaultValue) {
                if (! $this->has($key)) {
                    $this->merge([$key => $defaultValue]);
                }
            }
        }
    }
}
