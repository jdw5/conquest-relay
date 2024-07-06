<?php

namespace Workbench\App\Http\Controllers;

use Conquest\Text\Actions\StoreLanguage;
use Illuminate\Http\Request;

class LanguageStoreController extends Controller
{
    public function __invoke(Request $request)
    {
        StoreLanguage::fromRequest($request);

        return back();
    }
}
