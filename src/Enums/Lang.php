<?php

namespace Conquest\Text\Enums;

enum Lang: string
{
    case EN = 'en';

    public function label(): string
    {
        return match ($this) {
            self::EN => 'English',
        };
    }
}