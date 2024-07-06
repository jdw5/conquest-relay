# Share localized, backend-driven messages as text to your Inertia frontend.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/conquest/relay.svg?style=flat-square)](https://packagist.org/packages/conquest/relay)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/jdw5/conquest-relay/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/jdw5/conquest-relay/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/jdw5/conquest-relay/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/jdw5/conquest-relay/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/conquest/relay.svg?style=flat-square)](https://packagist.org/packages/conquest/relay)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.
## Installation

You can install the package via composer:

```bash
composer require conquest/relay
```

You can publish and run the migrations with:

You can publish the config file with:

```bash
php artisan vendor:publish --tag="relay-config"
```

This is the contents of the published config file:

```php
return [
    'share' => true,
    'path' => base_path('lang'),
    'languages' => [
        'en' => 'English',
    ],
    'excludes' => [
        'validation.php',
    ],
];
```


## Usage
Inside a controller, you can append translations to your application using the `relay()` helper.
```php
relay();
```

By default, this will share all translations from the `lang` or the `path` set in the config directory to the frontend. You can customize this behavior by publishing the config file and modifying the `excludes` array. This array is cahced for each available language defined in the `config('relay.languages')` array. You can select to only pass a subset of translations to the frontend by adding keys using dot notations to reduce the amount of data sent over the wire. This accepts wildcard characters as well.

```php
relay()->keys('messages.*', 'auth.login')
```

Ensure that the `RelaysTranslations` middleware is applied to any Inertia based routes. You can extend this middleware to overwrite the `HandlesInertiaRequests` middleware in the Laravel starter packages, as this package itself extends the Inertia middleware.


## Testing

```bash
composer test
```

## Credits

- [Joshua Wallace](https://github.com/jdw5)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
