<?php

use Conquest\Relay\Facades\Relay;

beforeEach(function () {
    app()->setLocale(config('app.locale'));
});

it('gets all translations if key not provided', function () {
    $translations = Relay::getTranslations();
    expect($translations)->toBeArray()
        ->toHaveLength(collect(require relay()->getRelayPath().'/messages.php')->flatten()->count());
});

it('excludes files from config', function () {
    $translations = Relay::getTranslations();
    expect(array_keys($translations))->each->not->toContain('validation');
});

it('accepts keys to retrieve', function () {
    $translations = Relay::keys('messages.welcome', 'messages.greeting')->getTranslations();
    expect($translations)->toHaveLength(2);
});

it('accepts wildcard dot notation keys', function () {
    $translations = Relay::keys('messages.events.*')->getTranslations();
    expect($translations)->toHaveLength(count(collect(require relay()->getRelayPath().'/messages.php')->get('events')));
});

it('outputs empty array if invalid keys', function () {
    $translations = Relay::keys('messages.invalid')->getTranslations();
    expect($translations)->toBeEmpty();
});

it('uses global helper function', function () {
    $translations = relay()->getTranslations();
    expect($translations)->toBeArray()
        ->toHaveLength(collect(require relay()->getRelayPath().'/messages.php')->flatten()->count());
});

it('changes locale translations', function () {
    app()->setLocale('es');

    $translations = relay('messages.welcome')->getTranslations();
    expect(collect($translations)->first())->toBe('Bienvenido a nuestra aplicación');
});