<?php

use Conquest\Relay\Facades\Relay;

if (! function_exists('relay')) {

    /**
     * Get the Relay instance
     *
     * @param  string  ...$keys
     * @return \Conquest\Relay\Relay
     */
    function relay(...$keys)
    {
        $instance = Relay::getFacadeRoot();
        if (! empty($keys)) {
            return $instance->keys($keys);
        }

        return $instance;
    }
}
