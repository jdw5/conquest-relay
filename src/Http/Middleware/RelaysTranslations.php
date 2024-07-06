<?php

namespace Conquest\Relay\Http\Middleware;

use Conquest\Relay\Facades\Relay;
use Illuminate\Http\Request;
use Inertia\Middleware;

class RelaysTranslations extends Middleware
{
    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     */
    public function share(Request $request): array
    {
        app()->setLocale(Relay::getLanguage());

        return array_merge(parent::share($request), [
            'languages' => collect(config('relay.languages'))
                ->map(fn ($label, $key) => [
                    'value' => $key,
                    'label' => $label,
                ])->values(),
            'language' => app()->getLocale(),
            'translations' => Relay::getTranslations(),
        ]);
    }
}
