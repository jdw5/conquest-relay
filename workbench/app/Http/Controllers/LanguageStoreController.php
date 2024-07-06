<?php

namespace Workbench\App\Http\Controllers;

use Conquest\Text\Facades\Text;
use Illuminate\Http\Request;

class LanguageStoreController extends Controller
{
    public function __invoke(Request $request)
    {
        Text::setSessionLanguage($request->language);

        return back();
    }
}
