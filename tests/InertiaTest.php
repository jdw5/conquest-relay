<?php

use Inertia\Testing\AssertableInertia;

beforeEach(function () {
    app()->setLocale(config('app.locale'));
});

it('contains a list of available languages', function () {
    $this->get('/index')->assertInertia(function (AssertableInertia $page) {
        $page->component('Index')
            ->has('languages', count(config('relay.languages')))
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
        'language' => '_'
    ]);

    $response
        ->assertSessionHas('language', config('app.locale'))
        ->assertStatus(302);
});

it('shares default translations', function () {
    $this->get('/index')->assertInertia(function (AssertableInertia $page) {
        $page->has('translations', collect(require relay()->getRelayPath().'/messages.php')->flatten()->count());
    });
});

it('shares selected key translations', function () {
    relay()->keys('messages.welcome', 'messages.events.*');
    $this->get('/index')->assertInertia(function (AssertableInertia $page) {
        $page->has('translations', count(collect(require relay()->getRelayPath().'/messages.php')->get('events')) + 1);
    });
});
