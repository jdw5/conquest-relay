<?php

namespace Conquest\Text\Actions;

use Conquest\Text\Text;
use Illuminate\Http\Request;

class StoreLanguage
{
    public static function fromRequest(Request $request)
    {
        match (true) {
            in_array($request->language, Text::availableLanguageKeys()) => session()?->put('language', $request->language),
            default => session()?->put('app.locale')
        };
    }
}
