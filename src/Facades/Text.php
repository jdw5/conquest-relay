<?php

namespace Conquest\Text\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Conquest\Text\Text
 */
class Text extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Conquest\Text\Text::class;
    }
}
