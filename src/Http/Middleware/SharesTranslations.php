<?php

namespace Conquest\Text\Http\Middleware;

use Inertia\Middleware;
use Illuminate\Http\Request;
use Conquest\Text\Facades\Text;
use Conquest\Text\Http\Resources\LangResource;

class SharesTranslations extends Middleware
{
    public function share(Request $request): array
    {
        app()->setLocale(Text::getLanguage());

        return array_merge(parent::share($request), [
            'languages' => LangResource::collection(
                array_map(fn ($key, $label) => [$key, $label],
                    array_keys(config('text.languages')), 
                    config('text.languages'))
                ),
                
            'language' => app()->getLocale(),
        ]);
    }
}