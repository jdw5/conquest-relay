<?php

namespace Conquest\Relay\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Conquest\Relay\Relay
 */
class Relay extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Conquest\Relay\Relay::class;
    }
}
