<?php

use Inertia\Testing\AssertableInertia;

it('contains a list of available languages', function () {
    $this->get('/index')->assertInertia(function (AssertableInertia $page) {
        $page->where('languages', fn ($languages) => count($languages) === count(config('text.langs')))
            ->where('languages.0.value', 'en')
            ->where('languages.0.label', 'English');
    });
});

// it('contains the current selected language', function () {
//     $this->get('/index')->assertInertia(function (AssertableInertia $page) {
//         $page->where('language', app()->getLocale());
//     });

//     // Change the locale
//     app()->setLocale('es');

//     $this->get('/index')->assertInertia(function (AssertableInertia $page) {
//         $page->where('language', 'es');
//     });
// });

// it('stores the selected language in the session', function () {
//     $this->get('/index')->assertInertia(function (AssertableInertia $page) {
//         $page->where('language', app()->getLocale());
//     });

//     $this->post('/language', ['language' => 'es']);

//     $this->get('/index')->assertInertia(function (AssertableInertia $page) {
//         $page->where('language', 'es');
//     });

//     $this->post('/language', ['language' => 'xx']);

//     $this->get('/index')->assertInertia(function (AssertableInertia $page) {
//         $page->where('language', 'en');
//     });
// });