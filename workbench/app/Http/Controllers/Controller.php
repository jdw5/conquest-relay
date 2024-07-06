<?php

namespace Workbench\App\Http\Controllers;

use Conquest\Relay\Facades\Relay;
use Illuminate\Http\Request;

class Controller
{
    public function index(Request $request)
    {
        return inertia()->render('Index');
    }

    public function store(Request $request)
    {
        Relay::setSessionLanguage($request->language);

        return back();
    }
}
