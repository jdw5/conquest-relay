<?php

namespace Workbench\App\Http\Controllers;

use Conquest\Relay\Facades\Relay;
use Illuminate\Http\Request;

class LanguageStoreController extends Controller
{
    public function __invoke(Request $request)
    {
        Relay::setSessionLanguage($request->language);

        return back();
    }
}
