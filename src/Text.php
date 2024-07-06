<?php

namespace Conquest\Text;

class Text
{
    protected array $keys = [];

    public function setSessionLanguage(?string $languageKey): void
    {
        match (true) {
            in_array($languageKey, $this->availableLanguageKeys()) => session()?->put('language', $languageKey),
            default => session()?->put('language', config('app.locale'))
        };

    }
    
    public function availableLanguageKeys(): array
    {
        return array_keys(config('text.languages'));
    }

    public function getLanguage(): string
    {
        return session('language', config('app.locale'));
    }
}
