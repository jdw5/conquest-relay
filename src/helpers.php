<?php

use Conquest\Relay\Facades\Relay;

if (! function_exists('relay')) {

    function relay(...$keys = null)
    {
        $instance = Relay::getFacadeRoot();

        if (! is_null($keys)) {
            return $instance->keys($keys);
        }

        return $instance;
    }
}
