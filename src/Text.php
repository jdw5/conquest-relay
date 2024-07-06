<?php

namespace Conquest\Text;

class Text
{
    protected array $keys = [];
    
    public static function availableLanguageKeys(): array
    {
        return array_keys(config('text.langs'));
    }
}
