# Filament plugin for the Lighthouse PHP package from Spatie

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ngiraud/filament-lighthouse-php.svg?style=flat-square)](https://packagist.org/packages/ngiraud/filament-lighthouse-php)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/ngiraud/filament-lighthouse-php/run-tests?label=tests)](https://github.com/ngiraud/filament-lighthouse-php/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/ngiraud/filament-lighthouse-php/Check%20&%20fix%20styling?label=code%20style)](https://github.com/ngiraud/filament-lighthouse-php/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/ngiraud/filament-lighthouse-php.svg?style=flat-square)](https://packagist.org/packages/ngiraud/filament-lighthouse-php)



This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require ngiraud/filament-lighthouse-php
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="filament-lighthouse-php-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="filament-lighthouse-php-config"
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="filament-lighthouse-php-views"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

```php
$filament-lighthouse-php = new Ngiraud\FilamentLighthouse();
echo $filament-lighthouse-php->echoPhrase('Hello, Ngiraud!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Nicolas Giraud](https://github.com/ngiraud)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
