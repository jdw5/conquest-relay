<?php

namespace Conquest\Relay\Http\Middleware;

use Inertia\Middleware;
use Illuminate\Http\Request;
use Conquest\Relay\Facades\Relay;
use Conquest\Relay\Http\Resources\LangResource;

class RelaysTranslations extends Middleware
{
    public function share(Request $request): array
    {
        app()->setLocale(Relay::getLanguage());

        return array_merge(parent::share($request), [
            'languages' => collect(config('relay.languages'))
                ->map(fn ($label, $key) => [
                    'value' => $key,
                    'label' => $label
                ])->values(),
            'language' => app()->getLocale(),
            'translations' => Relay::getTranslations()
        ]);
    }
}
