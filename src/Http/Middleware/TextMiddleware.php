<?php

namespace Conquest\Text\Http\Middleware;

use Inertia\Middleware;
use Illuminate\Http\Request;
use Conquest\Text\Http\Resources\LangResource;

class TextMiddleware extends Middleware
{
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'languages' => LangResource::collection(
                array_map(fn ($key, $label) => [$key, $label],
                    array_keys(config('text.langs')), 
                    config('text.langs'))
                )->additional(['wrapper' => null]),
            'language' => app()->getLocale(),
        ]);
    }
}