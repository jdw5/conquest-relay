<?php

namespace Conquest\Relay;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;

class Relay
{
    protected array $keys = [];

    public function keys(...$keys): self
    {
        $this->keys = $keys;

        return $this;
    }

    public function setSessionLanguage(?string $languageKey): void
    {
        match (true) {
            in_array($languageKey, $this->availableLanguageKeys()) => session()?->put('language', $languageKey),
            default => session()?->put('language', config('app.locale'))
        };

    }

    public function availableLanguageKeys(): array
    {
        return array_keys(config('relay.languages'));
    }

    public function getLanguage(): string
    {
        return session('language', config('app.locale'));
    }

    public function getRelayPath(): string
    {
        return rtrim(config('relay.path'), '/').'/'.app()->getLocale();
    }

    public function retrieveTranslations(): array
    {
        // Get the path and ensure it's got a / on end
        return collect(File::allFiles($this->getRelayPath()))
            ->flatMap(function ($file) {
                return Arr::dot(
                    File::getRequire($file->getRealPath()),
                    $file->getBasename('.'.$file->getExtension()).'.'
                );
            })->toArray();
    }
}
