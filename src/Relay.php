<?php

namespace Conquest\Relay;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;

class Relay
{
    protected array $keys = [];

    /**
     * Set the keys to retrieve
     *
     * @param  string  ...$keys
     */
    public function keys(...$keys): self
    {
        $this->keys = $keys;

        return $this;
    }

    /**
     * Set the language in the session
     */
    public function setSessionLanguage(?string $languageKey): void
    {
        match (true) {
            in_array($languageKey, $this->availableLanguageKeys()) => session()->put('language', $languageKey),
            default => session()->put('language', config('app.locale'))
        };
    }

    /**
     * Get the available language keys
     */
    public function availableLanguageKeys(): array
    {
        return array_keys(config('relay.languages'));
    }

    /**
     * Get the language from the session or the default locale
     */
    public function getLanguage(): string
    {
        return session('language', config('app.locale'));
    }

    /**
     * Get the path to the translations for the current language
     */
    public function getRelayPath(): string
    {
        return rtrim(config('relay.path'), '/').'/'.app()->getLocale();
    }

    /**
     * Generate a cache key for each language
     */
    public function getCacheKey(): string
    {
        return 'relay'.app()->getLocale();
    }

    /**
     * Get the translations for the current key set if it exists
     */
    public function getTranslations(): array
    {
        $translations = cache()->rememberForever($this->getCacheKey(), fn () => $this->retrieveTranslations());
        if (empty($this->keys)) {
            return $translations;
        }

        return collect($translations)
            ->filter(fn ($_, $key) => collect($this->keys)->some(fn ($pattern) => $pattern === $key || (str_ends_with($pattern, '.*') && str_starts_with($key, substr($pattern, 0, -2)))))
            ->toArray();
    }

    /**
     * Retrieve all translations from the files
     */
    public function retrieveTranslations(): array
    {
        return collect(File::allFiles($this->getRelayPath()))
            ->reject(fn ($file) => in_array($file->getBasename(), config('relay.excludes', [])))
            ->flatMap(fn ($file) => Arr::dot(
                File::getRequire($file->getRealPath()),
                $file->getBasename('.'.$file->getExtension()).'.'
            ))->toArray();
    }
}
