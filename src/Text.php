<?php

namespace Conquest\Text;

class Text
{
    public static function availableLanguageKeys(): array
    {
        return array_keys(config('text.langs'));
    }
}
