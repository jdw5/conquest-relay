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
            'languages' => LangResource::collection(
                array_map(fn ($key, $label) => [$key, $label],
                    array_keys(config('relay.languages')), 
                    config('relay.languages'))
                ),
            'language' => app()->getLocale(),

            'translations' => Relay::retrieveTranslations()
        ]);
    }
}