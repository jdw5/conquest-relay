<?php

use Inertia\Testing\AssertableInertia;
use Conquest\Text\Http\Resources\LangResource;

beforeEach(function () {
    app()->setLocale(config('app.locale'));
});

it('contains a list of available languages', function () {
    $this->get('/index')->assertInertia(function (AssertableInertia $page) {
        $page->component('Index')
            ->has('languages', count(config('text.languages')))
            ->where('languages.0.value', 'en')
            ->where('languages.0.label', 'English')
            ->where('languages.1.value', 'es')
            ->where('languages.1.label', 'Español');
    });
});

it('contains the current selected language', function () {
    $this->get('/index')->assertInertia(function (AssertableInertia $page) {
        $page->where('language', app()->getLocale());
    });

    app()->setLocale('es');

    $this->get('/index')->assertInertia(function (AssertableInertia $page) {
        $page->where('language', 'es');
    });
});

it('stores the valid selected language in the session', function () {
    $this->post('/language', ['language' => 'es']);

    $this->get('/index')->assertInertia(function (AssertableInertia $page) {
        $page->where('language', 'es');
    });

    $this->post('/language', ['language' => 'kr']);

    $this->get('/index')->assertInertia(function (AssertableInertia $page) {
        $page->where('language', 'es');
    });
});

it('sets the language correctly', function () {
    $response = $this->post('/language', [
        'language' => $language = 'es'
    ]);

    $response
        ->assertSessionHas('language', $language)
        ->assertStatus(302);
});

it('sets the default language if invalid language is provided', function () {
    $response = $this->post('/language', [
        'language' => 'xx'
    ]);

    $response
        ->assertSessionHas('language', config('app.locale'))
        ->assertStatus(302);
});